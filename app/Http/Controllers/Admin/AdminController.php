<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Category;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        //検索機能
    if ($request->filled('search')){
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
    
        }

    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('date')) {
        $query->where('created_at',
        $request->date);
}

$contacts = $query->orderBy('created_at' , 'desc')->paginate(10);
        $categories = Category::all();

        return view('admin.index', compact('contacts'));
    }

public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => '削除しました']);
    }
}
