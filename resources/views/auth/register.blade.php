@extends('layouts.app')

@section('title', 'ユーザー登録')

@section('content')
<h2>Register</h2>
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div>
        <label for="name">お名前</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="例：山田 太郎">
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="例：test@example.com">
        @error('email')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password">パスワード</label>
        <input id="password" type="password" name="password" required placeholder="例：coachtech106">
        @error('password')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">登録</button>
</form>
<div>
    <a href="{{ route('login') }}">login</a>
</div>
@endsection