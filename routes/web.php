<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DebtController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


// Routes protected by 'auth' middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DebtController::class, 'index'])->name('hutang.index');
    Route::get('/hutang/add', [DebtController::class, 'create'])->name('hutang.add');
    Route::post('/hutang', [DebtController::class, 'store'])->name('hutang.store');
    
    // Ensure you have methods reduce() and total() in DebtController or remove these routes if not needed
    Route::get('/hutang/reduce', [DebtController::class, 'reduce'])->name('hutang.reduce'); 
    Route::get('/hutang/total', [DebtController::class, 'total'])->name('hutang.total');
    
    Route::put('/hutang/{id}', [DebtController::class, 'update'])->name('hutang.update');
    Route::delete('/hutang/{id}', [DebtController::class, 'destroy'])->name('hutang.destroy');
    
    // Mark debt as paid route
    Route::post('/hutang/{id}/mark-as-paid', [DebtController::class, 'markAsPaid'])->name('hutang.markAsPaid');

    // Log out
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});