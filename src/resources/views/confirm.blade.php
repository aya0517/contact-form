@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">

<header class="header">
    <div class="header_inner">
        <a class="header_logo" href="/">
            FashionablyLate
        </a>
    </div>
</header>

<main>
    <div class="confirm__content">
        <div class="confirm__heading">
            <h2>Confirm</h2>
        </div>
            <div class="confirm-table">
                <table class="confirm-table__inner">
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お名前</th>
                        <td class="confirm-table__text">
                            {{ $validated['first_name'] }} {{ $validated['last_name'] }}
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">性別</th>
                        <td class="confirm-table__text">
                            @if($validated['gender'] == 1) 男性
                            @elseif($validated['gender'] == 2) 女性
                            @else その他
                            @endif
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">メールアドレス</th>
                        <td class="confirm-table__text">
                            {{ $validated['email'] }}
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">電話番号</th>
                        <td class="confirm-table__text">
                            {{ $validated['tel'] }}
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">住所</th>
                        <td class="confirm-table__text">
                            {{ $validated['address'] }}
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">建物名</th>
                        <td class="confirm-table__text">
                            {{ $validated['building'] ?? '' }}
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせの種類</th>
                        <td class="confirm-table__text">
                            {{ $categoryName }}
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせ内容</th>
                        <td class="confirm-table__text">
                            {{ $validated['detail'] }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="form_button">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    @foreach($validated as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <button class="form__button-submit" type="submit">送信</button>
                </form>
                <form action="{{ route('contact.show') }}" method="GET">
                    <button class="form__button-edit" button type="submit">修正</button>
                </form>
            </div>
        </form>
    </div>
</main>
</body>

</html>