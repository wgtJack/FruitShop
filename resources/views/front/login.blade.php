<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
</head>

<body>
    <h1>登入頁面</h1>

    <!-- 顯示錯誤訊息 -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 顯示註冊成功訊息 -->
    @if (session('successMessage'))
        <p>{{ session('successMessage') }}</p>
    @endif

    <!-- 登入表單 -->
    <form action="{{ route('front.login.submit') }}" method="POST">
        @csrf

        <label for="email">電子郵件：</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required><br>

        <label for="password">密碼：</label>
        <input type="password" name="password" id="password" required><br>

        <!-- 顯示 loginError 錯誤訊息 -->
        @error('loginError')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">登入</button>
    </form>

    <!-- 註冊超連結 -->
    <p>還沒有帳號？<a href="/account/register">註冊</a></p>
</body>

</html>
