<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DustJacketFinish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DustJacketFinishController extends Controller
{
    public function index()
    {
        $dustFinishes = DustJacketFinish::all();
        return view('admin.manage-dust-jacket-finish.index', compact('dustFinishes'));
    }


    public function create()
    {
        $html = view('admin.manage-dust-jacket-finish.create')->render();
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

        $dustFinishes = [];

        foreach ($request->name as $index => $name) {
            $imagePath = null;

            if ($request->hasFile("image.$index")) {
                $file = $request->file("image")[$index];
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $imagePath = $file->storeAs('dust_finishes', $filename, 'public');
            }

            $dustFinishes[] = [
                'name' => $name,
                'image_path' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DustJacketFinish::insert($dustFinishes);

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $dustFinish = DustJacketFinish::findOrFail($id);
        $html = view('admin.manage-dust-jacket-finish.edit', compact('dustFinish'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $dustFinish = DustJacketFinish::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:dust_jacket_finishes,name,' . $id,
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
            if ($dustFinish->image_path) {
                Storage::disk('public')->delete($dustFinish->image_path);
            }
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $dustFinish->image_path = $request->file('image')->storeAs('dust_finishes', $filename, 'public');
        }

        $dustFinish->name = $request->name;
        $dustFinish->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $dustFinish = DustJacketFinish::findOrFail($id);
        if ($dustFinish->image_path) {
            Storage::disk('public')->delete($dustFinish->image_path);
        }
        $dustFinish->delete();

        return response()->json(['success' => true]);
    }

}
