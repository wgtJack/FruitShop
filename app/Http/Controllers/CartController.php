<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 顯示購物車頁面
    public function index()
    {
        return view('front.carts.cart');
    }

    // 顯示購物車頁面
    public function checkout()
    {
        $user = Auth::user(); // 獲取目前登入的用戶
        return view('front.carts.checkout', compact('user'));
    }
}
