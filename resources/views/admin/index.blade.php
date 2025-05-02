@extends('layouts.app')

@section('content')
<h2 class="admin-title">Admin</h2>

<div class="admin-container">
    <div class="search-box">
        <form class="search-form" action="{{ route('admin.index') }}" method="GET">
            <input type="text" name="search" class="search-input" placeholder="名前やメールアドレスを入力してください">

            <select name="gender" class="search-select">
                <option value="">性別</option>
                <option value="男性">男性</option>
                <option value="女性">女性</option>
            </select>

            <select name="category_id" class="search-select">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>

            <input type="date" name="date" class="search-date">

            <button type="submit" class="btn btn-search">検索</button>
            <button type="reset" class="btn btn-reset">リセット</button>
        </form>
    </div>

    <div class="bottom-controls">
        <button class="export-btn">エクスポート</button>
        {{ $contacts->links() }}
    </div>

    <div class="table-container">
        <table class="contact-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th>詳細</th>
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

        <div class="pagination-container">
            {{ $contacts->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<!-- モーダル -->
<div id="detailModal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <div class="modal-body">
        </div>
    </div>
</div>
@endsection

@section('page_css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('page_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('detailModal');
        const modalClose = modal.querySelector('.modal-close');
        const modalBody = modal.querySelector('.modal-body');
        const detailButtons = document.querySelectorAll('.btn-detail');

        detailButtons.forEach(button => {
            button.addEventListener('click', async () => {
                const id = button.dataset.id;
                try {
                    const response = await fetch(`/admin/${id}`);
                    const data = await response.json();

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
                        <dd>${data.building || '---'}</dd>
                        <dt>お問い合わせの種類</dt>
                        <dd>${data.category.name}</dd>
                        <dt>お問い合わせ内容</dt>
                        <dd>${data.detail}</dd>
                    </dl>
                `;
                    modal.style.display = 'block';
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });

        modalClose.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>
@endsection