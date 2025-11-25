<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\AdonsController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PagesController;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('menus', MenuController::class);
    Route::resource('addons', AdonsController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('adduser', AddUserController::class);
});

Route::middleware('auth')->group(function () {
    Route::post('/client/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::get('/client/wishlist', [WishlistController::class, 'menu'])->name('wishlist.index');
    Route::get('/client/order', [PagesController::class, 'index'])->name('client.order');
});

Route::controller(CartController::class)->middleware('auth')->group(function () {
    Route::post('/cart/add', 'addToCart')->name('cart.add');
    Route::delete('/cart/remove/{configKey}', 'removeFromCart')->name('cart.remove');
    Route::post('/cart/update-quantity', 'updateQuantity')->name('cart.updateQuantity');
    Route::get('/cart/get', 'getCart')->name('cart.get');
    Route::get('/cart', 'index')->name('cart.index');        // View cart
    Route::get('/checkout', 'index')->name('checkout.index'); // Checkout page
    Route::post('/order', 'placeOrder')->name('order.place'); // Place order
});

Route::controller(MenuController::class)->group(function () {
    Route::get('/menu/{menu}', 'show')->name('menu.show');     // Single menu view
    Route::get('/menu/search', 'search')->name('menu.search'); // Search menu
});
Route::get('/clients', [ClientController::class, 'index'])->name('index.index');


Route::post('/save-location', function(\Illuminate\Http\Request $request) {
    session([
        'city' => $request->city,
        'area' => $request->area
    ]);
    return response()->json(['status' => 'success']);
})->name('location.save');


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
