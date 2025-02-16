<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('category');

        // 検索機能
        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name . '%')
                    ->orWhere('email', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 7件ごとのページネーション
        $contacts = $query->latest()->paginate(7);
        $categories = Category::select('id','content')->distinct()->get();;

        return view('admin', compact('contacts', 'categories'));
    }

    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return response()->json($contact);
    }

    public function destroy(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => '削除しました']);
    }

    public function export(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('name')) {
            $query->where('first_name', 'like', '%' . $request->name . '%')
                ->orWhere('last_name', 'like', '%' . $request->name . '%')
                ->orWhere('email', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        $csv = "名前,性別,メールアドレス,お問い合わせ種類,お問い合わせ内容\n";
        foreach ($contacts as $contact) {
            $csv .= "{$contact->first_name} {$contact->last_name},"
                . ($contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他')) . ","
                . "{$contact->email},"
                . "{$contact->category->content},"
                . "{$contact->detail}\n";
        }

        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, 'contacts.csv', [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);
    }
}
