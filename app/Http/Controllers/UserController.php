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
        // 如果已經登入前台，則直接導向首頁
        if (Auth::guard('web')->check()) {
            return redirect()->route('front.products.index');
        }

        return view('front.login');
    }

    // 顯示註冊頁面
    public function showRegisterForm()
    {
        return view('front.register');
    }

    // 顯示個人資訊頁面
    public function showProfile()
    {
        $user = Auth::user(); // 獲取目前登入的用戶
        return view('front.profile', compact('user'));
    }

    // 處理登入邏輯
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('web')->login($user);

            return redirect()->route('front.products.index');
        } else {
            return back()->withErrors(['loginError' => '無效的電子郵件或密碼。']);
        }
    }

    // 處理登出邏輯
    public function logout()
    {
        Auth::guard('web')->logout();
        session()->flush();

        return redirect()->route('front.login.form');
    }

    // 處理註冊邏輯
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'user_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'email' => $request->email,
            'user_name' => $request->user_name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'salt' => uniqid(), // 生成隨機鹽值
        ]);

        return redirect()->route('front.login.form')->with('success', '註冊成功！');
    }

    // 更新個人資訊
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'phone' => 'required|string|max:15',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('front.profile.show')->with('success', '資訊已成功更新！');
    }
}
