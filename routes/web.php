<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

Route::get('/', function () {
    return view('hello');
});

// UPDATED: Now fetches only the articles dynamically for the Customer Portal view
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

    // 4. Pass it to the view
    return view('CustomerPortal', compact('articles'));
})->name('CustomerPortal');

// Knowledge Base Routes (Explicit strings to prevent editor confusion)
Route::get('/KnowledgeBase', ['App\Http\Controllers\KnowledgeBaseController', 'index'])->name('KnowledgeBase');
Route::get('/SelfServicePortal', ['App\Http\Controllers\KnowledgeBaseController', 'index']);
Route::get('/knowledge-base', ['App\Http\Controllers\KnowledgeBaseController', 'index'])->name('kb.index');
Route::post('/knowledge-base/store', ['App\Http\Controllers\KnowledgeBaseController', 'store'])->name('kb.store');
Route::put('/knowledge-base/{id}', ['App\Http\Controllers\KnowledgeBaseController', 'update'])->name('kb.update');
Route::post('/knowledge-base/{id}/vote', ['App\Http\Controllers\KnowledgeBaseController', 'vote'])->name('kb.vote');
Route::post('/knowledge-base/{id}/view', ['App\Http\Controllers\KnowledgeBaseController', 'incrementView'])->name('kb.view');
