<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// 創建 Admin 帳號的 API 路由
Route::post('/admins', [AdminController::class, 'create']);
