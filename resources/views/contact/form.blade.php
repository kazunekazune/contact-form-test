@extends('layouts.app')

@section('title', 'お問合せフォーム')

@section('content')
<form action="{{ route('contact.confirm') }}" method="post">
    @csrf
<h1>Contact</h1>
    <div>
        <label>お名前 <span style="color:red;">※</span></label>
        <div style="display: flex; gap: 8px;">
            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例：山田" style="flex:1;">
            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例：太郎" style="flex:1;">
        </div>
        @error('last_name')
        <div class="error">{{ $message }}</div>
        @enderror
        @error('first_name')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>


    <div>
        <label>性別 <span style="color:red;">※</span></label>
        <label><input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>男性</label>
        <label><input type="radio" name="gender" value="2" {{ old('gender') == 1 ? 'checked' : '' }}>女性</label>
        <label><input type="radio" name="gender" value="3" {{ old('gender') == 1 ? 'checked' : '' }}その他</label>
            @error('gender')
            <div class0"error">{{ $message }}></div>
            @enderror
    </div>

    <div>
        <label>メールアドレス <span style="color:red;">※</span></label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
        @error('email')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>電話番号 <span style="color:red;">※</span></label>
        <div style="display: flex; gap: 8px; align-items: center;">
            <input type="text" name="tel1" value="{{ old('tel1') }}" maxlength="4" placeholder="例：080" style="width: 80px;">
            <span>-</span>
            <input type="text" name="tel2" value="{{ old('tel2') }}" maxlength="4" placeholder="例：1234" style="width: 80px;">
            <span>-</span>
            <input type="text" name="tel3" value="{{ old('tel3') }}" maxlength="4" placeholder="例：5678" style="width: 80px;">
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

    <div>
        <label>住所 <span style="color:red;">※</span></label>
        <input type="text" name="address" value="{{ old('address') }}">
        @error('address')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>建物名</label>
        <input type="text" name="building" value="{{ old('building') }}">
    </div>

    <div>
        <label>お問い合わせの種類 <span style="color:red;">※</span></label>
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

    <div>
        <label>お問い合わせ内容 <span style="color:red;">※</span></label>
        <textarea name="detail" maxlength="120">{{ old('detail') }}</textarea>
        @error('detail')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">確認画面</button>
</form>
@endsection