<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show() {
        return view('pages.contact');
    }

    public function send(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|max:200',
            'message' => 'required|string',
        ]);

        // Send email to admin (Implementation for later)
        
        return back()->with('success', 'Your message has been sent successfully. We will get back to you soon.');
    }
}
