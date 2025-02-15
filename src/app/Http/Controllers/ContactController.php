<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function show()
    {
        $categories = Category::whereNotNull('content')->orderBy('id')->get()->unique('content');

        return view('contact', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();
        $validated['tel'] = $validated['tel1'] . '-' . $validated['tel2'] . '-' . $validated['tel3'];
        $categoryName = Category::find($validated['category_id'])->content;

        return view('confirm', compact('validated', 'categoryName'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['tel'] = $data['tel1'] . '-' . $data['tel2'] . '-' . $data['tel3'];

        unset($data['tel1'], $data['tel2'], $data['tel3']);

        Contact::create($data);

        return redirect()->route('contact.thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
