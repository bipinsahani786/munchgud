@extends('admin.layouts.app')

@section('title', 'Ticket: ' . $ticket->ticket_number)
@section('header', 'Support Tickets')

@section('content')
<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('admin.tickets.index') }}" class="p-2 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    </a>
    <div>
        <h1 class="text-xl font-bold text-gray-900">{{ $ticket->ticket_number }}</h1>
        <p class="text-xs text-gray-500 font-medium mt-0.5">{{ $ticket->user->name ?? 'Guest' }} · {{ $ticket->user->email ?? '' }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Conversation -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-bold text-gray-900 text-sm">{{ $ticket->subject }}</h2>
                <span class="text-[11px] text-gray-400 font-medium">{{ $ticket->created_at->format('M d, Y H:i A') }}</span>
            </div>
            
            <div class="p-6 space-y-5 max-h-[500px] overflow-y-auto">
                @foreach($ticket->messages as $msg)
                    <div class="flex gap-3 {{ $msg->is_admin_reply ? 'flex-row-reverse' : '' }}">
                        <div class="w-8 h-8 flex-shrink-0 rounded-lg flex items-center justify-center font-bold text-[10px] {{ $msg->is_admin_reply ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ $msg->is_admin_reply ? 'A' : substr($ticket->user->name ?? 'C', 0, 1) }}
                        </div>
                        <div class="max-w-[80%] {{ $msg->is_admin_reply ? 'bg-emerald-50 border border-emerald-100' : 'bg-gray-50 border border-gray-100' }} rounded-xl p-4">
                            <div class="flex items-center justify-between mb-1.5 gap-4">
                                <p class="font-bold text-xs {{ $msg->is_admin_reply ? 'text-emerald-700' : 'text-gray-800' }}">
                                    {{ $msg->is_admin_reply ? 'Admin Support' : ($ticket->user->name ?? 'Customer') }}
                                </p>
                                <span class="text-[10px] text-gray-400 flex-shrink-0">{{ $msg->created_at->format('M d, h:i A') }}</span>
                            </div>
                            <p class="text-sm text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $msg->message }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($ticket->status !== 'closed' && $ticket->status !== 'resolved')
            <div class="p-5 border-t border-gray-100 bg-gray-50/50">
                <form action="{{ route('admin.tickets.reply', $ticket) }}" method="POST">
                    @csrf
                    <textarea name="message" rows="3" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none resize-none mb-3" placeholder="Type your reply..."></textarea>
                    <div class="flex justify-end">
                        <button type="submit" class="px-5 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-gray-800 transition">Send Reply</button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Ticket Details</h3>
            </div>
            <div class="p-6 space-y-5">
                <form action="{{ route('admin.tickets.status', $ticket) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Status</label>
                    <div class="flex gap-2">
                        <select name="status" class="flex-1 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none font-medium">
                            @foreach(['open', 'in_progress', 'resolved', 'closed'] as $s)
                                <option value="{{ $s }}" {{ $ticket->status == $s ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($s)) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="px-4 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-gray-800 transition">Update</button>
                    </div>
                </form>

                <div class="pt-4 border-t border-gray-100">
                    <span class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Priority</span>
                    <span class="px-3 py-1 text-[11px] font-bold uppercase tracking-wide rounded-md border inline-flex
                        {{ $ticket->priority == 'urgent' ? 'bg-red-50 text-red-700 border-red-200' : 'bg-gray-50 text-gray-600 border-gray-200' }}
                    ">{{ $ticket->priority }}</span>
                </div>

                @if($ticket->order_id)
                <div class="pt-4 border-t border-gray-100">
                    <span class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Related Order</span>
                    <a href="{{ route('admin.orders.show', $ticket->order_id) }}" class="font-bold font-mono text-emerald-600 hover:text-emerald-700 text-sm transition">
                        #{{ $ticket->order->order_number ?? $ticket->order_id }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
