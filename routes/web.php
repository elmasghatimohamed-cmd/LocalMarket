<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\Admin\RoleSwitcherController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CheckoutController;

// 1. Public Routes
Route::get('/', [ProductController::class, 'showHomeProducts']);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');

// 2. Authenticated Routes (Jetstream/Sanctum)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:seller|admin|moderator'
])->group(function () {

    // Main Dashboard - Handled by Controller to provide $stats
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Products View
    Route::get('/products-view', function () {
        return view('product.index');
    })->name('products');
});

// 3. Client & Admin Shared Routes
Route::middleware(['auth', 'role:client|admin'])->group(function () {
    Route::get('/cart', [CartController::class, 'getCart'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addProduct'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeProduct'])->name('cart.remove');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// 4. Seller Specific Routes
Route::middleware(['auth', 'role:seller'])->group(function () {
    // Note: You had two versions of this, merged into one block
    Route::get('/myproducts', [ProductController::class, 'crud'])->name('seller.crud.index');
    Route::get('/myproducts/create', [ProductController::class, 'create'])->name('seller.products.create');
    Route::get('status', [\App\Http\Controllers\SellerController::class, 'orders'])->name('seller.orders');
    Route::post('/orders/{order}/status', [\App\Http\Controllers\SellerController::class, 'updateOrderStatus'])->name('seller.orders.updateStatus');
    Route::post('/myproducts', [ProductController::class, 'store'])->name('seller.products.store');
    Route::get('/myproducts/{product}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');
    Route::put('/myproducts/{product}', [ProductController::class, 'update'])->name('seller.products.update');
    Route::delete('/myproducts/{product}', [ProductController::class, 'destroy'])->name('seller.products.destroy');
});


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['auth'])->group(function () {

});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin|moderator|seller'])->group(function () {
    // This points to the same controller logic for admin prefix
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/roles', [RoleSwitcherController::class, 'index'])->name('role_switcher');
    Route::post('/roles/{user}', [RoleSwitcherController::class, 'update'])->name('role_switcher.update');
    Route::resource('categories', CategoryController::class)->except(['show']);
});

// 6. Order Management
Route::put('/orders/{order}/status', [OrderItemController::class, 'updateStatus'])->name('orders.updateStatus');
Route::post('/products/{product}/review', [ReviewController::class, 'store'])->name('products.review');

// Moderator routes
Route::middleware(['auth', 'role:moderator|admin'])->group(function () {
    Route::post('/reviews/{review}/toggle', [ReviewController::class, 'toggleVisibility'])->name('reviews.toggle');
    Route::post('/products/{product}/toggle', [ProductController::class, 'toggleStatus'])->name('products.toggle');
});
Route::post('/products/{product}/like', [LikeController::class, 'toggle'])->name('products.like');
Route::middleware(['auth'])->group(function () {
    Route::get('/favorites', [LikeController::class, 'index'])->name('favorites.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/myorders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/my-orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::post('/orders/{order}/update-status', [OrderItemController::class, 'updateStatus'])
        ->name('orders.updateStatus');
});
// 7. Checkout Management
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/checkout/process', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::get('/checkout/cashondelivery', [CheckoutController::class, 'showCod'])->name('checkout.cod');
Route::post('/checkout/cashondelivery', [CheckoutController::class, 'storeCod'])->name('checkout.cod');