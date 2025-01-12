@extends('layouts.front')

@section('title', '準備下訂')

@section('content')
    <div class="container">
        <h1 class="mb-4">準備下訂</h1>

        <!-- 顯示驗證錯誤訊息 -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <!-- 購物車內容 -->
            <div class="col-md-8">
                <h3>購物車內容</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>商品名稱</th>
                            <th>單價</th>
                            <th>數量</th>
                            <th>小計</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <!-- 購物車內容會動態填充 -->
                    </tbody>
                </table>
                <h4 class="text-end">總金額：<span id="total-price">$0</span></h4>
            </div>

            <!-- 結帳資訊 -->
            <div class="col-md-4">
                <h3>結帳資訊</h3>
                <div class="mb-3">
                    <p class="form-control-plaintext">使用者名稱:　{{ $user->user_name }}</p>
                </div>
                <div class="mb-3">
                    <p class="form-control-plaintext">電子郵件：{{ $user->email }}</p>
                </div>
                <div class="mb-3">
                    <p class="form-control-plaintext">手機：{{ $user->phone }}</p>
                </div>

                <div class="mb-3">
                    <p class="form-control-plaintext">付款方式：貨到付款</p>
                </div>

                <div class="mb-3">
                    <p class="form-control-plaintext">運送方式：黑貓宅急便</p>
                </div>

                <form action="{{ route('front.orders.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="address" class="form-label">配送地址：</label>
                        <textarea name="address" id="address" class="form-control" placeholder="輸入您的配送地址" rows="3" required></textarea>
                    </div>
                
                    <!-- 隱藏購物車資料 -->
                    <input type="hidden" name="cart" id="cart-data">
                
                    <button type="submit" class="btn btn-primary w-100 mb-3">提交訂單</button>
                </form>

                <!-- 繼續購物按鈕 -->
                <a href="{{ route('front.carts.cart') }}" class="btn btn-secondary w-100">返回購物車</a>
            </div>
        </div>
    </div>
@endsection
