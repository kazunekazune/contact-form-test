@extends('layouts.app')

@section('title', 'お問合せフォーム')

@section('page_css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
<form action="{{ route('contact.confirm') }}" method="post">
    @csrf
    <h2 class="contact-title">Contact</h2>

    <div class="form-group">
        <label class="form-label">お名前 <span>※</span></label>
        <div class="input-container">
            <div class="name-inputs">
                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例：山田">
                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例：太郎">
            </div>
            @error('last_name')
            <div class="error">{{ $message }}</div>
            @enderror
            @error('first_name')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">性別 <span>※</span></label>
        <div class="contact-radio-group">
            <label><input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>男性</label>
            <label><input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>女性</label>
            <label><input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}>その他</label>
        </div>
        @error('gender')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">メールアドレス <span>※</span></label>
        <div class="input-container">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">電話番号 <span>※</span></label>
        <div class="input-container">
            <div class="tel-inputs">
                <input type="text" name="tel1" value="{{ old('tel1') }}" maxlength="4" placeholder="例：080">
                <span>-</span>
                <input type="text" name="tel2" value="{{ old('tel2') }}" maxlength="4" placeholder="例：1234">
                <span>-</span>
                <input type="text" name="tel3" value="{{ old('tel3') }}" maxlength="4" placeholder="例：5678">
            </div>
            @error('tel1')
            <div class="error">{{ $message }}</div>
            @enderror
            @error('tel2')
            <div class="error">{{ $message }}</div>
            @enderror
            @error('tel3')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">住所 <span>※</span></label>
        <div class="input-container">
            <input type="text" name="address" value="{{ old('address') }}" placeholder="例：東京都千代田区永田町1-7-1">
            @error('address')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">建物名</label>
        <div class="input-container">
            <input type="text" name="building" value="{{ old('building') }}" placeholder="例：永田町ビル">
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">お問い合わせの種類 <span>※</span></label>
        <div class="input-container">
            <select name="category_id">
                <option value="">選択してください</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">お問い合わせ内容 <span>※</span></label>
        <div class="input-container">
            <textarea name="detail" maxlength="120" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
            @error('detail')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit">確認画面</button>
</form>
@endsection