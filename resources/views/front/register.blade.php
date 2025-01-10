<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊</title>
</head>

<body>
    <h1>註冊頁面</h1>

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

    <!-- 註冊表單 -->
    <form action="{{ route('front.register.submit') }}" method="POST">
        @csrf

        <label for="email">電子郵件：</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required><br>

        <label for="user_name">使用者名稱：</label>
        <input type="text" name="user_name" id="user_name" value="{{ old('user_name') }}" required><br>

        <label for="phone">手機：</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required><br>

        <label for="address">住址：</label>
        <input type="text" name="address" id="address" value="{{ old('address') }}" required><br>

        <label for="password">密碼：</label>
        <input type="password" name="password" id="password" required><br>

        <label for="password_confirmation">確認密碼：</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required><br>

        <button type="submit">註冊</button>
    </form>
</body>

</html>
