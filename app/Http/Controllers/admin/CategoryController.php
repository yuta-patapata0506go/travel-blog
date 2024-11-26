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

    public function index(Request $request)
    {
        // Initial query setup (targeting only parent categories)
        $query = $this->category->with('children')->whereNull('parent_id')->orderBy('created_at', 'desc');
    
        // Search process: Search parent categories by 'name'
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        // Retrieve parent category data and set pagination
        $all_categories = $query->paginate(1)->withQueryString(); // 親カテゴリのみを対象にページネーション
    
        // Paginate only parent categories
        $all_categories->getCollection()->transform(function ($parentCategory) {
            // Retrieve child categories for each parent category
            $parentCategory->children = $parentCategory->children()->orderBy('name')->get();
            return $parentCategory;
        });
    
        // Get all category information (both parent and child categories)
        $categories = $this->category->all();
    
        // Retrieve parent categories again
        $parentCategories = Category::whereNull('parent_id')->get();
    
        // Fetch additional data
        $existingRecommendation = $this->recommendation->first();
    
        // Pass data to the view
        return view('admin.categories.categories-index', [
            'categories' => $categories,
            'all_categories' => $all_categories,
            'parentCategories' => $parentCategories,
            'existingRecommendation' => $existingRecommendation,
            'search' => $request->search, // Pass the search query to the view
        ]);
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
            
            return redirect()->route('admin.categories.index');
        
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
