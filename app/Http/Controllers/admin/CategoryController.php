<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    //

    private $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function index(){
        $all_categories = $this->category->paginate(10);
        return view('admin.categories.categories-index', compact('all_categories')); 
    }

    

    public function store(Request $request) {
        try {
            
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
    
            
            $category = $this->category->newInstance();
            $category->name = $request->name;
            $category->created_at = Carbon::now();
            $category->updated_at = Carbon::now();
            $category->user_id = Auth::id();
            $category->save();
    
          
            return redirect('admin-categories-index');
    
        } catch (\Exception $e) {
            
            Log::error('Failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed']);
        }
    }

    public function update(Request $request, $id) {
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
