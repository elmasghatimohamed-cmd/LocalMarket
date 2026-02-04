<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\RoleSwitcherController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;




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


Route::middleware(['auth', 'role:client|admin'])->group(function () {
    Route::get('/cart', [CartController::class, 'getCart'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addProduct'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeProduct'])->name('cart.remove');
    Route::post('/product/{product}/like', [LikeController::class, 'toggle'])->name('products.like');
    Route::post('/product/{product}/review', [ReviewController::class, 'store'])->name('products.review');
});
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/crud', [ProductController::class, 'crud'])->name('seller.crud.crud');

});


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['auth'])->group(function () {

});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/roles', [RoleSwitcherController::class, 'index'])->name('role_switcher');
    Route::post('/roles/{user}', [RoleSwitcherController::class, 'update'])->name('role_switcher.update');

    Route::resource('categories', CategoryController::class)->except(['show']);
});
