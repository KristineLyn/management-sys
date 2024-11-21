<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TransactionController::class, 'home'])->middleware(['auth', 'verified'])->name('home');

// Route::get('/', function () {
//     return view('home');
// })->middleware(['auth', 'verified'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Income routes
Route::middleware('auth')->group(function () {
    Route::post('/incomes', [IncomeController::class, 'store'])->name('incomes.store');
    Route::get('/income-summary', [IncomeController::class, 'getIncomeSummary'])->name('incomes.summary');
});

Route::middleware(  ['auth'])->group(function () {
    Route::resource('transactions', TransactionController::class)->only(['index', 'create', 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});


require __DIR__.'/auth.php';
