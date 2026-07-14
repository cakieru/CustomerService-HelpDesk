<?php

use Illuminate\Support\Facades\Route;

// Home / Landing Redirection (Maps to Customer Portal)
Route::get('/', function () {
    return view('portal');
})->name('home');

// Agent Portal - Dashboard List View
Route::get('/agent', function () {
    return view('agent'); // This renders agent.blade.php (the layout with the data table)
})->name('agent');

// Agent Portal - Single Ticket Detail View
Route::get('/agent/ticket-details', function () {
    return view('details'); // This renders details.blade.php (the agent side detail layout)
})->name('agent.ticket.details');


// Customer Portal - Home Dashboard Layout
Route::get('/customer', function () {
    return view('portal'); // Renders portal.blade.php
})->name('customer');

// Customer Portal - My Tickets List View
Route::get('/tickets', function () {
    return view('tickets'); // Renders tickets.blade.php
})->name('tickets');

// Customer Portal - Individual Ticket Details View
Route::get('/ticket-details', function () {
    return view('customerTicket'); // Renders customerTicket.blade.php
})->name('ticket.details');


// Terms & Conditions Static Informational Page
Route::get('/terms', function () {
    return view('terms'); // Renders terms.blade.php
})->name('terms');

use Illuminate\Support\Facades\DB;

Route::get('/test-db', function () {
    try {
        $tickets = DB::table('support_tickets')->get();
        return response()->json($tickets);
    } catch (\Exception $e) {
        return "Connection failed: " . $e->getMessage();
    }
});

use App\Http\Controllers\TicketController;

// Form Route to submit a reply message
Route::post('/tickets/{ticket_id}/reply', [TicketController::class, 'storeReply'])->name('tickets.reply');