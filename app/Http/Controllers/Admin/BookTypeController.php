<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookTypeController extends Controller
{
    public function index()
    {
        $bookTypes = BookType::latest()->get();
        return view('admin.book-type.index', compact('bookTypes'));
    }


    public function create()
    {
        try {
            return response()->json([
                "success" => true,
                "html" => view('admin.book-type.create')->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|array|min:1',
            'name.*' => 'required|string|max:255|distinct',
            'image' => 'nullable|array',
            'image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        $bookType = [];
        $names = $request->name;
        $images = $request->file('image', []); // default to empty array

        foreach ($names as $index => $name) {
            $path = null;

            if (isset($images[$index]) && $images[$index]->isValid()) {
                $file = $images[$index];
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('book-type', $filename, 'public');
            }

            $bookType[] = [
                'name' => $name,
                'image' => $path,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        BookType::insert($bookType);

        return response()->json(['success' => true, 'message' => 'bookType created successfully.']);
    }

    public function edit($id)
    {
        $bookType = BookType::find($id);

        if (!$bookType) {
            return response()->json([
                'success' => false,
                'msgText' => 'Book Type not found.',
            ]);
        }

        $html = view('admin.book-type.edit', compact('bookType'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
        ]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:book_types,name,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        $bookType = BookType::findOrFail($id);
        $updateData = [
            'name' => $request->name,
        ];

        // Handle new image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Optional: delete old image
            if ($bookType->image && \Storage::disk('public')->exists($bookType->image)) {
                \Storage::disk('public')->delete($bookType->image);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('book-type', $filename, 'public');
            $updateData['image'] = $path;
        }

        $bookType->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Book type updated successfully.',
        ]);
    }

    public function destroy($id)
    {
        $bookType = BookType::findOrFail($id);
        $bookType->delete();
        return response()->json(['success' => true, 'message' => 'Deleted successfully.']);
    }
}
