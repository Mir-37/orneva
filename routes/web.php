<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\NewsletterController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', fn() => view('shop.index'))->name('shop.index');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.subscribe');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{slug}', [ShopController::class, 'show'])->name('product.show');

Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});
