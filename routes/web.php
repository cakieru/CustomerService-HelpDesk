<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Route::get('/', function () {
    return view('hello');
});

// UPDATED: Now fetches the articles dynamically for the Customer Portal view
Route::get('/CustomerPortal', function () {
    // 1. Fetch from database - customers should only ever see publicly-visible articles
    $dbArticles = DB::table('kb_articles')
        ->where('visibility', 'public')
        ->get();

    // 2. Format the columns to match your JavaScript properties
    $articles = $dbArticles->map(function($article) {
        return [
            'id' => $article->id,
            'title' => $article->title,
            'desc' => $article->desc,
            'category' => $article->category,
            'catId' => $article->cat_id,
            'views' => number_format($article->views),
            'updated' => \Carbon\Carbon::parse($article->updated_at)->format('m/d/Y'),
            'helpful' => $article->yes_votes + $article->no_votes > 0 
                ? round(($article->yes_votes / ($article->yes_votes + $article->no_votes)) * 100) . '%' 
                : '100%',
            'tags' => explode(',', $article->tags),
            'yesVotes' => $article->yes_votes,
            'noVotes' => $article->no_votes,
        ];
    });

    // 3. Fetch this customer's support tickets
    $tickets = collect();
    if (auth()->check()) {
        $tickets = DB::table('support_tickets')
            ->where('customer_id', auth()->id())
            ->orderByDesc('updated_at')
            ->get()
            ->map(function ($ticket) {
                return [
                    'id' => $ticket->ticket_number,
                    'subject' => $ticket->subject,
                    'category' => $ticket->category,
                    'status' => $ticket->status,
                    'updated' => \Carbon\Carbon::parse($ticket->updated_at)->diffForHumans(),
                    'agent' => $ticket->agent_id
                        ? DB::table('users')->where('id', $ticket->agent_id)->value('name')
                        : null,
                ];
            });
    }

    // 4. Pass it all to the view
    return view('CustomerPortal', compact('articles', 'tickets'));
})->name('CustomerPortal');

// Save a new support ticket submitted from the New Request form
Route::post('/support-tickets', function (Illuminate\Http\Request $request) {
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'category' => 'required|string',
        'priority' => 'required|string',
        'subject' => 'required|string',
        'description' => 'required|string',
        'orderNumber' => 'nullable|string',
    ]);

    if (!auth()->check()) {
        return response()->json(['message' => 'You must be logged in to submit a ticket.'], 401);
    }

    $lastId = DB::table('support_tickets')->max('id') ?? 0;
    $ticketNumber = 'TKT-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

    DB::table('support_tickets')->insert([
        'ticket_number' => $ticketNumber,
        'customer_id' => auth()->id(),
        'subject' => $request->subject,
        'description' => $request->description,
        'category' => $request->category,
        'priority' => $request->priority,
        'status' => 'open',
        'order_number' => $request->orderNumber,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
        'id' => $ticketNumber,
        'subject' => $request->subject,
        'category' => $request->category,
        'status' => 'open',
        'agent' => null,
    ]);
})->middleware('auth');

// Knowledge Base Routes (Explicit strings to prevent editor confusion)
Route::get('/KnowledgeBase', ['App\Http\Controllers\KnowledgeBaseController', 'index'])->name('KnowledgeBase');
Route::get('/SelfServicePortal', ['App\Http\Controllers\KnowledgeBaseController', 'index']);
Route::get('/knowledge-base', ['App\Http\Controllers\KnowledgeBaseController', 'index'])->name('kb.index');
Route::post('/knowledge-base/store', ['App\Http\Controllers\KnowledgeBaseController', 'store'])->name('kb.store');
Route::put('/knowledge-base/{id}', ['App\Http\Controllers\KnowledgeBaseController', 'update'])->name('kb.update');
Route::post('/knowledge-base/{id}/vote', ['App\Http\Controllers\KnowledgeBaseController', 'vote'])->name('kb.vote');
Route::post('/knowledge-base/{id}/view', ['App\Http\Controllers\KnowledgeBaseController', 'incrementView'])->name('kb.view');

// Save a new support ticket submitted from the New Request form
Route::post('/support-tickets', function (Illuminate\Http\Request $request) {
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'category' => 'required|string',
        'priority' => 'required|string',
        'subject' => 'required|string',
        'description' => 'required|string',
        'orderNumber' => 'nullable|string',
    ]);

    $lastId = DB::table('support_tickets')->max('id') ?? 0;
    $ticketNumber = 'TKT-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

    DB::table('support_tickets')->insert([
        'ticket_number' => $ticketNumber,
        'customer_id' => auth()->check() ? auth()->id() : null, // Set to null if not logged in
        'subject' => $request->subject,
        'description' => $request->description,
        'category' => $request->category,
        'priority' => $request->priority,
        'status' => 'open',
        'order_number' => $request->orderNumber,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json([
        'id' => $ticketNumber,
        'subject' => $request->subject,
        'category' => $request->category,
        'status' => 'open',
        'agent' => null,
    ]);
}); // <-- REMOVED ->middleware('auth') here so unauthenticated visitors can submit