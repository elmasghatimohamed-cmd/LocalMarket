<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;





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


Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'getCart'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addProduct'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeProduct'])->name('cart.remove');
});

//seller route
Route::middleware('auth')->prefix('seller')->group(function () {
    Route::get('/products', [ProductController::class, 'crud'])
        ->name('seller.products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('seller.products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('seller.crud.store');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('seller.products.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('seller.products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('seller.products.destroy');
});


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['auth'])->group(function () {
    Route::post('/product/{product}/like', [LikeController::class, 'toggle'])->name('products.like');
    Route::post('/product/{product}/review', [ReviewController::class, 'store'])->name('products.review');
});
