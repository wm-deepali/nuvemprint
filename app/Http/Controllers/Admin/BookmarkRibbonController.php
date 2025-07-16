<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookmarkRibbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookmarkRibbonController extends Controller
{
    public function index()
    {
        $bookmarkRibbons = BookmarkRibbon::all();
        return view('admin.manage-bookmark-ribbon.index', compact('bookmarkRibbons'));
    }


    public function create()
    {
        $html = view('admin.manage-bookmark-ribbon.create')->render();
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

        $bookmarkRibbons = [];

        foreach ($request->name as $index => $name) {
            $imagePath = null;

            if ($request->hasFile("image.$index")) {
                $file = $request->file("image")[$index];
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $imagePath = $file->storeAs('bookmark_ribbons', $filename, 'public');
            }

            $bookmarkRibbons[] = [
                'name' => $name,
                'image_path' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        BookmarkRibbon::insert($bookmarkRibbons);

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $bookmarkRibbon = BookmarkRibbon::findOrFail($id);
        $html = view('admin.manage-bookmark-ribbon.edit', compact('bookmarkRibbon'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $bookmarkRibbon = BookmarkRibbon::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:bookmark_ribbons,name,' . $id,
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
            if ($bookmarkRibbon->image_path) {
                Storage::disk('public')->delete($bookmarkRibbon->image_path);
            }
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $bookmarkRibbon->image_path = $request->file('image')->storeAs('bookmark_ribbons', $filename, 'public');
        }

        $bookmarkRibbon->name = $request->name;
        $bookmarkRibbon->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $bookmarkRibbon = BookmarkRibbon::findOrFail($id);
        if ($bookmarkRibbon->image_path) {
            Storage::disk('public')->delete($bookmarkRibbon->image_path);
        }
        $bookmarkRibbon->delete();

        return response()->json(['success' => true]);
    }

}
