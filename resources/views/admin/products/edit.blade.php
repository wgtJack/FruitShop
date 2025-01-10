<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯產品</title>
</head>

<body>
    <h1>編輯產品</h1>

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

    <form action="{{ route('admin.products.update', $product->product_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="product_name">產品名稱</label>
            <input type="text" id="product_name" name="product_name" value="{{ $product->product_name }}" required>
        </div>

        <div>
            <label for="image">舊的圖片</label>
            <img src="{{ asset('storage/' . $product->image_path) }}" style="width: 200px; height:200px;"
                alt="{{ $product->product_name }}">
        </div>

        <div>
            <label for="image">圖片上傳</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div>
            <label for="price">價格</label>
            <input type="number" id="price" name="price" value="{{ $product->price }}" required>
        </div>

        <div>
            <label for="description">描述</label>
            <textarea id="description" name="description" required>{{ $product->description }}</textarea>
        </div>

        <div>
            <button type="submit">更新產品</button>
        </div>
    </form>
</body>

</html>
