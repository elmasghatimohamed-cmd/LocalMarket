<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductController,
    ReviewController,
    LikeController,
    CartController,
    OrderController,
    OrderItemController,
    CheckoutController,
    SellerController
};
use App\Http\Controllers\Admin\{
    RoleSwitcherController,
    CategoryController,
    DashboardController
};

/* --- 1. Routes Publiques --- */
Route::get('/', [ProductController::class, 'showHomeProducts'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');

/* --- 2. Routes Authentifiées (Tout utilisateur connecté) --- */
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // Favoris
    Route::get('/favorites', [LikeController::class, 'index'])->name('favorites.index');
    Route::post('/products/{product}/like', [LikeController::class, 'toggle'])->name('products.like');

    // Checkout
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout/process', 'process')->name('checkout.process');
        Route::post('/checkout/process', 'store')->name('checkout.store');
        Route::get('/checkout/cashondelivery', 'showCod')->name('checkout.cod');
        Route::post('/checkout/cashondelivery', 'storeCod')->name('checkout.cod.store');
    });

    /* --- 3. Espace Client --- */
    Route::middleware(['role:client'])->group(function () {
        Route::get('/cart', [CartController::class, 'getCart'])->name('cart.index');
        Route::post('/cart/add', [CartController::class, 'addProduct'])->name('cart.add');
        Route::delete('/cart/remove/{id}', [CartController::class, 'removeProduct'])->name('cart.remove');

        Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/my-orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/products/{product}/review', [ReviewController::class, 'store'])->name('products.review');
    });

    /* --- 4. Espace Administration & Gestion (Seller, Admin, Moderator) --- */
    Route::middleware(['role:seller|admin|moderator'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Administration spécifique (Préfixe admin)
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/roles', [RoleSwitcherController::class, 'index'])->name('role_switcher');
            Route::post('/roles/{user}', [RoleSwitcherController::class, 'update'])->name('role_switcher.update');
            Route::resource('categories', CategoryController::class)->except(['show']);
        });
    });

    /* --- 5. Espace Vendeur (Seller) --- */
    Route::middleware(['role:seller'])->prefix('seller')->name('seller.')->group(function () {

        Route::resource('myproducts', ProductController::class)->names('products');
        Route::get('/orders', [SellerController::class, 'orders'])->name('orders');
        Route::post('/orders/{order}/status', [SellerController::class, 'updateOrderStatus'])->name('orders.updateStatus');
    });

    /* --- 6. Espace Modérateur / Admin --- */
    Route::middleware(['role:moderator|admin'])->group(function () {
        Route::post('/reviews/{review}/toggle', [ReviewController::class, 'toggleVisibility'])->name('reviews.toggle');
        Route::post('/products/{product}/toggle', [ProductController::class, 'toggleStatus'])->name('products.toggle');
        Route::put('/orders/{order}/status', [OrderItemController::class, 'updateStatus'])->name('orders.updateStatus');
    });
});

Route::get('status', [SellerController::class, 'orders'])->name('seller.orders');
Route::post('/orders/{order}/status', [SellerController::class, 'updateOrderStatus'])->name('seller.orders.updateStatus');