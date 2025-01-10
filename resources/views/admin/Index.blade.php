<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>後台產品首頁</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">所有產品</h1>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $product->image_path) }}" class="card-img-top img-fluid" alt="{{ $product->product_name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="card-text text-muted">價格：${{ $product->price }}</p>
                            <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                            <a href="{{ route('admin.products.edit', $product->product_id) }}" class="btn btn-primary">編輯</a>

                            <!-- 刪除按鈕 -->
                            <form action="{{ route('admin.products.destroy', $product->product_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('確定要刪除這個產品嗎？')">刪除</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
