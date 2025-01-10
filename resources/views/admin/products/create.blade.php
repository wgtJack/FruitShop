<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增產品</title>
</head>
<body>
    <h1>新增產品</h1>
    
    <!-- 顯示驗證錯誤訊息 -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="product_name">產品名稱</label>
            <input type="text" id="product_name" name="product_name" required>
        </div>

        <div>
            <label for="image">圖片上傳</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <div>
            <label for="price">價格</label>
            <input type="number" id="price" name="price" required>
        </div>

        <div>
            <label for="description">描述</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <div>
            <button type="submit">新增產品</button>
        </div>
    </form>
</body>
</html>
