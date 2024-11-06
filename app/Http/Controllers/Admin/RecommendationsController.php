<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recommendation;
use App\Models\Category;
use App\Models\Post;

class RecommendationsController extends Controller
{
    private $recommendation;
    private $category;
    private $post;

    public function __construct(Recommendation $recommendation, Category $category, Post $post)
    {
        $this->recommendation = $recommendation;
        $this->category = $category;
        $this->post = $post;
    }

    // open modal
    public function showModal()
    {
        $categories = $this->category->with('children')->whereNull('parent_id')->get(); // get parent categories
        return view('admin.modals.recommended_post')->with('categories', $categories);
    }



    // select categories and save recommendations
    public function saveRecommendations(Request $request)
    {
        // Validate that a category_id is provided
        $request->validate([
            'category_id' => 'required|integer',
        ]);
    
        $category_id = $request->category_id;
    
        // Delete existing recommendations for this category
        $this->recommendation->where('category_id', $category_id)->delete();
    
        // Get event posts associated with the selected category
        $eventPosts = $this->post
            ->whereHas('categories', function ($query) use ($category_id) {
                $query->where('renew_categories.id', $category_id); // テーブル名を指定
            })
            ->where('type', 0)
            ->get();
    
        // Save event posts to recommendations
        foreach ($eventPosts as $post) {
            $this->recommendation->create([
                'category_id' => $category_id,
                'post_id' => $post->id,
            ]);
        }
    
        // Get tourism posts associated with the selected category
        $tourismPosts = $this->post
            ->whereHas('categories', function ($query) use ($category_id) {
                $query->where('renew_categories.id', $category_id); // テーブル名を指定
            })
            ->where('type', 1)
            ->get();
    
        // Save tourism posts to recommendations
        foreach ($tourismPosts as $post) {
            $this->recommendation->create([
                'category_id' => $category_id,
                'post_id' => $post->id,
            ]);
        }
    }
    
    


}