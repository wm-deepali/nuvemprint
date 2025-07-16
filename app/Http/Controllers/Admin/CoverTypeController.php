<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoverType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CoverTypeController extends Controller
{
    public function index()
    {
        $coverTypes = CoverType::all();
        return view('admin.manage-cover-type.index', compact('coverTypes'));
    }


    public function create()
    {
        $html = view('admin.manage-cover-type.create')->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|array|min:1',
            'name.*' => 'required|string|max:255|distinct|unique:cover_types,name',
            'image' => 'nullable|array',
            'image.*' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors()
            ]);
        }

        $names = $request->name;
        $images = $request->file('image', []);
        $insertData = [];

        foreach ($names as $index => $name) {
            $imagePath = null;

            if (isset($images[$index]) && $images[$index]->isValid()) {
                $file = $images[$index];
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $imagePath = $file->storeAs('cover_types', $filename, 'public');
            }

            $insertData[] = [
                'name' => $name,
                'image_path' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        CoverType::insert($insertData);

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $coverType = CoverType::findOrFail($id);
        $html = view('admin.manage-cover-type.edit', compact('coverType'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $coverType = CoverType::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:cover_types,name,' . $id,
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors()
            ]);
        }

        if ($request->hasFile('image')) {
            if ($coverType->image_path) {
                Storage::disk('public')->delete($coverType->image_path);
            }
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('cover_types', $filename, 'public');
            $coverType->image_path = $imagePath;
        }

        $coverType->name = $request->name;
        $coverType->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $coverType = CoverType::findOrFail($id);

        if ($coverType->image_path) {
            Storage::disk('public')->delete($coverType->image_path);
        }

        $coverType->delete();

        return response()->json(['success' => true]);
    }

}
