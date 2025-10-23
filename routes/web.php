<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


Route::middleware( 'auth')->group( function (): void {
    // GET
    Route::get('/profile',  [ProfileController::class, 'edit'])->name( 'profile.edit');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // PATCH
    Route::patch('/profile',  [ProfileController::class, 'update'])->name( 'profile.update');

    // DELETE
    Route::delete('/profile',   [ProfileController::class, 'destroy'])->name( 'profile.destroy');

    // RESOURCE
    Route::resource('transactions', TransactionController::class);
    Route::resource('categories',  CategoryController::class);
    Route::resource('budgets',  controller: BudgetController::class);
});

require __DIR__.'/auth.php';
