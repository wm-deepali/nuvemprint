<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ContactSubmissionController extends Controller
{
    /**
     * Display a listing of contact submissions.
     */
    public function index()
    {
        $submissions = ContactMessage::latest()->paginate(10);

        return view('admin.contact_submissions.index', compact('submissions'));
    }

    /**
     * Display the specified submission details (used for modal view).
     */
    public function show($id)
    {
        $submission = ContactMessage::findOrFail($id);

        $html = View::make('admin.contact_submissions.view', compact('submission'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
        ]);
    }

    /**
     * Remove the specified submission from storage.
     */
    public function destroy($id)
    {
        $submission = ContactMessage::findOrFail($id);
        $submission->delete();

        return response()->json(['success' => true]);
    }
}
