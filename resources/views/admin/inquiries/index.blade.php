@extends('admin.layouts.app')

@section('title', 'Contact Inquiries')
@section('header', 'Contact Inquiries')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Contact Inquiries</h1>
        <p class="text-sm font-medium text-gray-500 mt-1">Manage messages sent by customers through the storefront contact form.</p>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 p-4 mb-6">
    <form action="{{ route('admin.inquiries.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or subject..." class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
        </div>
        <div class="w-full sm:w-48">
            <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
            </select>
        </div>
        <button type="submit" class="px-5 py-2 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition text-sm">Filter</button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.inquiries.index') }}" class="px-5 py-2 bg-gray-100 text-gray-600 font-semibold rounded-xl hover:bg-gray-200 transition text-sm flex items-center justify-center">Clear</a>
        @endif
    </form>
</div>

<!-- Data Table -->
<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Status</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Sender</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Subject</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Date</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse($inquiries as $inquiry)
                    <tr class="hover:bg-gray-50/50 transition-colors {{ $inquiry->status === 'unread' ? 'bg-blue-50/30' : '' }}">
                        <td class="px-6 py-4">
                            @if($inquiry->status === 'unread')
                                <span class="px-2.5 py-1 bg-blue-100 text-blue-700 text-[10px] font-bold uppercase tracking-wider rounded-md">Unread</span>
                            @else
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-[10px] font-bold uppercase tracking-wider rounded-md">Read</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900 {{ $inquiry->status === 'unread' ? 'text-black' : '' }}">{{ $inquiry->name }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">{{ $inquiry->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-700 truncate max-w-xs {{ $inquiry->status === 'unread' ? 'text-black' : '' }}" title="{{ $inquiry->subject }}">
                                {{ $inquiry->subject }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-gray-600 font-medium">{{ $inquiry->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-400 mt-0.5">{{ $inquiry->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition" title="View Message">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">No inquiries found</h3>
                                <p class="text-gray-500 text-sm font-medium">When customers send messages via the contact form, they will appear here.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($inquiries->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $inquiries->links() }}
        </div>
    @endif
</div>
@endsection
