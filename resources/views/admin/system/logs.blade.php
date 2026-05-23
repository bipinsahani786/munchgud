@extends('admin.layouts.app')

@section('title', 'Log Monitoring')
@section('header', 'System Logs')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <p class="text-sm text-gray-500">Monitor the latest application logs for troubleshooting and debugging.</p>
    </div>
    
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.system.logs') }}" class="flex items-center gap-2 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-xl text-sm font-medium transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            Refresh
        </a>
        
        <form action="{{ route('admin.system.logs.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear all logs? This cannot be undone.');">
            @csrf
            <button type="submit" class="flex items-center gap-2 bg-red-50 text-red-600 hover:bg-red-100 px-4 py-2 rounded-xl text-sm font-medium transition border border-red-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Clear Logs
            </button>
        </form>
    </div>
</div>

<div class="bg-gray-900 rounded-2xl shadow-sm border border-gray-800 overflow-hidden">
    <div class="px-4 py-3 border-b border-gray-700 flex items-center gap-2 bg-gray-800">
        <div class="w-3 h-3 rounded-full bg-red-500"></div>
        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
        <div class="w-3 h-3 rounded-full bg-green-500"></div>
        <span class="ml-2 text-xs font-mono text-gray-400">storage/logs/laravel.log</span>
    </div>
    <div class="p-4 overflow-x-auto overflow-y-auto" style="height: 600px;">
        <pre class="text-sm font-mono text-gray-300 whitespace-pre-wrap break-words leading-relaxed">{{ $logs }}</pre>
    </div>
</div>
@endsection
