<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Binding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class BindingController extends Controller
{


    public function index()
    {
        $bindings = Binding::latest()->get();
        return view('admin.manage-binding.index', compact('bindings'));
    }

    public function create()
    {
        $html = view('admin.manage-binding.create')->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|array|min:1',
            'name.*' => 'required|string|max:255|distinct',
            'image' => 'nullable|array',
            'image.*' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        $bindings = [];
        $names = $request->name;
        $images = $request->file('image', []);

        foreach ($names as $index => $name) {
            $path = null;

            if (isset($images[$index]) && $images[$index]->isValid()) {
                $file = $images[$index];
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('bindings', $filename, 'public');
            }

            $bindings[] = [
                'name' => $name,
                'image_path' => $path,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Binding::insert($bindings);

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $binding = Binding::findOrFail($id);
        $html = view('admin.manage-binding.edit', compact('binding'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $binding = Binding::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:bindings,name,' . $id,
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($binding->image_path) {
                Storage::disk('public')->delete($binding->image_path);
            }

            // Store new image
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('bindings', $filename, 'public');
            $binding->image_path = $path;
        }

        // Update name (and image if changed)
        $binding->name = $request->name;
        $binding->save();

        return response()->json(['success' => true]);
    }


    public function destroy($id)
    {
        $binding = Binding::findOrFail($id);
        if ($binding->image_path) {
            Storage::disk('public')->delete($binding->image_path);
        }
        $binding->delete();

        return response()->json(['success' => true]);
    }

}
