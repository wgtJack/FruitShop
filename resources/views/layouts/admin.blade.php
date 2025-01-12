<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '後台') | 冠廷水果店（後台系統）</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- 導覽列 -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.products.index') }}">後台系統</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- 未登入時的選項 -->
                    @guest('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">返回前台首頁</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.login.form') }}">登入</a>
                        </li>
                    @else
                        <!-- 已登入時顯示的管理選項 -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.index') }}">產品管理</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.orders.index') }}">訂單管理</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">返回前台首頁</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('admin.logout.submit') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn nav-link text-white text-decoration-none logout-btn">
                                    登出
                                </button>
                            </form>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
