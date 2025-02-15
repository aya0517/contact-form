<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact form</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}" />
    <link rel="stylesheet" href="{{asset('css/contact.css')}}" />
</head>

<body>
    <header class="header">
        <div class="header_inner">
            <a class="header_logo" href="/">
                FashionablyLate
            </a>
        </div>
    </header>

    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>Contact</h2>
            </div>
            <form class="form" action="/confirm" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 山田" />
                        </div>
                        <div class="form__error">
                            @error('first_name')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form__input--text">
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 太郎" />
                        </div>
                        <div class="form__error">
                            @error('last_name')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            性別
                        </span>
                    </div>
                    <div class="form__group-content">
                        <label><input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}> 男性</label>
                        <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
                        <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
                    </div>
                    <div class="form__error">
                        @error('gender')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            メールアドレス
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com" />
                        </div>
                        <div class="form__error">
                            @error('email')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            電話番号
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="tel" name="tel" value="{{ old('tel') }}" placeholder="080 1234 5678" />
                            <!--3つに分けて入力し、間にハイフンを表示-->
                        </div>
                        <div class="form__error">
                            @error('tel')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            住所
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" />
                        </div>
                        <div class="form__error">
                            @error('address')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            建物名
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101" />
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            お問い合わせの種類
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__group-content">
                            <select name="category_id">
                                <option value="">選択してください</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->content }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form__error">
                            @error('category_id')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">
                            お問い合わせ内容
                        </span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <textarea name="detail" rows="4" maxlength="120" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                        </div>
                        <div class="form__error">
                            @error('detail')
                            <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
    </main>




</body>

</html>