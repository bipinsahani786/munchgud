<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\SupportTicketMessage;
use App\Models\ActivityLog;

class AdminSupportTicketController extends Controller
{
    public function index(Request $request) {
        $query = SupportTicket::with('user');
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        $tickets = $query->latest('updated_at')->paginate(20);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(SupportTicket $ticket) {
        $ticket->load(['user', 'order', 'messages.user']);
        return view('admin.tickets.show', compact('ticket'));
    }

    public function reply(Request $request, SupportTicket $ticket) {
        $request->validate(['message' => 'required|string']);

        $ticket->messages()->create([
            'user_id' => auth('admin')->id() ?? auth()->id() ?? 1, // fallback to 1 if no admin guard
            'message' => $request->message,
            'is_admin_reply' => true
        ]);

        if ($ticket->status === 'open') {
            $ticket->update(['status' => 'in_progress']);
        }
        $ticket->touch(); // Update updated_at for sorting

        ActivityLog::log('Replied to Ticket', "Replied to ticket #{$ticket->ticket_number}");

        return back()->with('success', 'Reply sent successfully.');
    }

    public function updateStatus(Request $request, SupportTicket $ticket) {
        $request->validate(['status' => 'required|in:open,in_progress,resolved,closed']);
        
        $ticket->update(['status' => $request->status]);
        
        ActivityLog::log('Updated Ticket Status', "Updated ticket #{$ticket->ticket_number} to {$request->status}");

        return back()->with('success', 'Ticket status updated.');
    }
}
