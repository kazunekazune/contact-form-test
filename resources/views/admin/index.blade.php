@extends('layouts.app')

@section('title', 'Admin Dashboard | FashionablyLate')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('header_button')
<form method="POST" action="{{ route('logout') }}" style="display: inline;">
    @csrf
    <button type="submit" class="register-btn">logout</button>
</form>
@endsection

@section('content')
<div class="admin-container">
    <h2 class="admin-title">管理画面</h2>
    <div class="admin-content">
        <p>ようこそ、{{ Auth::user()->name }}さん</p>

        <div class="search-form">
            <form method="GET" action="{{ route('admin.index') }}">
                <div class="search-row">
                    <input type="text" name="search" class="search-input" placeholder="名前やメールアドレスを入力" value="{{ request('search') }}">
                    <select name="gender" class="search-select">
                        <option value="">性別</option>
                        <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
                        <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
                    </select>
                    <select name="type" class="search-select">
                        <option value="">お問い合わせの種類</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('type') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    <input type="date" name="date" class="search-date" value="{{ request('date') }}">
                    <button type="submit" class="btn btn-search">検索</button>
                    <a href="{{ route('admin.index') }}" class="btn btn-reset">リセット</a>
                </div>
            </form>
        </div>

        <div class="contact-list">
            <table class="contact-table">
                <thead>
                    <tr>
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->gender }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category->name }}</td>
                        <td>
                            <button type="button" class="btn-detail" data-id="{{ $contact->id }}">詳細</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $contacts->links() }}
        </div>
    </div>
</div>

<!-- 詳細モーダル -->
<div id="detailModal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h3>お問い合わせ詳細</h3>
        <div class="modal-body">
            <!-- JavaScriptで動的に内容を設定 -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('detailModal');
        const modalBody = modal.querySelector('.modal-body');
        const closeBtn = modal.querySelector('.modal-close');

        document.querySelectorAll('.btn-detail').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                fetch(`/admin/contacts/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        modalBody.innerHTML = `
                        <dl>
                            <dt>お名前</dt>
                            <dd>${data.name}</dd>
                            <dt>性別</dt>
                            <dd>${data.gender}</dd>
                            <dt>メールアドレス</dt>
                            <dd>${data.email}</dd>
                            <dt>電話番号</dt>
                            <dd>${data.tel}</dd>
                            <dt>住所</dt>
                            <dd>${data.address}</dd>
                            <dt>建物名</dt>
                            <dd>${data.building || '-'}</dd>
                            <dt>お問い合わせの種類</dt>
                            <dd>${data.category.name}</dd>
                            <dt>お問い合わせ内容</dt>
                            <dd>${data.detail}</dd>
                        </dl>
                    `;
                        modal.style.display = 'block';
                    });
            });
        });

        closeBtn.addEventListener('click', () => modal.style.display = 'none');
        window.addEventListener('click', (e) => {
            if (e.target == modal) modal.style.display = 'none';
        });
    });
</script>
@endpush