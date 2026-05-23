@extends('storefront.account.layout')

@section('account_content')
<div class="flex items-center justify-between mb-8">
    <h2 class="font-heading text-3xl font-bold text-mg-dark">Ticket {{ $ticket->ticket_number }}</h2>
    <a href="{{ route('account.tickets.index') }}" class="text-sm font-semibold text-mg-muted hover:text-mg-green flex items-center gap-1">
        &larr; Back
    </a>
</div>

<div class="bg-white rounded-3xl p-6 md:p-8 border border-mg-dark/5 shadow-xl shadow-mg-dark/5 mb-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 pb-8 border-b border-mg-dark/5">
        <div>
            <h3 class="font-bold text-lg text-mg-dark mb-2">{{ $ticket->subject }}</h3>
            <div class="flex items-center gap-3">
                <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-full 
                    {{ $ticket->status === 'resolved' || $ticket->status === 'closed' ? 'bg-green-100 text-green-700' : 
                       ($ticket->status === 'open' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700') }}">
                    {{ str_replace('_', ' ', $ticket->status) }}
                </span>
                <span class="text-xs font-semibold text-mg-muted">Priority: <span class="capitalize text-mg-dark">{{ $ticket->priority }}</span></span>
            </div>
        </div>
        @if($ticket->order_id)
            <div class="bg-mg-cream p-4 rounded-xl border border-mg-dark/5 text-right">
                <p class="text-[10px] font-bold text-mg-muted uppercase tracking-wider mb-1">Related Order</p>
                <a href="{{ route('account.orders.show', $ticket->order_id) }}" class="font-mono text-sm font-bold text-mg-green hover:underline">#{{ $ticket->order->order_number }}</a>
            </div>
        @endif
    </div>

    <div class="space-y-6 mb-8">
        @foreach($ticket->messages as $msg)
            <div class="flex gap-4 {{ $msg->is_admin_reply ? 'flex-row-reverse' : '' }}">
                <div class="w-10 h-10 flex-shrink-0 rounded-full flex items-center justify-center font-bold text-white text-sm shadow-inner
                    {{ $msg->is_admin_reply ? 'bg-mg-dark' : 'bg-mg-green' }}">
                    {{ $msg->is_admin_reply ? 'MG' : substr($msg->user->name, 0, 1) }}
                </div>
                <div class="max-w-[80%] {{ $msg->is_admin_reply ? 'bg-mg-cream border border-mg-dark/5' : 'bg-mg-green/5 border border-mg-green/10' }} rounded-2xl p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <p class="font-bold text-xs {{ $msg->is_admin_reply ? 'text-mg-dark' : 'text-mg-green' }}">
                            {{ $msg->is_admin_reply ? 'MunchGud Support' : 'You' }}
                        </p>
                        <span class="text-[10px] text-mg-muted">{{ $msg->created_at->format('M d, h:i A') }}</span>
                    </div>
                    <p class="text-sm text-mg-dark/80 whitespace-pre-wrap">{{ $msg->message }}</p>
                </div>
            </div>
        @endforeach
    </div>

    @if($ticket->status !== 'closed' && $ticket->status !== 'resolved')
        <form action="{{ route('account.tickets.reply', $ticket->id) }}" method="POST" class="pt-6 border-t border-mg-dark/5">
            @csrf
            <div class="mb-4">
                <textarea name="message" required rows="3" class="w-full bg-white border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20" placeholder="Type your reply here..."></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-mg-green text-white font-bold px-6 py-2.5 rounded-xl hover:bg-mg-green-dark transition-all flex items-center gap-2">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Send Reply
                </button>
            </div>
        </form>
    @else
        <div class="bg-green-50 border border-green-200 text-green-800 rounded-2xl p-4 text-center text-sm font-medium">
            This ticket is marked as {{ $ticket->status }}. You cannot reply to this ticket.
        </div>
    @endif
</div>
@endsection
