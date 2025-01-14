<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role === 'customer') {
            return redirect()->route('customer.dashboard');
        }
    })->name('dashboard');

    // Admin
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('books', BookController::class);
        Route::get('/', [BookController::class, 'index']);
        Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
        Route::get('books/data', [BookController::class, 'getData'])->name('books.data');
    });

    // Customer
    Route::middleware(['auth','role:customer'])->group(function () {
        Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
        Route::resource('sales', SaleController::class);
        Route::get('/', [SaleController::class, 'index']);
        Route::get('/show/{book}', [SaleController::class, 'show'])->name('books.show');
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/{book}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('/cart/add/{book}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart.delete');
        Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/buy/{id}', [BookController::class, 'buyNow'])->name('buy.now');
        Route::post('/checkout/direct/{id}', [OrderController::class, 'directCheckout'])->name('checkout.direct');

    });
});

