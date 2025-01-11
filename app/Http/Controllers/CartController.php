<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('front.carts.checkout');
    }
}
