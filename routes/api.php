<?php

use App\Http\Controllers\api\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Cart releted routes.
Route::get('/cart', [CartController::class, 'cartIndex'])->name('cart.index');
// Route::post('/cart', [CartController::class, 'cartStore'])->name('cart.store');
// Route::post('/cart/destroy', [CartController::class, 'cartDestroy'])->name('cart.destroy');
// Route::get('/cart/clear', [CartController::class, 'cartClear'])->name('cart.clear');