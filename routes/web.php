<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->middleware('guest');

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/transactions', [TransactionController::class, 'index'])->middleware('auth')->name('transactions.index');
Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->middleware('auth')->name('transactions.show');
Route::post('/transactions', [TransactionController::class, 'store'])->middleware('auth');
Route::post('/transactions/{transaction}', [TransactionController::class, 'destroy'])->middleware('auth')->name('transactions.destroy');

Route::get('/goals', [GoalController::class, 'index'])->middleware('auth')->name('goals.index');
Route::post('/goals', [GoalController::class, 'store'])->middleware('auth')->name('goals.store');
Route::get('/goals/{goal}', [GoalController::class, 'show'])->middleware('auth')->name('goals.show');
Route::post('/goals/{goal}', [GoalController::class, 'edit'])->middleware('auth')->name('goals.edit');
Route::put('/goals/{goal}', [GoalController::class, 'invest'])->middleware('auth')->name('goals.invest');
Route::delete('/goals/{goal}', [GoalController::class, 'destroy'])->middleware('auth')->name('goals.destroy');

Route::post('/goal', [GoalController::class, 'store'])->middleware('auth');
