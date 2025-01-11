@extends('layouts.admin')

@section('title', '編輯產品')

@section('content')
<h1>編輯產品</h1>

<!-- 顯示驗證錯誤訊息 -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="product_name" class="form-label">產品名稱</label>
        <input type="text" id="product_name" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">舊的圖片</label>
        <img src="{{ asset('storage/' . $product->image_path) }}" style="width: 200px; height: 200px; display:block;" alt="{{ $product->product_name }}">
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">圖片上傳</label>
        <input type="file" id="image" name="image" class="form-control" accept="image/*">
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">價格</label>
        <input type="number" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">描述</label>
        <textarea id="description" name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success">更新產品</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">返回</a>
    </div>
</form>
@endsection
