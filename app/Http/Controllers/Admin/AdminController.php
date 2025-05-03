<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * お問い合わせ一覧を表示
     */
    public function index(Request $request)
    {
        // カテゴリーのデータを取得（これが重要）
        $categories = Category::all();

        // お問い合わせデータのクエリを初期化
        $query = Contact::query()->with('category');

        // 検索条件の適用
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        // お問い合わせデータを取得（ページネーション付き）
        $contacts = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.index', compact('contacts', 'categories'));
    }

    /**
     * お問い合わせの詳細情報を取得（APIエンドポイント）
     * この show メソッドが追加されていない可能性があります
     */
    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return response()->json($contact);
    }

    /**
     * データのエクスポート機能
     */
    public function export(Request $request)
    {
        // エクスポート機能の実装
        // 仮の実装としてCSVファイルを出力する例
        $query = Contact::query()->with('category');

        // 検索条件があれば適用
        // ...

        $contacts = $query->get();

        // CSVヘッダー
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts_export.csv"',
        ];

        // 出力バッファリングを開始
        $callback = function () use ($contacts) {
            $file = fopen('php://output', 'w');

            // ヘッダー行
            fputcsv($file, ['ID', 'お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせ種類', 'お問い合わせ内容', '作成日']);

            // データ行
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->name,
                    $contact->gender,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->name ?? '不明',
                    $contact->detail,
                    $contact->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
