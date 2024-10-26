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

    public function index(){
        $all_categories = $this->category->all();
        return view('admin.categories.categories-index', compact('all_categories')); 
    }

    

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $category = $this->category->newInstance();
        $category->title = $request->title;
        $category->user_id = Auth::id();
        $category->save();

        return redirect('admin-categories-index');
    }


    public function edit($id) {
        
    }
    public function update($id) {

    }

}
