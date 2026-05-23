@extends('admin.layouts.app')

@section('title', 'Support Tickets')
@section('header', 'Support Tickets')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Support Tickets</h1>
        <p class="text-sm text-gray-500 font-medium mt-0.5">Manage customer issues and inquiries.</p>
    </div>
    <!-- Status Tabs -->
    <div class="flex items-center gap-1.5 bg-gray-100 p-1 rounded-xl">
        <a href="{{ route('admin.tickets.index') }}" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg transition {{ !request('status') ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">All</a>
        <a href="{{ route('admin.tickets.index', ['status'=>'open']) }}" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg transition {{ request('status')=='open' ? 'bg-white text-blue-700 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">Open</a>
        <a href="{{ route('admin.tickets.index', ['status'=>'in_progress']) }}" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg transition {{ request('status')=='in_progress' ? 'bg-white text-amber-700 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">In Progress</a>
        <a href="{{ route('admin.tickets.index', ['status'=>'resolved']) }}" class="px-3.5 py-1.5 text-xs font-semibold rounded-lg transition {{ request('status')=='resolved' ? 'bg-white text-emerald-700 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">Resolved</a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Ticket #</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Customer</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Subject</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Priority</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Status</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Updated</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse($tickets as $ticket)
                    <tr class="hover:bg-gray-50/50 transition-colors group cursor-pointer" onclick="window.location='{{ route('admin.tickets.show', $ticket) }}'">
                        <td class="px-6 py-4">
                            <span class="font-bold text-gray-900 group-hover:text-emerald-600 transition font-mono text-sm">{{ $ticket->ticket_number }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 font-bold text-[10px]">
                                    {{ substr($ticket->user->name ?? 'G', 0, 1) }}
                                </div>
                                <span class="font-medium text-gray-900 text-sm">{{ $ticket->user->name ?? 'Guest' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-gray-800">{{ Str::limit($ticket->subject, 35) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-md border
                                {{ $ticket->priority == 'urgent' ? 'bg-red-50 text-red-700 border-red-200' : '' }}
                                {{ $ticket->priority == 'high' ? 'bg-orange-50 text-orange-700 border-orange-200' : '' }}
                                {{ !in_array($ticket->priority, ['urgent','high']) ? 'bg-gray-50 text-gray-600 border-gray-200' : '' }}
                            ">
                                {{ $ticket->priority }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 inline-flex text-[11px] leading-5 font-bold rounded-full border 
                                {{ $ticket->status === 'resolved' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : '' }}
                                {{ $ticket->status === 'open' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                {{ $ticket->status === 'in_progress' ? 'bg-amber-50 text-amber-700 border-amber-200' : '' }}
                                {{ $ticket->status === 'closed' ? 'bg-gray-50 text-gray-600 border-gray-200' : '' }}
                            ">
                                <span class="w-1.5 h-1.5 rounded-full mr-1.5 mt-1.5
                                    {{ $ticket->status === 'resolved' ? 'bg-emerald-500' : '' }}
                                    {{ $ticket->status === 'open' ? 'bg-blue-500 animate-pulse' : '' }}
                                    {{ $ticket->status === 'in_progress' ? 'bg-amber-500' : '' }}
                                    {{ $ticket->status === 'closed' ? 'bg-gray-400' : '' }}
                                "></span>
                                {{ str_replace('_', ' ', ucfirst($ticket->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-xs text-gray-400 font-medium">{{ $ticket->updated_at->diffForHumans() }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                                </div>
                                <h3 class="text-base font-bold text-gray-900 mb-1">No tickets found</h3>
                                <p class="text-gray-500 text-sm">All clear! No support tickets to show.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($tickets->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $tickets->links() }}
        </div>
    @endif
</div>
@endsection
