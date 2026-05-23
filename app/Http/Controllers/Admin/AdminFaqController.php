<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\ActivityLog;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('sort_order', 'asc')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'nullable|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $request->input('sort_order', 0);

        Faq::create($validated);

        ActivityLog::log('Created FAQ', "Added new FAQ: {$validated['question']}");

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.form', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'category' => 'nullable|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $faq->update($validated);

        ActivityLog::log('Updated FAQ', "Updated FAQ: {$faq->question}");

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $question = $faq->question;
        $faq->delete();

        ActivityLog::log('Deleted FAQ', "Deleted FAQ: {$question}");

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
