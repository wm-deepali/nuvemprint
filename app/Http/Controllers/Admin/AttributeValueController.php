<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\SubcategoryAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttributeValueController extends Controller
{
    public function index()
    {
        $values = AttributeValue::with('attribute')->latest()->get();
        return view('admin.attribute-values.index', compact('values'));
    }

    public function getValues($id, Request $request)
    {

        $values = AttributeValue::where('attribute_id', $id)->get(['id', 'value']);

        $selected = [];
        if ($request->has('subcategory_id')) {
            $selected = SubcategoryAttributeValue::where('subcategory_id', $request->subcategory_id)
                ->where('attribute_id', $id)
                ->pluck('attribute_value_id')
                ->toArray();
        }

        return response()->json([
            'success' => true,
            'values' => $values,
            'selected_values' => $selected,
        ]);
    }


    public function create()
    {
        $attributes = Attribute::all();

        $attributeConfigs = $attributes->mapWithKeys(function ($attribute) {
            return [
                $attribute->id => [
                    'has_image' => $attribute->has_image,
                    'has_icon' => $attribute->has_icon,
                    'has_description' => false,
                    'input_type' => $attribute->input_type, // Assuming has_title is a property of the attribute
                ],
            ];
        });

        $view = view('admin.attribute-values.add', [
            'attributeConfigs' => $attributeConfigs,
            'attributes' => $attributes,
        ])->render();

        // dd($attributeConfigs);
        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attribute_id' => 'required|exists:attributes,id',
            'attribute_values' => 'required|array|min:1',
            'attribute_values.*.value' => 'required', // will check type in code
            'attribute_values.*.title' => 'nullable|string|max:255',
            'attribute_values.*.icon_class' => 'nullable|string|max:255',
            'attribute_values.*.description' => 'nullable|string',
            'attribute_values.*.image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $attribute = Attribute::findOrFail($request->attribute_id);
        $inputType = $attribute->input_type;

        foreach ($request->attribute_values as $index => $valueData) {
            $data = [
                'attribute_id' => $request->attribute_id,
                'icon_class' => $valueData['icon_class'] ?? null,
                'description' => $valueData['description'] ?? null,
                'title' => $valueData['title'] ?? null,
            ];

            // Handle value depending on input type
            if (in_array($inputType, ['select_image', 'select_icon'])) {
                if (isset($valueData['value']) && $valueData['value'] instanceof \Illuminate\Http\UploadedFile) {
                    $storedPath = $valueData['value']->store('attribute_values', 'public');
                    $data['image_path'] = $storedPath; // or basename($storedPath)
                }
                $data['value'] = $valueData['title'] ?? null;

            } else {
                // Plain text value
                $data['value'] = $valueData['value'];
            }

            // Optional: additional image field
            if (isset($valueData['image']) && $valueData['image'] instanceof \Illuminate\Http\UploadedFile) {
                $data['image_path'] = $valueData['image']->store('attribute_values', 'public');
            }

            AttributeValue::create($data);
        }

        return $this->respondSuccess($request, 'Attribute value(s) created successfully.');
    }

    public function edit($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attribute = Attribute::findOrFail($attributeValue->attribute_id);
        $attributeConfigs = [
            $attribute->id => [
                'has_image' => $attribute->has_image,
                'has_icon' => $attribute->has_icon,
                'has_description' => false, // Or true if used
                'input_type' => $attribute->input_type,
            ]
        ];

        $view = view('admin.attribute-values.edit', [
            'attributeValue' => $attributeValue,
            'attribute' => $attribute,
            'attributeConfigs' => $attributeConfigs,
            'action' => route('admin.attribute-values.update', $attributeValue->id),
            'method' => 'PUT',
            'buttonText' => 'Update',
        ])->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }


    public function update(Request $request, AttributeValue $attributeValue)
    {
        $attribute = Attribute::findOrFail($request->attribute_id);
        $inputType = $attribute->input_type;

        $rules = [
            'attribute_id' => 'required|exists:attributes,id',
            'icon_class' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        // Conditionally validate title and value
        if (in_array($inputType, ['select_image', 'select_icon'])) {
            $rules['value'] = 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048';
            $rules['title'] = 'required|string|max:255';
        } else {
            $rules['value'] = 'required|string|max:255';
            $rules['title'] = 'nullable|string|max:255';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $data = $request->only(['attribute_id', 'title', 'icon_class', 'description']);

        // Handle value (text or file)
        if (in_array($inputType, ['select_image', 'select_icon'])) {
            if ($request->hasFile('value')) {
                $storedPath = $request->file('value')->store('attribute_values', 'public');
                $data['image_path'] = $storedPath;
            }
            $data['value'] = $request->input('title'); // or basename($storedPath)
        }
        else{
            // For text input type
            $data['value'] = $request->input('value');
        }

        // Handle optional image field
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('attribute_values', 'public');
        }

        $attributeValue->update($data);

        return $this->respondSuccess($request, 'Attribute value updated successfully.');
    }


    public function destroy(AttributeValue $attributeValue)
    {
        $attributeValue->delete();

        return request()->ajax()
            ? response()->json(['success' => true, 'message' => 'Value deleted.'])
            : redirect()->route('admin.attribute-values.index')->with('success', 'Value deleted.');
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
            : redirect()->route('admin.attribute-values.index')->with('success', $message);
    }
}
