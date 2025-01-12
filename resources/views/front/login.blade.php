@extends('layouts.front')

@section('title', '登入')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">登入</h1>

        <!-- 顯示成功訊息 -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- 顯示錯誤訊息 -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 登入表單 -->
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <form action="{{ route('front.login.submit') }}" method="POST">
                    @csrf

                    <!-- 電子郵件 -->
                    <div class="mb-3">
                        <label for="email" class="form-label">電子郵件</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <!-- 密碼 -->
                    <div class="mb-3">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <!-- 提交按鈕 -->
                    <button type="submit" class="btn btn-primary w-100">登入</button>
                </form>
            </div>
        </div>

        <!-- 註冊連結 -->
        <p class="text-center mt-3">
            還沒有帳號？<a href="{{ route('front.register.form') }}">註冊</a>
        </p>
    </div>
@endsection
