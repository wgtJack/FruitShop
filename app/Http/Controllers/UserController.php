<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 顯示登入頁面
    public function showLoginForm()
    {
        return view('front.login');
    }

    // 顯示註冊頁面
    public function showRegisterForm()
    {
        return view('front.register');
    }

    // 處裡註冊邏輯
    public function register(Request $request)
    {
        // 驗證輸入資料
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'user_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed', // 確認密碼
        ]);

        // 新增使用者資料
        User::create([
            'email' => $request->email,
            'user_name' => $request->user_name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password), // 加密密碼
            'salt' => uniqid(), // 生成隨機鹽值
        ]);

        // 註冊成功後，導向登入頁面並傳遞成功訊息
        return redirect()->route('front.login.form')->with('successMessage', '註冊成功！');
    }

    // 處理登入邏輯
    public function login(Request $request)
    {
        // 驗證輸入資料
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // 驗證使用者帳號和密碼
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // 登入成功
            Auth::login($user);
            return redirect()->route('front.index');
        } else {
            // 登入失敗
            return back()->withErrors(['loginError' => '無效的電子郵件或密碼。']);
        }
    }
}
