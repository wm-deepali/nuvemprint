<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Quote;
use Illuminate\Http\Request;

class CustomerEstimateController extends Controller
{
    public function index()
    {
        $customers = Customer::withCount('quotes')->get();

        return view('admin.customer_estimates.customers', compact('customers'));
    }

    public function detail($id)
    {
        $customer = Customer::with('quotes')->findOrFail($id);

        return view('admin.customer_estimates.customer_detail', compact('customer'));
    }




    public function quoteRequest()
    {
        // All pending quotes
        $quotes = Quote::with(['customer', 'deliveryAddress', 'items.subcategory.categories'])
            ->where('status', 'pending')
            ->latest()
            ->get();
            // Approved quotes that are NOT yet processed to any department
            $approvedQuotes = Quote::with(['customer', 'departments', 'deliveryAddress', 'items.subcategory.categories', 'payments'])
            ->where('status', 'approved')
            ->get();
         

        // Approved + processed quotes (with departments)
        $processedQuotes = Quote::with(['departments', 'customer', 'deliveryAddress', 'items.subcategory.categories', 'payments'])
            ->where('status', 'approved')
            ->whereHas('departments') // Assigned to at least one department
            ->get();

        // Group processed quotes by department
        $departmentQuotes = [];

        foreach ($processedQuotes as $quote) {
            // Get the latest department (by created_at or id or pivot timestamp)
            $latestDepartment = $quote->departments->sortByDesc('pivot.created_at')->first();

            if ($latestDepartment) {
                $departmentQuotes[$latestDepartment->id][] = $quote;
            }
        }


        $departments = Department::all();

        return view('admin.customer_estimates.quote_request', compact(
            'quotes',
            'approvedQuotes',
            'departmentQuotes',
            'departments'
        ));
    }


    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'msgText' => 'Customer not found.'
            ], 404);
        }

        try {
            $customer->delete();

            return response()->json([
                'success' => true,
                'message' => 'Customer deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msgText' => 'Something went wrong while deleting the customer.'
            ], 500);
        }
    }

}
