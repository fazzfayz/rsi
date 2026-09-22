<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Display a listing of inquiries.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        
        $query = Inquiry::query()->latest();

        if ($status === 'unread') {
            $query->where('is_read', false);
        } elseif ($status === 'read') {
            $query->where('is_read', true);
        }

        $inquiries = $query->paginate(15);
        $unreadCount = Inquiry::where('is_read', false)->count();

        return view('dashboard.inquiries.index', compact('inquiries', 'unreadCount', 'status'));
    }

    /**
     * Display the specified inquiry and mark as read.
     */
    public function show(Inquiry $inquiry)
    {
        if (!$inquiry->is_read) {
            $inquiry->update(['is_read' => true]);
        }

        return view('dashboard.inquiries.show', compact('inquiry'));
    }

    /**
     * Toggle read status.
     */
    public function toggleRead(Inquiry $inquiry)
    {
        $inquiry->update(['is_read' => !$inquiry->is_read]);

        return back()->with('success', 'Status inquiry berhasil diperbarui.');
    }

    /**
     * Remove the specified inquiry from storage.
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()->route('inquiries.index')->with('success', 'Data inquiry berhasil dihapus.');
    }
}
