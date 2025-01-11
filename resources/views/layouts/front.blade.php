<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '前台') | 冠廷水果店</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* 自訂樣式：讓購物車數量的 badge 顯示為紅色泡泡 */
        .navbar .cart-icon .badge {
            position: absolute;
            top: 3px;
            right: 55px;
            background-color: #dc3545;
            /* 紅色背景 */
            color: #fff;
            /* 白色字體 */
            border-radius: 50%;
            /* 圓形 */
            padding: 5px 7px;
            /* 適當的間距 */
            font-size: 12px;
            /* 字體大小 */
            min-width: 15px;
            text-align: center;
        }

        /* 統一 nav-link 樣式 */
        .logout-btn {
            background: none;
            border: none;
            padding: 8px 15px;
            /* 調整按鈕內部間距，與 a 標籤一致 */
            text-align: left;
            /* 對齊文字 */
            transition: color 0.3s ease;
            /* 添加滑順的 hover 效果 */
        }

        /* Hover 效果 */
        .logout-btn:hover {
            color: #f8f9fa;
            /* 白色 */
            background-color: rgba(255, 255, 255, 0.1);
            /* 顯示淺色背景 */
            border-radius: 5px;
            /* 圓角效果 */
        }
    </style>
</head>

<body>
    <!-- 導覽列 -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('front.products.index') }}">冠廷水果店</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <!-- 未登入選項 -->
                    @guest('web')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.products.index') }}">所有商品</a>
                        </li>
                        <li class="nav-item cart-icon">
                            <a class="nav-link" href="{{ route('front.carts.cart') }}">
                                <i class="bi bi-cart-fill">購物車</i> <!-- 購物車圖示 -->
                                <span class="badge" id="cart-count">0</span> <!-- 顯示購物車數量 -->
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.login.form') }}">登入</a>
                        </li>
                    @else
                        <!-- 已登入選項 -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.orders.index') }}">檢視訂單</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.profile.show') }}">個人資訊</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.products.index') }}">所有商品</a>
                        </li>
                        <li class="nav-item cart-icon">
                            <a class="nav-link" href="{{ route('front.carts.cart') }}">
                                <i class="bi bi-cart-fill">購物車</i> <!-- 購物車圖示 -->
                                <span class="badge" id="cart-count">0</span> <!-- 顯示購物車數量 -->
                            </a>
                        </li>
                        <li class="nav-item">
                        <li class="nav-item">
                            <form action="{{ route('front.logout.submit') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn nav-link text-white text-decoration-none logout-btn">
                                    登出
                                </button>
                            </form>
                        </li>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- 主內容 -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- 引入 JavaScript 檔案 -->
    <script src="{{ asset('js/cart.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
