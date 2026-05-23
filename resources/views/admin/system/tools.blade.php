@extends('admin.layouts.app')

@section('title', 'System Tools')
@section('header', 'System Tools')

@section('content')
<div class="mb-6">
    <p class="text-sm text-gray-500">Run essential system maintenance commands directly from the dashboard.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    
    <!-- Storage Link -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col h-full">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Storage Link</h3>
        <p class="text-sm text-gray-500 mb-6 flex-1">Create a symbolic link from "public/storage" to "storage/app/public" to make user uploaded files publicly accessible.</p>
        
        <form action="{{ route('admin.system.tools.run') }}" method="POST">
            @csrf
            <input type="hidden" name="tool" value="storage:link">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-xl transition flex items-center justify-center gap-2">
                Run Command
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </button>
        </form>
    </div>

    <!-- Optimize Clear -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col h-full">
        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Clear Config & Routes</h3>
        <p class="text-sm text-gray-500 mb-6 flex-1">Clear the configuration, route, and view caches. Useful after making `.env` or route changes.</p>
        
        <form action="{{ route('admin.system.tools.run') }}" method="POST">
            @csrf
            <input type="hidden" name="tool" value="optimize:clear">
            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-medium py-2.5 px-4 rounded-xl transition flex items-center justify-center gap-2">
                Run Command
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </button>
        </form>
    </div>

    <!-- Cache Clear -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col h-full">
        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Clear Application Cache</h3>
        <p class="text-sm text-gray-500 mb-6 flex-1">Flush the entire application cache. Use this to clear temporarily stored application data.</p>
        
        <form action="{{ route('admin.system.tools.run') }}" method="POST">
            @csrf
            <input type="hidden" name="tool" value="cache:clear">
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2.5 px-4 rounded-xl transition flex items-center justify-center gap-2">
                Run Command
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </button>
        </form>
    </div>

</div>
@endsection
