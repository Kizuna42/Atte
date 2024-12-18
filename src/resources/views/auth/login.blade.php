@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2>ログイン</h2>
    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf
        <div class="form-group">
            <input type="email" name="email" placeholder="メールアドレス" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="パスワード" required>
        </div>
        <button type="submit" class="auth-button">ログイン</button>
        <div class="login-section">
            <p class="auth-link">アカウントをお持ちでない方はこちらから</p>
            <a href="{{ route('register') }}" style = "color: blue;">会員登録</a>
        </div>
    </form>
</div>
@endsection