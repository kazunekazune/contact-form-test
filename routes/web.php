<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

// お問い合わせフォーム関連（認証不要）
Route::get('/', [ContactController::class, 'form'])->name('contact.form');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

// 管理画面（認証必要）
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // プロフィール関連
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
