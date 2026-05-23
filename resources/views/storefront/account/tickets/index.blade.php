@extends('storefront.account.layout')

@section('account_content')
<div class="flex items-center justify-between mb-8">
    <h2 class="font-heading text-3xl font-bold text-mg-dark">Support Tickets</h2>
    <a href="{{ route('account.tickets.create') }}" class="bg-mg-green text-white font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-mg-green-dark transition-all flex items-center gap-2">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round"/></svg>
        New Ticket
    </a>
</div>

<div class="bg-white rounded-3xl p-8 border border-mg-dark/5 shadow-xl shadow-mg-dark/5">
    @if($tickets->isEmpty())
        <div class="text-center py-10">
            <p class="text-mg-muted mb-4">You have no active support tickets.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($tickets as $ticket)
                <a href="{{ route('account.tickets.show', $ticket->id) }}" class="block p-5 rounded-2xl border border-mg-dark/5 hover:border-mg-green/30 transition-colors group">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-xs font-bold font-mono text-mg-muted">{{ $ticket->ticket_number }}</span>
                                <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-full 
                                    {{ $ticket->status === 'resolved' || $ticket->status === 'closed' ? 'bg-green-100 text-green-700' : 
                                       ($ticket->status === 'open' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700') }}">
                                    {{ str_replace('_', ' ', $ticket->status) }}
                                </span>
                                @if($ticket->priority === 'urgent' || $ticket->priority === 'high')
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-full bg-red-100 text-red-700">
                                        {{ $ticket->priority }}
                                    </span>
                                @endif
                            </div>
                            <h4 class="font-bold text-sm text-mg-dark group-hover:text-mg-green transition-colors">{{ $ticket->subject }}</h4>
                            @if($ticket->order_id)
                                <p class="text-xs text-mg-muted mt-1">Related to Order: #{{ $ticket->order->order_number }}</p>
                            @endif
                        </div>
                        <div class="text-left md:text-right">
                            <p class="text-xs text-mg-muted font-medium mb-1">Updated {{ $ticket->updated_at->diffForHumans() }}</p>
                            <span class="text-sm font-semibold text-mg-green flex items-center md:justify-end gap-1">
                                View Ticket &rarr;
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $tickets->links() }}
        </div>
    @endif
</div>
@endsection
