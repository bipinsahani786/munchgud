<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportTicketMessage;
use Illuminate\Support\Str;

class SupportTicketController extends Controller
{
    public function index() {
        $tickets = auth()->user()->supportTickets()->latest()->paginate(10);
        return view('storefront.account.tickets.index', compact('tickets'));
    }

    public function create() {
        $orders = auth()->user()->orders()->latest()->get();
        return view('storefront.account.tickets.create', compact('orders'));
    }

    public function store(Request $request) {
        $request->validate([
            'subject' => 'required|string|max:255',
            'order_id' => 'nullable|exists:orders,id',
            'priority' => 'required|in:low,medium,high,urgent',
            'message' => 'required|string'
        ]);

        $ticket = SupportTicket::create([
            'user_id' => auth()->id(),
            'order_id' => $request->order_id,
            'ticket_number' => 'TKT-' . strtoupper(Str::random(8)),
            'subject' => $request->subject,
            'priority' => $request->priority,
            'status' => 'open'
        ]);

        $ticket->messages()->create([
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);

        return redirect()->route('account.tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(SupportTicket $ticket) {
        if ($ticket->user_id !== auth()->id()) abort(403);
        
        $ticket->load('messages.user', 'messages.admin');
        return view('storefront.account.tickets.show', compact('ticket'));
    }

    public function reply(Request $request, SupportTicket $ticket) {
        if ($ticket->user_id !== auth()->id()) abort(403);

        $request->validate(['message' => 'required|string']);

        $ticket->messages()->create([
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);

        return back()->with('success', 'Reply sent successfully.');
    }
}
