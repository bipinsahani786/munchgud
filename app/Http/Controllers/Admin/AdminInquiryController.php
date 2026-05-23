<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactInquiry;

class AdminInquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactInquiry::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $inquiries = $query->latest()->paginate(20)->withQueryString();
        
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(ContactInquiry $inquiry)
    {
        if ($inquiry->status === 'unread') {
            $inquiry->update(['status' => 'read']);
        }
        
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function destroy(ContactInquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }
}
