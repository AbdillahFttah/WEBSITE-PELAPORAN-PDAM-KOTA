<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;

Route::get('/', [ComplaintController::class, 'welcome'])->name('welcome');

Route::post('/pengaduan', [ComplaintController::class, 'store'])->name('complaints.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ComplaintController::class, 'dashboard'])->name('dashboard');

    Route::patch('/complaints/{complaint}/status', [ComplaintController::class, 'updateStatus'])
        ->name('complaints.updateStatus');

    Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])
        ->name('complaints.destroy');

    Route::get('/complaints/export/excel', [ComplaintController::class, 'export'])
        ->name('complaints.export');
});

require __DIR__.'/auth.php';