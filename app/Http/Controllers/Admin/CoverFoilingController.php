<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\CoverFoiling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CoverFoilingController extends Controller
{
    public function index()
    {
        $coverFoilings = CoverFoiling::all();
        return view('admin.manage-cover-foiling.index', compact('coverFoilings'));
    }


    public function create()
    {
        $html = view('admin.manage-cover-foiling.create')->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|array',
            'name.*' => 'required|string|distinct|unique:cover_foilings,name',
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

        foreach ($request->name as $index => $name) {
            $imagePath = null;

            if ($request->hasFile("image.$index")) {
                $file = $request->file("image.$index");
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $imagePath = $file->storeAs('cover_foilings', $filename, 'public');
            }

            CoverFoiling::create([
                'name' => $name,
                'image_path' => $imagePath,
            ]);
        }

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $coverFoiling = CoverFoiling::findOrFail($id);
        $html = view('admin.manage-cover-foiling.edit', compact('coverFoiling'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $CoverFoiling = CoverFoiling::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:cover_foilings,name,' . $id,
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
            if ($CoverFoiling->image_path) {
                Storage::disk('public')->delete($CoverFoiling->image_path);
            }
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $CoverFoiling->image_path = $request->file('image')->storeAs('cover_foilings', $filename, 'public');
        }

        $CoverFoiling->name = $request->name;
        $CoverFoiling->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $CoverFoiling = CoverFoiling::findOrFail($id);
        if ($CoverFoiling->image_path) {
            Storage::disk('public')->delete($CoverFoiling->image_path);
        }
        $CoverFoiling->delete();

        return response()->json(['success' => true]);
    }

}

