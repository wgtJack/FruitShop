@extends('layouts.front')

@section('title', '個人資訊')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">個人資訊</h1>

        <!-- 顯示成功訊息 -->
        @if (session('successMessage'))
            <div class="alert alert-success">
                {{ session('successMessage') }}
            </div>
        @endif

        <!-- 顯示驗證錯誤訊息 -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 個人資訊卡片 -->
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <h4 class="card-title mb-4">個人資訊</h4>

                <!-- 使用者名稱 -->
                <div class="mb-3">
                    <p class="form-control-plaintext">使用者名稱: {{ $user->user_name }}</p>
                </div>

                <!-- 電子郵件 -->
                <div class="mb-3">
                    <p class="form-control-plaintext">電子郵件 :{{ $user->email }}</p>
                </div>

                <!-- 更新表單 -->
                <form action="{{ route('front.profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- 手機 -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">手機</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                    </div>

                    <!-- 新密碼 -->
                    <div class="mb-3">
                        <label for="password" class="form-label">新密碼</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <!-- 確認新密碼 -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">確認新密碼</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>

                    <!-- 更新按鈕 -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">更新資訊</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
