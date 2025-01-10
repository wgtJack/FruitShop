<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    // 顯示登入頁面
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // 處裡登入邏輯
    public function login(Request $request) {}

    // 處裡註冊邏輯 API
    public function create(Request $request)
    {
        // 驗證輸入資料
        try {
            $validated = $request->validate([
                'account' => 'required|string|max:255|unique:admins,account',
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => '驗證錯誤',
                'messages' => $e->errors()
            ], 422);
        }

        try {
            // 創建 Admin 帳號
            $admin = Admin::create([
                'account' => $validated['account'],
                'name' => $validated['name'],
                'password' => Hash::make($validated['password']), // 加密密碼
                'salt' => uniqid(), // 生成隨機鹽值
            ]);
        } catch (\Exception $e) {
            // 捕獲錯誤並返回錯誤訊息
            return response()->json([
                'error' => '無法創建 Admin 帳號',
                'message' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'Admin 帳號創建成功',
            'admin' => $admin,
        ], 201);
    }
}
