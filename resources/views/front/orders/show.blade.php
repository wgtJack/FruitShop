@extends('layouts.front')

@section('title', '訂單詳細')

@section('content')
    <div class="container">
        <h1 class="mb-4">訂單編號：#{{ $order->order_id }}</h1>

        <p><strong>下訂日期：</strong>{{ $order->created_at->format('Y-m-d H:i') }}</p>
        <p><strong>訂單狀態：</strong>{{ $order->orderStatus->status_name }}</p>
        <p><strong>總金額：</strong>$ {{ $order->total_amount }}</p>
        <p><strong>配送地址：</strong>{{ $order->address }}</p>

        <!-- 使用 flexbox 讓按鈕排在同一行，無間距 -->
        <div class="d-flex mb-4">
            <!-- 返回訂單列表的按鈕 -->
            <a href="{{ route('front.orders.index') }}" class="btn btn-primary me-2">返回訂單列表</a>

            <!-- 取消訂單的按鈕 -->
            @if ($order->order_status_id != 4) <!-- 檢查訂單狀態，避免重複取消 -->
                <form action="{{ route('front.orders.update', $order->order_id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="order_status_id" value="4"> <!-- 4 是取消訂單的狀態 -->
                    <button type="submit" class="btn btn-danger">取消訂單</button>
                </form>
            @endif
        </div>

        <h3 class="mt-4">訂單項目</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>商品名稱</th>
                    <th>數量</th>
                    <th>單價</th>
                    <th>小計</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>$ {{ $item->product->price }}</td>
                        <td>$ {{ $item->product->price * $item->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
