@extends('layouts.admin')

@section('title', '訂單詳細')

@section('content')
    <div class="container">
        <h1 class="mb-4">訂單編號：#{{ $order->order_id }}</h1>

        <p><strong>下訂日期：</strong>{{ $order->created_at->format('Y-m-d H:i') }}</p>
        <p><strong>訂單狀態：</strong>{{ $order->orderStatus->status_name }}</p>
        <p><strong>總金額：</strong>$ {{ $order->total_amount }}</p>
        <p><strong>配送地址：</strong>{{ $order->address }}</p>

        <!-- 返回訂單列表的按鈕 -->
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary mb-4">返回訂單列表</a>

        <!-- 更改訂單狀態的表單 -->
        <form action="{{ route('admin.orders.update', $order->order_id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group mb-3">
                <label for="order_status_id">訂單狀態</label>
                <select name="order_status_id" id="order_status_id" class="form-control">
                    @foreach ($orderStatuses as $id => $statusName)
                        <option value="{{ $id }}" {{ $order->order_status_id == $id ? 'selected' : '' }}>
                            {{ $statusName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">更新訂單狀態</button>
        </form>

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
