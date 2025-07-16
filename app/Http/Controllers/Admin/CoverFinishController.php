<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\CoverFinish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CoverFinishController extends Controller
{
    public function index()
    {
        $coverFinishes = CoverFinish::all();
        return view('admin.manage-cover-finish.index', compact('coverFinishes'));
    }


    public function create()
    {
        $html = view('admin.manage-cover-finish.create')->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|array|min:1',
            'name.*' => 'required|string|max:255|distinct',
            'image.*' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors()
            ]);
        }

        $coverFinishes = [];

        foreach ($request->name as $index => $name) {
            $imagePath = null;

            if ($request->hasFile("image.$index")) {
                $file = $request->file("image")[$index];
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $imagePath = $file->storeAs('cover_finishes', $filename, 'public');
            }

            $coverFinishes[] = [
                'name' => $name,
                'image_path' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        CoverFinish::insert($coverFinishes);

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $coverFinish = CoverFinish::findOrFail($id);
        $html = view('admin.manage-cover-finish.edit', compact('coverFinish'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $coverFinish = CoverFinish::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:cover_finishes,name,' . $id,
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
            if ($coverFinish->image_path) {
                Storage::disk('public')->delete($coverFinish->image_path);
            }
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $coverFinish->image_path = $request->file('image')->storeAs('cover_finishes', $filename, 'public');
        }

        $coverFinish->name = $request->name;
        $coverFinish->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $coverFinish = CoverFinish::findOrFail($id);
        if ($coverFinish->image_path) {
            Storage::disk('public')->delete($coverFinish->image_path);
        }
        $coverFinish->delete();

        return response()->json(['success' => true]);
    }

}

