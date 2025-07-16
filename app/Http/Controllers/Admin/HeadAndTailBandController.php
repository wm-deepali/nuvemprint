<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeadAndTailBand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HeadAndTailBandController extends Controller
{
    public function index()
    {
        $headAndTailBands = HeadAndTailBand::all();
        return view('admin.manage-head-tail-band.index', compact('headAndTailBands'));
    }


    public function create()
    {
        $html = view('admin.manage-head-tail-band.create')->render();
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

        $headAndTailBands = [];

        foreach ($request->name as $index => $name) {
            $imagePath = null;

            if ($request->hasFile("image.$index")) {
                $file = $request->file("image")[$index];
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $imagePath = $file->storeAs('head_and_tails_bands', $filename, 'public');
            }

            $headAndTailBands[] = [
                'name' => $name,
                'image_path' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        HeadAndTailBand::insert($headAndTailBands);

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $headTailBand = HeadAndTailBand::findOrFail($id);
        $html = view('admin.manage-head-tail-band.edit', compact('headTailBand'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $headTailBand = HeadAndTailBand::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:head_and_tail_bands,name,' . $id,
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
            if ($headTailBand->image_path) {
                Storage::disk('public')->delete($headTailBand->image_path);
            }
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $headTailBand->image_path = $request->file('image')->storeAs('head_and_tails_bands', $filename, 'public');
        }

        $headTailBand->name = $request->name;
        $headTailBand->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $headTailBand = HeadAndTailBand::findOrFail($id);
        if ($headTailBand->image_path) {
            Storage::disk('public')->delete($headTailBand->image_path);
        }
        $headTailBand->delete();

        return response()->json(['success' => true]);
    }

}
