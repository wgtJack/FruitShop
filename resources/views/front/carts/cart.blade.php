@extends('layouts.front')

@section('title', '購物車')

@section('content')
    <div class="container">
        <h1 class="mb-4">購物車</h1>

        <!-- 購物車表格 -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>產品</th>
                    <th>單價</th>
                    <th>數量</th>
                    <th>小計</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- 購物車商品將顯示在這裡，JavaScript 會負責載入商品 -->
            </tbody>
        </table>

        <!-- 顯示總金額 -->
        <div class="d-flex justify-content-between mt-4">
            <span><strong>總金額：$<span id="total-price">0</span></strong></span>
        </div>

        <!-- 按鈕區 -->
        <div class="mt-4">
            <a href="{{ route('front.products.index') }}" class="btn btn-secondary">繼續購物</a>
            <a href="{{ route('front.carts.checkout') }}" class="btn btn-primary">準備結帳</a>
        </div>
    </div>
@endsection
