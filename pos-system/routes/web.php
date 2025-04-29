<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('orders', OrderController::class);
Route::get('/orders/{id}/print', [OrderController::class, 'print'])->name('orders.print');