<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth routes (Breeze)
require __DIR__.'/auth.php';

// PUBLIC PRODUCTS (ponuda za kupce)
Route::get('/products', [ProductController::class, 'index'])->name('public.products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('public.products.show');


/*
|--------------------------------------------------------------------------
| Authenticated user routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout (USER)
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('checkout.process');
});


/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Categories CRUD
    Route::resource('categories', CategoryController::class);

    // ADMIN PRODUCTS (tabela, stock, IMA/NEMA)
    Route::get('/products', [ProductController::class, 'adminIndex'])->name('products.index');

    // Products CRUD (admin)
    Route::resource('products', ProductController::class)->except(['index', 'show']);

    // Orders (admin panel)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::patch('/orders/{order}/paid', [OrderController::class, 'markAsPaid'])->name('orders.paid');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'markAsCancelled'])->name('orders.cancel');
    Route::patch('/orders/{order}/pending', [OrderController::class, 'markAsPending'])->name('orders.pending');

    // Users
    Route::resource('users', UserController::class)->only(['index', 'store', 'destroy']);
});
