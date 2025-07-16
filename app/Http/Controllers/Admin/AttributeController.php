<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::latest()->get();
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return response()->json([
            'success' => true,
            'html' => view('admin.attributes.add', [
                'action' => route('admin.attributes.store'),
            ])->render(),
        ]);
    }

    public function store(Request $request)
    {
        // 🔍 Validate the incoming request
        $validator = Validator::make($request->all(), [
            'attributes' => 'required|array',
            'attributes.*.name' => 'required|string|max:255',
            'attributes.*.input_type' => 'required|in:dropdown,radio,checkbox,text,number,range,select_image,select_icon,toggle,textarea,grouped_select',
            'attributes.*.has_image' => 'nullable|in:1',
            'attributes.*.has_icon' => 'nullable|in:1',
            'detail' => 'nullable|string|max:1000',
        ]);

        // ❌ If validation fails, return errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        $attributes = $request->input('attributes');
        // ✅ Loop through attributes and create them
        foreach ($attributes as $attr) {
            Attribute::create([
                'name' => $attr['name'],
                'input_type' => $attr['input_type'],
                'has_image' => isset($attr['has_image']) ? 1 : 0,
                'has_icon' => isset($attr['has_icon']) ? 1 : 0,
                'detail' => $attr['detail'] ?? null, // ✅ Add this line
            ]);
        }

        // ✅ Return success response
        return $request->ajax()
            ? response()->json(['success' => true, 'message' => 'Attributes added.'])
            : redirect()->route('admin.attributes.index')->with('success', 'Attributes added.');
    }



    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        return response()->json([
            'success' => true,
            'html' => view('admin.attributes.edit', [
                'attribute' => $attribute,
                'action' => route('admin.attributes.update', $attribute->id),
            ])->render(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $attribute = Attribute::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:attributes,name,' . $attribute->id,
            'input_type' => 'required|in:dropdown,radio,checkbox,text,number,range,select_image,select_icon,toggle,textarea,grouped_select',
            'has_image' => 'sometimes|boolean',
            'has_icon' => 'sometimes|boolean',
            'detail' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        $attribute->update([
            'name' => $request->name,
            'input_type' => $request->input_type,
            'has_image' => $request->boolean('has_image'),
            'has_icon' => $request->boolean('has_icon'),
            'detail' => $request->detail, // ✅ Add this line
        ]);


        return $request->ajax()
            ? response()->json(['success' => true, 'message' => 'Attribute updated successfully.'])
            : redirect()->route('admin.attributes.index')->with('success', 'Attribute updated successfully.');
    }

    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);

        $attribute->delete();

        return response()->json(['success' => true]);

    }
}
