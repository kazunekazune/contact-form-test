<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function form()
    {
        $categories = Category::all();
        return view('contact.form', compact('categories'));
    }
    
    public function confirm(ContactRequest $request)
    {
        //バリデーションはあとで追加する
        $data = $request->validated();

        //電話番号を結合
        $data['tel'] = $request->input('tel1') . $request->input('tel2') . $request->input('tel3');

        // カテゴリー情報を取得
        $category = Category::find($data['category_id']);
        $data['category_content'] = $category ? $category->content : '';

        $data['building'] = $request->input('building', '');
        
        return view('contact.confirm', compact('data'));
    }

    public function submit(ContactRequest $request)
    {
        $data = $request->validated();

        // 電話番号をそのまま使用（既に結合済み）
        $data['tel'] = $request->input('tel');

        // 建物名（空の場合は空文字を設定）
        $data['building'] = $request->input('building', '');

        // データベースに保存
        \App\Models\Contact::create($data);

        return redirect()->route('contact.thanks');
    }

    public function thanks()
    {
        return view('contact.thanks');
    }
}
