@extends('layouts.app')

@section('title', 'Login | FashionablyLate')

@section('header_button')
<a href="/register" class="register-btn">register</a>
@endsection

@section('page_css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-container">
    <h2 class="login-title">Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" placeholder="例: test@example.com" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" placeholder="例: coachtech1106" required>
        </div>
        <button type="submit" class="login-btn">ログイン</button>
        </div>
    </form>
</div>
@endsection