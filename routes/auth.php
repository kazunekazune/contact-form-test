<?php

use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;

// ログイン・登録ページのビューを指定
Fortify::loginView(function () {
    return view('auth.login');
});

Fortify::registerView(function () {
    return view('auth.register');
});

// ログアウト
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->middleware('auth')->name('logout');
