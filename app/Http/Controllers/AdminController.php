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
        // 如果已經登入後台，則直接導向後台首頁
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.products.index');
        }

        return view('admin.login');
    }

    // 處理登入邏輯
    public function login(Request $request)
    {
        $request->validate([
            'account' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('account', $request->account)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            // 使用後台守衛進行登入
            Auth::guard('admin')->login($admin);

            // 設置專屬的 Cookie
            session()->put('cookie', config('session.cookie_admin'));

            return redirect()->route('admin.products.index');
        } else {
            return back()->withErrors(['loginError' => '帳號或密碼錯誤']);
        }
    }

    // 處理登出邏輯
    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->flush();

        return redirect()->route('admin.login.form');
    }

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
