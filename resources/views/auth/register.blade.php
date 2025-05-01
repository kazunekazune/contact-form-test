@extends('layouts.app')

@section('title', 'Register | FashionablyLate')

@section('header_button')
<a href="/login" class="register-btn">login</a>
@endsection

@section('page_css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-container">
    <h2 class="login-title">Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="name">お名前</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" required>
            @error('password')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">パスワード（確認用）</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>
        <button type="submit" class="login-btn">登録する</button>
    </form>
</div>
@endsection