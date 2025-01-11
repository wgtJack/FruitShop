@extends('layouts.front')

@section('title', $product->product_name)

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->image_path) }}" class="img-fluid rounded" alt="{{ $product->product_name }}" style="width: 100%; height: 400px; object-fit: cover;">
            </div>
            <div class="col-md-6">
                <h1>{{ $product->product_name }}</h1>
                <p class="text-muted">價格：<strong>${{ $product->price }}</strong></p>
                <p>{{ $product->description }}</p>

                <!-- 數量選擇、加入購物車按鈕、返回按鈕 -->
                <div class="d-flex align-items-center mb-3">
                    <label for="quantity-{{ $product->product_id }}" class="form-label me-2 mb-0">購買數量：</label>
                    <input type="number" id="quantity-{{ $product->product_id }}" class="form-control me-2" value="1" min="1" style="width: 100px;">
                    <button class="btn btn-success me-2" onclick="addToCart({{ $product->product_id }}, '{{ $product->product_name }}', {{ $product->price }})">
                        加入購物車
                    </button>
                    <a href="{{ route('front.products.index') }}" class="btn btn-secondary">返回</a>
                </div>                
            </div>
        </div>
    </div>
@endsection
