<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Ticket;


// -----------------------------------------------------
// 1. FALLBACK LOGIN (For testing the Admin Sub-module)
// -----------------------------------------------------
Route::get('/login', function () {
    $admin = User::where('role', 'admin')->first();
    if (!$admin) {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@supportdesk.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
    }
    Auth::login($admin);
    return redirect()->route('admin.support.dashboard');
})->name('login');


// -----------------------------------------------------
// 2. CUSTOMER FACING ROUTES
// -----------------------------------------------------
Route::get('/home', [CustomerController::class, 'home'])->name('customer.home');
Route::get('/tickets', [CustomerController::class, 'index'])->name('customer.tickets');
Route::get('/tickets/create', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/tickets', [CustomerController::class, 'store'])->name('tickets.store');
Route::get('/tickets/{id}', [CustomerController::class, 'show'])->name('customer.show');
Route::post('/tickets/{ticket}/reply', [CustomerController::class, 'reply'])->name('customer.reply');


// -----------------------------------------------------
// 3. LIVE CHAT API ENDPOINTS
// -----------------------------------------------------
Route::post('/live-chat/start', [CustomerController::class, 'startLiveChat'])->name('live-chat.start');
Route::post('/live-chat/send', [CustomerController::class, 'sendLiveChatMessage'])->name('live-chat.send');
Route::get('/live-chat/messages/{ticket}', function(Ticket $ticket) {
    return response()->json($ticket->replies()->with('user')->get());
});


// -----------------------------------------------------
// 4. ADMIN SUB-MODULE ROUTES
// -----------------------------------------------------
Route::prefix('admin/support')->name('admin.support.')->middleware(['auth'])->group(function () {
    
    // Core Overview
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');

    // Advanced Ticket Table & Interaction
    Route::get('/tickets', [AdminController::class, 'tickets'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [AdminController::class, 'show'])->name('tickets.show');
    
    // Core Sub-module Actions
    Route::patch('/tickets/{ticket}/status', [AdminController::class, 'updateStatus'])->name('tickets.update-status');
    Route::post('/tickets/{ticket}/assign', [AdminController::class, 'assignAgent'])->name('tickets.assign');
    Route::post('/tickets/{ticket}/reply', [AdminController::class, 'reply'])->name('tickets.reply');
});


// Point the home route directly to your landing page view
Route::get('/', [CustomerController::class, 'home'])->name('home');

// Make sure your ticket creation route is separate!
Route::get('/tickets/create', [CustomerController::class, 'create'])->name('customer.create');