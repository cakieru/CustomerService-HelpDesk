<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlaReportController;

Route::get('/sla-reports', [SlaReportController::class, 'index'])->name('sla-reports.index');
Route::get('/sla-reports/export', [SlaReportController::class, 'export'])->name('sla-reports.export');

use App\Http\Controllers\SlaAdminController;

Route::get('/admin/sla', [SlaAdminController::class, 'index'])->name('admin.sla');
Route::put('/admin/sla/update', [SlaAdminController::class, 'update'])->name('admin.sla.update');

use App\Http\Controllers\TicketController;

Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::put('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
