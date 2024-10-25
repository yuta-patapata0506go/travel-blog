<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    //

    private $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function view(){
        $all_categories = $this->category->all();
        return view('admin.category.view')->with('all_categories',$all_categories );
    }

    

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $category = $this->category->newInstance();
        $category->title = $request->title;
        $category->user_id = Auth::id();
        $category->save();

        return redirect('/admin-categories-index')->with('success', 'カテゴリーが作成されました。');
    }

    public function create(){
        $all_categories = $this->category->all();
        return view('admin.categories.index')->with('all_categories',$all_categories);

    }

    public function edit($id) {
        
    }
    public function update($id) {

    }

}
