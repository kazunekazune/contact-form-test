@extends('layouts.app')

@section('title', 'お問い合わせ内容の確認')

@section('content')
<form action="{{ route('contact.submit') }}" method="POST">
    @csrf
    <table>
        <tr>
            <th>お名前</th>
            <td>{{ $data['last_name'] }}　{{ $data['first_name'] }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>
                @if($data['gender'] == 1) 男性
                @elseif($data['gender'] == 2) 女性
                @else その他
                @endif
            </td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $data['email'] }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $data['tel'] }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $data['address'] }}</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>{{ $data['building'] }}</td>
        </tr>
        <tr>
            <th>お問い合わせの種類</th>
            <td>
                {{ \App\Models\Category::find($data['category_id'])->content ?? '' }}
            </td>
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>{{ $data['detail'] }}</td>
        </tr>
    </table>
    @foreach($data as $key => $value)
    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
    <button type="submit">送信</button>
</form>
<a href="{{ url()->previous() }}">修正</a>
@endsection