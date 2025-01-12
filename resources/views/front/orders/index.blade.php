@extends('layouts.front')

@section('title', '我的訂單')

@section('content')
    <div class="container">
        <h1 class="mb-4">我的訂單</h1>

        <!-- 顯示下訂單成功訊息 -->
        @if (session('success'))
            <div class="alert alert-success" id="orders-success-message">
                {{ session('success') }}
            </div>
        @endif

        @if ($orders->isEmpty())
            <div class="alert alert-info">您尚未有任何訂單。</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>訂單編號</th>
                        <th>下訂日期</th>
                        <th>訂單狀態</th>
                        <th>總金額</th>
                        <th>配送地址</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>#{{ $order->order_id }}</td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $order->orderStatus->status_name }}</td>
                            <td>$ {{ $order->total_amount }}</td>
                            <td>{{ $order->address }}</td>
                            <td>
                                <a href="{{ route('front.orders.show', $order->order_id) }}" class="btn btn-dark btn-sm">檢視訂單</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
