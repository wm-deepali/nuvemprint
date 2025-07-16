<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaperSize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ManagePaperSizeController extends Controller
{
    public function index()
    {
        $paperSizes = PaperSize::all();
        return view('admin.manage-paper-size.index', compact('paperSizes'));
    }

    public function create()
    {
        return response()->json([
            'success' => true,
            'html' => view('admin.manage-paper-size.create')->render()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|array|min:1',
            'name.*' => 'required|string|max:255|distinct',
            'dimensions' => 'required|array|min:1',
            'dimensions.*' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);

        }

        $count = count($request->name);
        $data = [];

        for ($i = 0; $i < $count; $i++) {
            $data[] = [
                'name' => $request->name[$i],
                'dimensions' => $request->dimensions[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        PaperSize::insert($data);

        return response()->json(['success' => true]);
    }


    public function edit($id)
    {
        $paperSize = PaperSize::findOrFail($id);
        return response()->json([
            'success' => true,
            'html' => view('admin.manage-paper-size.edit', compact('paperSize'))->render()
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:paper_sizes,name,' . $id,
            'dimensions' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
        PaperSize::findOrFail($id)->update($request->only(['name', 'dimensions']));

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        PaperSize::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}

