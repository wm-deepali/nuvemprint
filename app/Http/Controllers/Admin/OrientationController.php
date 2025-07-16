<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orientation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrientationController extends Controller
{
    public function index()
    {
        $orientations = Orientation::latest()->get();
        return view('admin.orientation.index', compact('orientations'));
    }

    public function create()
    {
        $html = view('admin.orientation.create')->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name.*' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors()
            ]);
        }

        foreach ($request->name as $name) {
            Orientation::create(['name' => $name]);
        }

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $orientation = Orientation::find($id);
        if (!$orientation) {
            return response()->json(['success' => false, 'msgText' => 'Record not found']);
        }

        $html = view('admin.orientation.edit', compact('orientation'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $orientation = Orientation::find($id);
        if (!$orientation) {
            return response()->json(['success' => false, 'msgText' => 'Record not found']);
        }

        $orientation->update(['name' => $request->name]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $orientation = Orientation::find($id);
        if (!$orientation) {
            return response()->json(['success' => false, 'msgText' => 'Record not found']);
        }

        $orientation->delete();
        return response()->json(['success' => true]);
    }
}
