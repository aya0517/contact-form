@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold my-6">管理画面</h1>

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border border-gray-300 p-2">ID</th>
                <th class="border border-gray-300 p-2">お名前</th>
                <th class="border border-gray-300 p-2">性別</th>
                <th class="border border-gray-300 p-2">メールアドレス</th>
                <th class="border border-gray-300 p-2">電話番号</th>
                <th class="border border-gray-300 p-2">お問い合わせの種類</th>
                <th class="border border-gray-300 p-2">お問い合わせ内容</th>
                <th class="border border-gray-300 p-2">登録日時</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td class="border border-gray-300 p-2">{{ $contact->id }}</td>
                <td class="border border-gray-300 p-2">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td class="border border-gray-300 p-2">
                    @if($contact->gender == 1) 男性
                    @elseif($contact->gender == 2) 女性
                    @else その他
                    @endif
                </td>
                <td class="border border-gray-300 p-2">{{ $contact->email }}</td>
                <td class="border border-gray-300 p-2">{{ $contact->tel }}</td>
                <td class="border border-gray-300 p-2">{{ $contact->category->content ?? 'なし' }}</td>
                <td class="border border-gray-300 p-2">{{ $contact->detail }}</td>
                <td class="border border-gray-300 p-2">{{ $contact->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $contacts->links() }} <!-- ページネーション -->
    </div>
</div>
@endsection