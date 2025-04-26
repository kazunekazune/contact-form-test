<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', [ContactController::class, 'form'])->name('contact.form');

// お問い合わせフォーム
Route::get('/', [ContactController::class, 'form'])->name('contact.form');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

// 管理画面
#Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// 認証（Laravel BreezeやJetstream導入時は自動でルートが追加されます）

// ユーザ登録・ログインページは認証パッケージで自動生成されることが多いです
