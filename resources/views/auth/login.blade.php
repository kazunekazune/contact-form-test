@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<h2>Login</h2>
<form method="POST" action="{{ route('login') }}">
    @csrf

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

    <button type="submit">ログイン</button>
</form>
<div>
    <a href="{{ route('register') }}">register</a>
</div>
@endsection