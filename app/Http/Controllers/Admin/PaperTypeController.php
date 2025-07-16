<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaperType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaperTypeController extends Controller
{
    public function index()
    {
        $paperTypes = PaperType::latest()->get();
        return view('admin.paper-type.index', compact('paperTypes'));
    }


    public function create()
    {
        try {
            return response()->json([
                "success" => true,
                "html" => view('admin.paper-type.create')->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'name' => 'required|array|min:1',
            'name.*' => 'required|string|max:255|distinct',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
            
        }

        $paperTypes = [];

        foreach ($requestData['name'] as $name) {
            $paperTypes[] = [
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        PaperType::insert($paperTypes);

        return response()->json([
            'success' => true,
            'message' => 'Paper types created successfully',
        ]);
    }


    public function edit($id)
    {
        $paperType = PaperType::find($id);

        if (!$paperType) {
            return response()->json([
                'success' => false,
                'msgText' => 'Paper Type not found.',
            ]);
        }

        $html = view('admin.paper-type.edit', compact('paperType'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
        ]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:paper_types,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        $paperType = PaperType::findOrFail($id);
        $paperType->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Paper type updated successfully.',
        ]);
    }

    public function destroy($id)
    {
        $paperType = PaperType::findOrFail($id);
        $paperType->delete();
        return response()->json(['success' => true, 'message' => 'Deleted successfully.']);
    }
}
