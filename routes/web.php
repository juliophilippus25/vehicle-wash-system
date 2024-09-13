<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/vehicle-types', [App\Http\Controllers\VehicleTypeController::class, 'index'])->name('vehicleType.index');

// Routing customers
Route::group(['prefix' => '/customers'], function() {
    Route::get('', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers.index');
    Route::get('/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customers.create');
    Route::post('/store', [App\Http\Controllers\CustomerController::class, 'store'])->name('customers.store');
    Route::get('/edit/{id}', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/update/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/delete/{id}', [App\Http\Controllers\CustomerController::class, 'delete'])->name('customers.delete');
});

// Routing transactions
Route::group(['prefix' => '/transactions'], function() {
    Route::get('', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/create', [App\Http\Controllers\TransactionController::class, 'create'])->name('transactions.create');
});