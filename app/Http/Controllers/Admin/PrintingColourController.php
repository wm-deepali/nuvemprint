<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrintingColour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrintingColourController extends Controller
{
    public function index()
    {
        $printColours = PrintingColour::latest()->get();
        return view('admin.print-colour.index', compact('printColours'));
    }

    public function create()
    {
        $html = view('admin.print-colour.create')->render();
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
            PrintingColour::create(['name' => $name]);
        }

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $printColour = PrintingColour::find($id);

        if (!$printColour) {
            return response()->json(['success' => false, 'msgText' => 'Record not found']);
        }

        $html = view('admin.print-colour.edit', compact('printColour'))->render();
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

        $printColour = PrintingColour::find($id);
        if (!$printColour) {
            return response()->json(['success' => false, 'msgText' => 'Record not found']);
        }

        $printColour->update([
            'name' => $request->name
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $printColour = PrintingColour::find($id);
        if (!$printColour) {
            return response()->json(['success' => false, 'msgText' => 'Record not found']);
        }

        $printColour->delete();
        return response()->json(['success' => true]);
    }
}
