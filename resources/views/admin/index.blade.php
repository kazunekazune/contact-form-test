@extends('layouts.app')

@section('content')
<h2 class="admin-title">Admin</h2>

<div class="admin-container">
    <div class="search-box">
        <form class="search-form" action="{{ route('admin.index') }}" method="GET">
            <input type="text" name="search" class="search-input" placeholder="名前やメールアドレスを入力してください" value="{{ request('search') }}">

            <select name="gender" class="search-select">
                <option value="">性別</option>
                <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
                <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
            </select>

            <select name="category_id" class="search-select">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>

            <input type="date" name="date" class="search-date" value="{{ request('date') }}">

            <button type="submit" class="btn btn-search">検索</button>
            <a href="{{ route('admin.index') }}" class="btn btn-reset">リセット</a>
        </form>
    </div>

    <div class="bottom-controls">
        <button class="export-btn">エクスポート</button>
        <div class="pagination-container">
            {{ $contacts->links() }}
        </div>
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
                @forelse($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->gender }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->name ?? '不明' }}</td>
                    <td>
                        <button type="button" class="btn-detail" data-id="{{ $contact->id }}">詳細</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center;">お問い合わせデータがありません</td>
                </tr>
                @endforelse
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
            <!-- モーダルの内容はJavaScriptで動的に挿入されます -->
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
        // モーダル要素を取得
        const modal = document.getElementById('detailModal');
        if (!modal) {
            console.error('Modal element not found');
            return;
        }

        const modalClose = modal.querySelector('.modal-close');
        const modalBody = modal.querySelector('.modal-body');
        const detailButtons = document.querySelectorAll('.btn-detail');

        // エラーハンドリング用の関数
        function showError(message) {
            console.error(message);
            alert('エラーが発生しました。詳細はコンソールをご確認ください。');
        }

        // 詳細ボタンのイベントリスナーを設定
        detailButtons.forEach(button => {
            button.addEventListener('click', async () => {
                const id = button.getAttribute('data-id');
                if (!id) {
                    showError('Contact ID not found');
                    return;
                }

                try {
                    // APIエンドポイントを確認（必要に応じてパスを調整）
                    const response = await fetch(`/admin/contact/${id}`);

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();

                    // モーダル内容を設定
                    modalBody.innerHTML = `
                    <dl>
                        <dt>お名前</dt>
                        <dd>${data.name || '---'}</dd>
                        <dt>性別</dt>
                        <dd>${data.gender || '---'}</dd>
                        <dt>メールアドレス</dt>
                        <dd>${data.email || '---'}</dd>
                        <dt>電話番号</dt>
                        <dd>${data.tel || '---'}</dd>
                        <dt>住所</dt>
                        <dd>${data.address || '---'}</dd>
                        <dt>建物名</dt>
                        <dd>${data.building || '---'}</dd>
                        <dt>お問い合わせの種類</dt>
                        <dd>${data.category?.name || '---'}</dd>
                        <dt>お問い合わせ内容</dt>
                        <dd>${data.detail || '---'}</dd>
                    </dl>
                    `;

                    // モーダルを表示
                    modal.style.display = 'block';

                } catch (error) {
                    showError(`Error fetching contact details: ${error.message}`);
                }
            });
        });

        // モーダルを閉じる機能
        if (modalClose) {
            modalClose.addEventListener('click', () => {
                modal.style.display = 'none';
            });
        }

        // モーダル外をクリックして閉じる
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // リセットボタンの動作（フォーム要素のみリセット）
        const resetBtn = document.querySelector('.btn-reset');
        if (resetBtn && resetBtn.tagName === 'BUTTON') {
            resetBtn.addEventListener('click', (e) => {
                e.preventDefault();
                const form = e.target.closest('form');
                if (form) form.reset();
            });
        }
    });
</script>
@endsection