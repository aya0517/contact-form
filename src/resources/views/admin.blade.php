@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<header class="header">
    <div class="header_inner">
        <a class="header_logo" href="/">
            FashionablyLate
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">logout</button>
        </form>
    </div>
</header>

<main>
    <div class="admin__content">
        <h2>Admin</h2>

        <!-- 検索フォーム -->
        <form action="{{ route('admin') }}" method="GET">
            <div class="search-box">
                <input type="text" name="name" value="{{ request('name') }}" placeholder="名前やメールアドレスを入力してください">
                <select name="gender">
                    <option value="">性別</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>
                <select name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                    @endforeach
                </select>
                <input type="date" name="date" value="{{ request('date') }}">
                <button type="submit" class="search-button">検索</button>
                <a href="{{ route('admin') }}" class="reset-button">リセット</a>
            </div>
        </form>

        <!-- エクスポートボタン -->
        <form action="{{ route('admin.export') }}" method="GET">
            <button type="submit" class="export-button">エクスポート</button>
        </form>

        <!-- お問い合わせ一覧 -->
        <table class="admin-table">
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
                    <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                    <td>
                        @if($contact->gender == 1) 男性
                        @elseif($contact->gender == 2) 女性
                        @else その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>
                        <button class="detail-button" data-id="{{ $contact->id }}">詳細</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- ページネーション -->
        <div class="pagination">
            {{ $contacts->links() }}
        </div>
    </div>

    <!-- モーダルウィンドウ -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>お問い合わせ詳細</h3>
            <p><strong>お名前:</strong> <span id="modal-name"></span></p>
            <p><strong>性別:</strong> <span id="modal-gender"></span></p>
            <p><strong>メールアドレス:</strong> <span id="modal-email"></span></p>
            <p><strong>電話番号:</strong> <span id="modal-tel"></span></p>
            <p><strong>住所:</strong> <span id="modal-address"></span></p>
            <p><strong>建物名:</strong> <span id="modal-building"></span></p>
            <p><strong>お問い合わせの種類:</strong> <span id="modal-category"></span></p>
            <p><strong>お問い合わせ内容:</strong> <span id="modal-detail"></span></p>
            <button id="delete-button">削除</button>
        </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // モーダル開閉処理
        const modal = document.getElementById("modal");
        const closeButton = document.querySelector(".close");
        const deleteButton = document.getElementById("delete-button");

        document.querySelectorAll(".detail-button").forEach(button => {
            button.addEventListener("click", function() {
                const contactId = this.getAttribute("data-id");

                fetch(`/admin/contact/${contactId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("modal-name").textContent = data.first_name + " " + data.last_name;
                        document.getElementById("modal-gender").textContent = data.gender == 1 ? "男性" : data.gender == 2 ? "女性" : "その他";
                        document.getElementById("modal-email").textContent = data.email;
                        document.getElementById("modal-tel").textContent = data.tel;
                        document.getElementById("modal-address").textContent = data.address;
                        document.getElementById("modal-building").textContent = data.building || "";
                        document.getElementById("modal-category").textContent = data.category.content;
                        document.getElementById("modal-detail").textContent = data.detail;
                        deleteButton.setAttribute("data-id", contactId);
                        modal.style.display = "block";
                    });
            });
        });

        closeButton.addEventListener("click", function() {
            modal.style.display = "none";
        });

        deleteButton.addEventListener("click", function() {
            const contactId = this.getAttribute("data-id");
            fetch(`/admin/contact/${contactId}/delete`, {
                    method: "DELETE"
                })
                .then(() => {
                    alert("削除しました");
                    modal.style.display = "none";
                    location.reload();
                });
        });
    });
</script>
@endsection