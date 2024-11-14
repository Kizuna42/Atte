@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2>会員登録</h2>
    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf
        <div class="form-group">
            <input type="text" name="name" placeholder="名前" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="メールアドレス" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="パスワード" required>
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" placeholder="確認用パスワード" required>
        </div>
        <button type="submit" class="auth-button">会員登録</button>
        <div class="login-section">
            <p class="auth-link">アカウントをお持ちの方はこちらから</p>
            <a href="{{ route('login') }}" style = "color: blue;">ログイン</a>
        </div>
    </form>
</div>
@endsection