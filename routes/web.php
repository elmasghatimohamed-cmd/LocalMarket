<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\RoleSwitcherController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user && method_exists($user, 'hasRole') && $user->hasanyRole(['admin', 'moderator', 'seller'])) {
            return redirect()->route('admin.dashboard');
        }

        return view('dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user && method_exists($user, 'hasRole') && $user->hasRole('client')) {
            return redirect()->route('products.index');
        }
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'role:client|admin'])->group(function () {
    Route::get('/cart', [CartController::class, 'getCart'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addProduct'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeProduct'])->name('cart.remove');
});
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/crud', [ProductController::class, 'crud'])->name('seller.crud.index');

});


//seller route
Route::middleware(['auth'])->group(function () {
    Route::get('/myproducts', [ProductController::class, 'crud'])
        ->name('seller.crud.index');

    Route::get('/myproducts/create', [ProductController::class, 'create'])
        ->name('seller.products.create');

    Route::post('/myproducts', [ProductController::class, 'store'])
        ->name('seller.products.store');

    Route::get('/myproducts/{product}/edit', [ProductController::class, 'edit'])
        ->name('seller.products.edit');

    Route::put('/myproducts/{product}', [ProductController::class, 'update'])
        ->name('seller.products.update');

    Route::delete('/myproducts/{product}', [ProductController::class, 'destroy'])
        ->name('seller.products.destroy');
});


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['auth'])->group(function () {

});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin|moderator|seller'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/roles', [RoleSwitcherController::class, 'index'])->name('role_switcher');
    Route::post('/roles/{user}', [RoleSwitcherController::class, 'update'])->name('role_switcher.update');

    Route::resource('categories', CategoryController::class)->except(['show']);
});