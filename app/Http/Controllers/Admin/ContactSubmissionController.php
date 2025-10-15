<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ContactSubmissionController extends Controller
{
    /**
     * Display a listing of contact submissions
     */
    public function index()
    {
        $submissions = DB::table('contact_submissions')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return Inertia::render('Admin/ContactSubmissions/Index', [
            'submissions' => $submissions
        ]);
    }

    /**
     * Display the specified contact submission
     */
    public function show($id)
    {
        $submission = DB::table('contact_submissions')
            ->where('id', $id)
            ->first();

        if (!$submission) {
            return redirect()->route('admin.contact-submissions.index')
                ->with('error', 'Submission not found');
        }

        // Mark as read
        DB::table('contact_submissions')
            ->where('id', $id)
            ->update(['is_read' => true]);

        return Inertia::render('Admin/ContactSubmissions/Show', [
            'submission' => $submission
        ]);
    }

    /**
     * Delete the specified contact submission
     */
    public function destroy($id)
    {
        DB::table('contact_submissions')
            ->where('id', $id)
            ->delete();

        return redirect()->route('admin.contact-submissions.index')
            ->with('success', 'Submission deleted successfully');
    }

    /**
     * Mark submission as read
     */
    public function markAsRead($id)
    {
        DB::table('contact_submissions')
            ->where('id', $id)
            ->update(['is_read' => true]);

        return back()->with('success', 'Marked as read');
    }

    /**
     * Mark submission as unread
     */
    public function markAsUnread($id)
    {
        DB::table('contact_submissions')
            ->where('id', $id)
            ->update(['is_read' => false]);

        return back()->with('success', 'Marked as unread');
    }
}
