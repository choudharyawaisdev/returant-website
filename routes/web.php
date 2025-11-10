<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AddUserController;





Route::get('/clients', [ClientController::class, 'index'])->name('index.index');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('menus', MenuController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('adduser', AddUserController::class);
});














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
