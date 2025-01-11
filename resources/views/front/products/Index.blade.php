@extends('layouts.front')

@section('title', '所有商品')

@section('content')
    <h1 class="mb-4">所有商品</h1>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top img-fluid" alt="{{ $product->product_name }}" style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text text-muted">價格：${{ $product->price }}</p>
                        <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                        <div class="mt-auto d-flex align-items-center">
                            <!-- 數量選擇 -->
                            <input type="number" id="quantity-{{ $product->product_id }}" value="1" min="1" class="form-control me-2" style="width: 60px;">
                            <!-- 加入購物車按鈕 -->
                            <button class="btn btn-success me-2" onclick="addToCart({{ $product->product_id }}, '{{ $product->product_name }}', {{ $product->price }})">
                                加入購物車
                            </button>
                            <!-- 查看詳情按鈕 -->
                            <a href="{{ route('front.products.show', $product->product_id) }}" class="btn btn-primary">查看詳情</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
