@extends('layouts.admin')

@section('title', '訂單管理')

@section('content')
    <div class="container">
        <h1 class="mb-4">所有訂單</h1>

        <!-- 顯示成功訊息 -->
        @if (session('success'))
            <div class="alert alert-success" id="orders-success-message">
                {{ session('success') }}
            </div>
        @endif
        
        @if ($orders->isEmpty())
            <div class="alert alert-info">目前沒有任何訂單。</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>訂單編號</th>
                        <th>使用者名稱</th>
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
                            <td>{{ $order->user->user_name }}</td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $order->orderStatus->status_name }}</td>
                            <td>$ {{ $order->total_amount }}</td>
                            <td>{{ $order->address }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->order_id) }}"
                                    class="btn btn-info btn-sm">檢視訂單</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
