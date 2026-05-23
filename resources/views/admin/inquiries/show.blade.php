@extends('admin.layouts.app')

@section('title', 'View Inquiry')
@section('header', 'Inquiry Details')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <a href="{{ route('admin.inquiries.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-900 transition mb-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Inquiries
        </a>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">{{ $inquiry->subject }}</h1>
    </div>
    
    <div class="flex items-center gap-3">
        <a href="mailto:{{ $inquiry->email }}" class="flex items-center gap-2 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-xl text-sm font-medium transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Reply via Email
        </a>
        
        <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="flex items-center gap-2 bg-red-50 text-red-600 hover:bg-red-100 px-4 py-2 rounded-xl text-sm font-medium transition border border-red-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Delete
            </button>
        </form>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50/50">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-500 text-lg">
                {{ strtoupper(substr($inquiry->name, 0, 1)) }}
            </div>
            <div>
                <h3 class="text-base font-bold text-gray-900">{{ $inquiry->name }}</h3>
                <p class="text-sm font-medium text-gray-500">{{ $inquiry->email }}</p>
            </div>
        </div>
        <div class="text-right">
            <p class="text-sm font-medium text-gray-900">{{ $inquiry->created_at->format('F d, Y') }}</p>
            <p class="text-xs text-gray-500">{{ $inquiry->created_at->format('h:i A') }} ({{ $inquiry->created_at->diffForHumans() }})</p>
        </div>
    </div>
    <div class="p-6 md:p-8">
        <div class="prose max-w-none text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $inquiry->message }}</div>
    </div>
</div>
@endsection
