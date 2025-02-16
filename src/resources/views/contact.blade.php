@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')

<body>
    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>Contact</h2>
            </div>

            <form class="form" action="{{ route('contact.confirm') }}" method="post">
                @csrf
                <table class="form-table">
                    <tr>
                        <th>お名前<span class="required">※</span></th>
                        <td class="form__input--name">
                            <input type="text" name="first_name" value="{{ session('contact_data.first_name', '') }}" placeholder="例: 山田" />
                            <input type="text" name="last_name" value="{{ session('contact_data.last_name', '') }}" placeholder="例: 太郎" />
                        </td>
                    </tr>

                    <tr>
                        <th>性別<span class="required">※</span></th>
                        <td class="form__input--gender">
                            <label>
                                <input type="radio" name="gender" value="1" {{ session('contact_data.gender') == '1' ? 'checked' : '' }}>
                                <span class="custom-radio"></span> 男性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="2" {{ session('contact_data.gender') == '2' ? 'checked' : '' }}>
                                <span class="custom-radio"></span> 女性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="3" {{ session('contact_data.gender') == '3' ? 'checked' : '' }}>
                                <span class="custom-radio"></span> その他
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <th>メールアドレス<span class="required">※</span></th>
                        <td>
                            <input type="email" name="email" value="{{ session('contact_data.email', '') }}" placeholder="例: test@example.com" />
                        </td>
                    </tr>

                    <tr>
                        <th>電話番号<span class="required">※</span></th>
                        <td class="form__input--tel">
                            <input type="text" name="tel1" value="{{ session('contact_data.tel1', '') }}" placeholder="080"> -
                            <input type="text" name="tel2" value="{{ session('contact_data.tel2', '') }}" placeholder="1234"> -
                            <input type="text" name="tel3" value="{{ session('contact_data.tel3', '') }}" placeholder="5678">
                        </td>
                    </tr>

                    <tr>
                        <th>住所<span class="required">※</span></th>
                        <td>
                            <input type="text" name="address" value="{{ session('contact_data.address', '') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" />
                        </td>
                    </tr>

                    <tr>
                        <th>建物名</th>
                        <td>
                            <input type="text" name="building" value="{{ session('contact_data.building', '') }}" placeholder="例: 千駄ヶ谷マンション101" />
                        </td>
                    </tr>

                    <tr>
                        <th>お問い合わせの種類<span class="required">※</span></th>
                        <td class="form__input--select">
                            <select name="category_id" required>
                                <option value="">選択してください</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ session('contact_data.category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->content }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>お問い合わせ内容<span class="required">※</span></th>
                        <td>
                            <textarea name="detail" rows="4" maxlength="120" placeholder="お問い合わせ内容をご記載ください">{{ session('contact_data.detail', '') }}</textarea>
                        </td>
                    </tr>
                </table>

                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>