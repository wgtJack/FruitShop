<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

// 前台
Route::prefix('/')->group(function () {
    // 註冊頁面與邏輯
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('front.register.form');
    Route::post('/register', [UserController::class, 'register'])->name('front.register.submit');

    // 登入頁面與邏輯
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('front.login.form');
    Route::post('/login', [UserController::class, 'login'])->name('front.login.submit');

    // 產品
    Route::get('/', [ProductController::class, 'index'])->name('front.products.index');
    Route::get('/index', [ProductController::class, 'index']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('front.products.show');

    // 訂單
    Route::post('/orders/store', [OrderController::class, 'store'])->name('front.orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('front.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('front.orders.show');
    Route::patch('/orders/{id}', [OrderController::class, 'update'])->name('front.orders.update');
});

// 後台
Route::prefix('admin')->group(function () {
    // 登入頁面與邏輯
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');

    // 產品
    Route::get('/index', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('/', [ProductController::class, 'adminIndex']);
    Route::get('/products', [ProductController::class, 'adminIndex']);
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // 訂單
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/orders/{id}', [OrderController::class, 'update'])->name('admin.orders.update');
});
