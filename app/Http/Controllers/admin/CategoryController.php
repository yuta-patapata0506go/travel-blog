<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class CategoryController extends Controller
{
    private $category;
    private $recommendation;

    public function __construct(Category $category, Recommendation $recommendation) {
        $this->category = $category;
        $this->recommendation = $recommendation;
    }

    public function index(){
        $all_categories = $this->category->with('children')->whereNull('parent_id')->paginate(1);

        $categories = $this->category->all();

        $parentCategories = Category::whereNull('parent_id')->get(); 

        $existingRecommendation = $this->recommendation->first();

        return view('admin.categories.categories-index')
            ->with('categories', $categories)
            ->with('all_categories', $all_categories)
            ->with('parentCategories', $parentCategories)
            ->with('existingRecommendation', $existingRecommendation);
    }

    public function store(Request $request) {
     
            
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
           
            $category = $this->category->newInstance();
            $category->name = $request->name;
            $category->parent_id = $request->parent_id ?: null;
            $category->created_at = Carbon::now();
            $category->updated_at = Carbon::now();
            
            $category->save();
            
            return redirect('admin-categories-index');
        
    }

    public function update(Request $request, $id) {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);
       
        $category = $this->category->findOrFail($id);
        $category->name = $request->name;
        $category->updated_at = Carbon::now();
        $category->save();
    
    return redirect()->route('admin.categories.index') ;  //use this if you have a named route
    }

    public function changeVisibility($id)
    {
        $category = Category::findOrFail($id);
        $category->status = $category->status === 0 ? 1 : 0;  // 0: Visible, 1: Hidden
        $category->save();
    
        return redirect()->route('admin.categories.index')->with('status', 'Visibility changed!');
    }

  
    

}
