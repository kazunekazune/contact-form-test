<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController; // 名前空間に注意
use Illuminate\Support\Facades\Route;


//お問合せフォーム
Route::get('/', [ContactController::class, 'form'])->name('contact.form');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

// 管理画面ルート
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // ここに追加: お問い合わせ詳細情報を取得するAPIエンドポイント
    Route::get('/contact/{id}', [AdminController::class, 'show'])->name('admin.show');

    // 必要に応じてエクスポート機能も追加
    Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
});

// 認証関連
require __DIR__ . '/auth.php';

// プロフィール関連ルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});