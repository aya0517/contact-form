@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection
@section('content')

<main>
    <div class="admin__content">
        <div class="admin__content-header">
            <h2>Admin</h2>
        </div>

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

        <div class="export-pagination-container">
            <!-- エクスポートボタン（左揃え） -->
            <div class="export-button-container">
                <form action="{{ route('admin.export') }}" method="GET">
                    <button type="submit" class="export-button">エクスポート</button>
                </form>
            </div>

            <!-- ページネーション（右揃え） -->
            <div class="pagination-container">
                {{ $contacts->links('vendor.pagination.custom') }}
            </div>
        </div>

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

        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-inner">
                    <table class="modal-table">
                        <tr>
                            <th>お名前</th>
                            <td><span id="modal-name"></span></td>
                        </tr>
                        <tr>
                            <th>性別</th>
                            <td><span id="modal-gender"></span></td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td><span id="modal-email"></span></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td><span id="modal-tel"></span></td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td><span id="modal-address"></span></td>
                        </tr>
                        <tr>
                            <th>建物名</th>
                            <td><span id="modal-building"></span></td>
                        </tr>
                        <tr>
                            <th>お問い合わせの種類</th>
                            <td><span id="modal-category"></span></td>
                        </tr>
                        <tr>
                            <th>お問い合わせ内容</th>
                            <td><span id="modal-detail"></span></td>
                        </tr>
                    </table>
                    <button id="delete-button">削除</button>
                </div>
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