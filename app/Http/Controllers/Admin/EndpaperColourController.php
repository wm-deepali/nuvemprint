<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EndpaperColour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EndpaperColourController extends Controller
{
    public function index()
    {
        $endpaperColours = EndpaperColour::all();
        return view('admin.manage-endpaper-colour.index', compact('endpaperColours'));
    }


    public function create()
    {
        $html = view('admin.manage-endpaper-colour.create')->render();
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

        $endpaperColours = [];

        foreach ($request->name as $index => $name) {
            $imagePath = null;

            if ($request->hasFile("image.$index")) {
                $file = $request->file("image")[$index];
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $imagePath = $file->storeAs('endpaper_colours', $filename, 'public');
            }

            $endpaperColours[] = [
                'name' => $name,
                'image_path' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        EndpaperColour::insert($endpaperColours);

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $endpaperColour = EndpaperColour::findOrFail($id);
        $html = view('admin.manage-endpaper-colour.edit', compact('endpaperColour'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $endpaperColour = EndpaperColour::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:endpaper_colours,name,' . $id,
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
            if ($endpaperColour->image_path) {
                Storage::disk('public')->delete($endpaperColour->image_path);
            }
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $endpaperColour->image_path = $request->file('image')->storeAs('endpaper_colours', $filename, 'public');
        }

        $endpaperColour->name = $request->name;
        $endpaperColour->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $endpaperColour = EndpaperColour::findOrFail($id);
        if ($endpaperColour->image_path) {
            Storage::disk('public')->delete($endpaperColour->image_path);
        }
        $endpaperColour->delete();

        return response()->json(['success' => true]);
    }

}


