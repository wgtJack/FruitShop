@extends('layouts.admin')

@section('title', '新增產品')

@section('content')
    <div class="container mt-4">
        <h1>新增產品</h1>

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

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="product_name" class="form-label">產品名稱</label>
                <input type="text" id="product_name" name="product_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">圖片上傳</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">價格</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">描述</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">新增產品</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">返回</a>
            </div>
        </form>
    </div>
@endsection
