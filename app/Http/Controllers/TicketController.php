<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function storeReply(Request $request, $ticket_id)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    // Dynamically grab who sent the message from the form, fallback to 'Customer' if empty
    $sender = $request->input('sender_type', 'Customer'); 

    // 1. Save the actual message
    DB::table('customer_conversations')->insert([
        'ticket_id'          => $ticket_id,
        'sender'             => $sender,
        'communication_type' => 'Chat',
        'message'            => $request->input('message'),
        'sent_at'            => now(),
        'created_at'         => now(),
    ]);

    // 2. AUTOMATED RESPONSE: Trigger ONLY if the sender is a Customer
    if ($sender === 'Customer') {
        DB::table('customer_conversations')->insert([
            'ticket_id'          => $ticket_id,
            'sender'             => 'System', 
            'communication_type' => 'Chat',
            'message'            => "Thank you for reaching out! We have successfully received your reply for Ticket #{$ticket_id}. An agent will review it shortly.",
            'sent_at'            => now()->addSecond(), 
            'created_at'         => now(),
        ]);
    }

    return redirect()->back()->with('success', 'Reply sent successfully!');
}
}