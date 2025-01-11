@extends('layouts.front')

@section('title', '購物車')

@section('content')
    <h1 class="mb-4">購物車</h1>

    <table class="table">
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

    <div class="d-flex justify-content-between">
        <span><strong>總金額：<span id="total-price">0</span></strong></span>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('front.carts.checkout') }}" class="btn btn-primary">下訂單</a>
    </div>

    <style>
        /* 讓每一列商品之間有分隔線 */
        .cart-item {
            border-bottom: 1px solid #ddd; /* 每個商品底部有邊框 */
        }

        .cart-item:last-child {
            border-bottom: none; /* 最後一個商品不顯示底部邊框 */
        }

        .cart-item .row {
            align-items: center;
        }

        .cart-item .col-md-4 {
            font-weight: bold;
        }

        .cart-item .col-md-2 {
            text-align: center;
        }

        /* 表格樣式 */
        .table th, .table td {
            padding: 10px;
            text-align: center;
        }

        .table th {
            background-color: #f8f9fa;
        }

        .table td button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .table td button:hover {
            background-color: #c82333;
        }
    </style>
@endsection
