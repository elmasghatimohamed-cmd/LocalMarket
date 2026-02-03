<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CartController;




Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/cart', [CartController::class, 'getCart'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addProduct'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeProduct'])->name('cart.remove');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::post('/product/{product}/like', [LikeController::class, 'toggle'])->name('products.like');
    Route::post('/product/{product}/review', [ReviewController::class, 'store'])->name('products.review');
});