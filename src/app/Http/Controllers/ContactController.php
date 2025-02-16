<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function show(Request $request)
    {
        $categories = Category::whereNotNull('content')->orderBy('id')->get()->unique('content');

        // POSTリクエストでデータをセッションに保存
        if ($request->isMethod('post')) {
            session()->put('contact_data', $request->except('_token'));
        }

        // セッションに保存されたデータを取得
        $contactData = session('contact_data', []);

        return view('contact', compact('categories', 'contactData'));
    }

    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();
        $validated['tel'] = $validated['tel1'] . '-' . $validated['tel2'] . '-' . $validated['tel3'];
        $categoryName = Category::find($validated['category_id'])->content;

        // データをセッションに保存
        session()->put('contact_data', $validated);

        return view('confirm', compact('validated', 'categoryName'));
    }

    public function store(Request $request)
    {
        // セッションからデータを取得
        $data = session('contact_data', []);

        if (empty($data)) {
            return redirect()->route('contact.show')->withErrors(['error' => 'データが見つかりません。']);
        }

        Contact::create($data);

        // セッションのデータを削除
        session()->forget('contact_data');

        return redirect()->route('contact.thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
