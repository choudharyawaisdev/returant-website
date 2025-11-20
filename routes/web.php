<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\AdonsController;
use App\Http\Controllers\CartController;




Route::get('/clients', [ClientController::class, 'index'])->name('index.index');
Route::get('/menu/{menu}', [MenuController::class, 'show'])->name('menu.show');
Route::post('/cart/add', [MenuController::class, 'add'])->name('cart.add');
Route::get('/menu/search', [MenuController::class, 'search'])->name('menu.search');
// You might show a mini-cart on the menu page, but a full page is needed.
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('menus', MenuController::class);
    Route::resource('addons', AdonsController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('adduser', AddUserController::class);
});


// ... other routes

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/get', [CartController::class, 'getCart'])->name('cart.get');
Route::get('/cart', [MenuController::class, 'index'])->name('cart.index');

// Checkout Page
Route::get('/checkout', [CartController::class, 'index'])->name('checkout.index');

// Order Submission
Route::post('/order', [CartController::class, 'placeOrder'])->name('order.place');

// Dummy Success Page (Create this view later)
Route::get('/order/success', function () {
    return view('checkout.success');
})->name('order.success');










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
