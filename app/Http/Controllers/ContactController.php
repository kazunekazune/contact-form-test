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
        return view('contact.confirm', compact('data'));
    }

    public function submit(ContactRequest $request)
    {
        $data = $request->validated();
        $data['tel'] = $request->input('tel1') . $request->input('tel2') . $request->input('tel3');
        unset($data['tel1'], $data['tel2'], $data['tel3']);
        Contact::create($data);
        return redirect()->route('contact.thanks');
    }
    
    public function thanks()
    {
        return view('contact.thanks');
    }
}
