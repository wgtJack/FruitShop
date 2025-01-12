@extends('layouts.admin')

@section('title', '產品管理')

@section('content')
    <h1 class="mb-4">產品管理</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">新增產品</a>

    <!-- 顯示成功訊息 -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top img-fluid"
                        alt="{{ $product->product_name }}" style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text text-muted">價格：${{ $product->price }}</p>
                        <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                        <a href="{{ route('admin.products.edit', $product->product_id) }}" class="btn btn-primary">編輯</a>
                        <form action="{{ route('admin.products.destroy', $product->product_id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('確定要刪除這個產品嗎？')">刪除</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
