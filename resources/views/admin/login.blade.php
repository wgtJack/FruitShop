<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>後台登入</title>
</head>

<body>
    <h1>後台登入頁面</h1>

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

    <!-- 登入表單 -->
    <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf

        <label for="account">帳號：</label>
        <input type="account" name="account" id="account" value="{{ old('account') }}" required><br>

        <label for="password">密碼：</label>
        <input type="password" name="password" id="password" required><br>

        <!-- 顯示 loginError 錯誤訊息 -->
        @error('loginError')
            <div style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">登入</button>
    </form>
</body>

</html>
