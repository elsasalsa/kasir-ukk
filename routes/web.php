<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Route untuk login
Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login-auth', [UserController::class, 'loginAuth'])->name('login.auth');
Route::get('/error-permission', [UserController::class, 'error'])->name('error');

// Group untuk guest (belum login)
Route::middleware('IsGuest')->group(function() {
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('/login-auth', [UserController::class, 'loginAuth'])->name('login.auth');
});

// Group untuk user yang sudah login
Route::middleware('IsLogin')->group(function() {

    // Route untuk dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('index');

    // Route untuk logout
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    // Middleware untuk user yang memiliki role Admin
    Route::middleware('IsAdmin')->name('admin.')->group(function() {

        // Route untuk product
        Route::prefix('product')->name('product.')->group(function() {
            Route::get('/data', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [ProductController::class, 'update'])->name('update');
            Route::patch('/update-stock/{id}', [ProductController::class, 'updateStock'])->name('updateStock');
            Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
        });

        // Route untuk order
        Route::prefix('order')->name('order.')->group(function() {
            Route::get('/data', [OrderController::class, 'index'])->name('index');
            Route::get('/bukti/{id}', [OrderController::class, 'unduhBukti'])->name('bukti');
            Route::get('/export', [OrderController::class, 'exportBukti'])->name('export');
        });

        Route::prefix('user')->name('user.')->group(function() {
            Route::get('/data', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');

        });
    });

    // Middleware untuk user yang memiliki role Employee
    Route::middleware('IsStaff')->prefix('petugas')->name('petugas.')->group(function() {

        // Route untuk product (Employee)
        Route::prefix('product')->name('product.')->group(function() {
            Route::get('/data', [ProductController::class, 'data'])->name('index');
        });

        Route::prefix('order')->name('order.')->group(function() {
            Route::get('/data', [OrderController::class, 'data'])->name('index');
            Route::get('/detail-print/{id}', [OrderController::class, 'detail'])->name('detail');
            Route::get('/create', [OrderController::class, 'create'])->name('create');
            Route::post('/create/post', [OrderController::class, 'post'])->name('post');
            Route::get('/create/member', [OrderController::class, 'member'])->name('member');
            Route::post('/store', [OrderController::class, 'store'])->name('store');
            Route::post('/store/member', [OrderController::class, 'storeOrder'])->name('storeOrder');
            Route::get('/bukti/{id}', [OrderController::class, 'unduhBukti'])->name('bukti');
            Route::get('/export', [OrderController::class, 'exportBukti'])->name('export');
        });
    });
});
