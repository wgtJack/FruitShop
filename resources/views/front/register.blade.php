@extends('layouts.front')

@section('title', '註冊')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">註冊</h1>

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

        <!-- 註冊表單 -->
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <form action="{{ route('front.register.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">電子郵件</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="user_name" class="form-label">使用者名稱</label>
                        <input type="text" name="user_name" id="user_name" class="form-control"
                            value="{{ old('user_name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">手機</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">確認密碼</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                            required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">註冊</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- 登入連結 -->
        <p class="text-center mt-3">
            已有帳號！<a href="{{ route('front.login.form') }}">登入</a>
        </p>
    </div>
@endsection
