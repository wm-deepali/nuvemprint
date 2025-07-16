<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DustJacketColour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DustJacketColourController extends Controller
{
    public function index()
    {
        $dustColours = DustJacketColour::latest()->get();
        return view('admin.dust-jacket-colour.index', compact('dustColours'));
    }

    public function create()
    {
        $html = view('admin.dust-jacket-colour.create')->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name.*' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        foreach ($request->name as $name) {
            DustJacketColour::create(['name' => $name]);
        }

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $dustColour = DustJacketColour::find($id);
        if (!$dustColour) {
            return response()->json(['success' => false, 'msgText' => 'Record not found']);
        }

        $html = view('admin.dust-jacket-colour.edit', compact('dustColour'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $dustColour = DustJacketColour::find($id);
        if (!$dustColour) {
            return response()->json(['success' => false, 'msgText' => 'Record not found']);
        }

        $dustColour->update(['name' => $request->name]);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $dustColour = DustJacketColour::find($id);
        if (!$dustColour) {
            return response()->json(['success' => false, 'msgText' => 'Record not found']);
        }

        $dustColour->delete();
        return response()->json(['success' => true]);
    }
}

