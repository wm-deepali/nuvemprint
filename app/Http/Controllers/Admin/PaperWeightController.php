<?php

// app/Http/Controllers/Admin/PaperWeightController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaperWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaperWeightController extends Controller
{
    public function index()
    {
        $paperWeights = PaperWeight::all();
        return view('admin.paper-weight.index', compact('paperWeights'));
    }

    public function create()
    {
        return response()->json([
            'success' => true,
            'html' => view('admin.paper-weight.create')->render()
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
            PaperWeight::create([
                'gsm' => $gsm,
                'status' => 'active',
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $paperWeight = PaperWeight::findOrFail($id);
        return response()->json([
            'success' => true,
            'html' => view('admin.paper-weight.edit', compact('paperWeight'))->render()
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
           'gsm' => 'required|string|max:255|unique:paper_weights,gsm,' . $id . ',id',

        ]);
         if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors()
            ]);
        }
        $paperWeight = PaperWeight::findOrFail($id);
        $paperWeight->update([
            'gsm' => $request->gsm,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        PaperWeight::destroy($id);
        return response()->json(['success' => true]);
    }
}
