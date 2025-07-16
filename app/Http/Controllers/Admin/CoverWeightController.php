<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoverWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoverWeightController extends Controller
{
    public function index()
    {
        $coverWeights = CoverWeight::all();
        return view('admin.cover-weight.index', compact('coverWeights'));
    }

    public function create()
    {
        return response()->json([
            'success' => true,
            'html' => view('admin.cover-weight.create')->render()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gsm' => 'required|array|min:1',
            'gsm.*' => 'required|string|distinct|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors()
            ]);
        }

        foreach ($request->gsm as $gsm) {
            CoverWeight::create([
                'gsm' => $gsm,
                'status' => 'active',
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $coverWeight = CoverWeight::findOrFail($id);
        return response()->json([
            'success' => true,
            'html' => view('admin.cover-weight.edit', compact('coverWeight'))->render()
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
           'gsm' => 'required|string|max:255|unique:cover_weights,gsm,' . $id . ',id',

        ]);
         if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors()
            ]);
        }
        $coverWeight = CoverWeight::findOrFail($id);
        $coverWeight->update([
            'gsm' => $request->gsm,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        CoverWeight::destroy($id);
        return response()->json(['success' => true]);
    }
}
