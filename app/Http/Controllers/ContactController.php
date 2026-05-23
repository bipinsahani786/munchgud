<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactInquiry;

class ContactController extends Controller
{
    public function show() {
        return view('pages.contact');
    }

    public function send(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|max:200',
            'message' => 'required|string',
        ]);

        ContactInquiry::create($validated);
        
        return back()->with('success', 'Your message has been sent successfully. We will get back to you soon.');
    }
}
