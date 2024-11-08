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
        $existingRecommendation = $this->recommendation->first();
        return view('admin.modals.recommended_post')
            ->with('categories', $categories)
            ->with('existingRecommendation', $existingRecommendation);
    }



    // select categories and save recommendations
    public function saveRecommendations(Request $request)
    {
        // Validate input
        $request->validate([
            'category_id' => 'required|integer',
        ]);

        $category_id = $request->category_id;

        // Delete existing recommendation data
        $this->recommendation->query()->delete();  // Delete all recommendation data

        // Save event and tourism posts related to the selected category
        $this->saveEventAndTourismPosts($category_id);

        return back()->with('success', 'Recommendation saved successfully!')->with('category_id', $category_id);
    }

    private function saveEventAndTourismPosts($category_id)
    {
        // Event posts
        $eventPosts = $this->post->whereHas('categories', function ($query) use ($category_id) {
            $query->where('renew_categories.id', $category_id);
        })->where('type', 0)->get();

        foreach ($eventPosts as $post) {
            $this->recommendation->create([
                'category_id' => $category_id,
                'post_id' => $post->id,
            ]);
        }

        // Tourism posts
        $tourismPosts = $this->post->whereHas('categories', function ($query) use ($category_id) {
            $query->where('renew_categories.id', $category_id);
        })->where('type', 1)->get();

        foreach ($tourismPosts as $post) {
            $this->recommendation->create([
                'category_id' => $category_id,
                'post_id' => $post->id,
            ]);
        }
    }




}