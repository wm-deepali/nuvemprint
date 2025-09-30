<?php

namespace App\Http\Controllers;

use App\Models\DeliveryCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryChargeController extends Controller
{
    public function index()
    {
        $deliverCharges = DeliveryCharge::latest()->get();
        return view('admin.delivery-charge.index', compact('deliverCharges'));
    }

    public function create()
    {
        $view = view('admin.delivery-charge.create')->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'delivery_charges' => 'required|array|min:1',
            'delivery_charges.*.no_of_days' => 'required|numeric|min:0',
            'delivery_charges.*.details' => 'nullable|string|max:255',
            'delivery_charges.*.price' => 'required|numeric|min:0',
            'delivery_charges.*.title' => 'required|string|max:255',
            'delivery_charges.*.is_default' => 'nullable|boolean',
            'delivery_charges.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // image validation
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        foreach ($request->delivery_charges as $index => $valueData) {
            $data = [
                'no_of_days' => $valueData['no_of_days'],
                'details' => $valueData['details'] ?? null,
                'price' => $valueData['price'],
                'title' => $valueData['title'],
                'is_default' => !empty($valueData['is_default']) ? 1 : 0,
            ];

            // Handle image upload
            if (isset($valueData['image']) && is_file($valueData['image'])) {
                $imagePath = $valueData['image']->store('delivery_charges', 'public');
                $data['image'] = $imagePath;
            }

            DeliveryCharge::create($data);
        }

        return $this->respondSuccess($request, 'Delivery Charges created successfully.');
    }

    public function update(Request $request, $id)
    {
        $DeliveryCharge = DeliveryCharge::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'no_of_days' => 'required|numeric|min:0',
            'details' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'title' => 'required|string|max:255',
            'is_default' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // image validation
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $data = $request->only([
            'no_of_days',
            'price',
            'details',
            'title',
        ]);

        // Handle the checkbox for is_default
        $data['is_default'] = $request->has('is_default') ? true : false;

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($DeliveryCharge->image && \Storage::disk('public')->exists($DeliveryCharge->image)) {
                \Storage::disk('public')->delete($DeliveryCharge->image); // remove old image
            }
            $data['image'] = $request->file('image')->store('delivery_charges', 'public');
        }

        $DeliveryCharge->update($data);

        return $this->respondSuccess($request, 'Delivery Charges updated successfully.');
    }




    public function edit($id)
    {
        $DeliveryCharge = DeliveryCharge::findOrFail($id);
        $view = view('admin.delivery-charge.edit', ['DeliveryCharge' => $DeliveryCharge])->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }



    public function destroy(DeliveryCharge $deliveryCharge)
    {
        $deliveryCharge->delete();

        return request()->ajax()
            ? response()->json(['success' => true, 'message' => 'Delivery Charges deleted.'])
            : redirect()->route('admin.deliver-charge.index')->with('success', 'Value deleted.');
    }

    // 🔄 Helper for validation failure
    private function validationError($validator)
    {
        return response()->json([
            'success' => false,
            'code' => 422,
            'errors' => $validator->errors(),
        ]);
    }

    // ✅ Helper for success redirect or JSON
    private function respondSuccess(Request $request, string $message)
    {
        return $request->ajax()
            ? response()->json(['success' => true, 'message' => $message])
            : redirect()->route('admin.deliver-charge.index')->with('success', $message);
    }
}

