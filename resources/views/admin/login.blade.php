@extends('layouts.admin')

@section('title', '後台登入')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">後台登入</h1>

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
                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="account" class="form-label">帳號</label>
                        <input type="text" id="account" name="account" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">密碼</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <p class="text-muted">測試用帳號和密碼都是 admin1234</p>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">登入</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
