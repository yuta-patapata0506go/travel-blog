<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recommendation;
use App\Models\Category;
use App\Models\Post;

class RecommendationController extends Controller
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

    // show recommended posts
    public function showRecommendations()
    {
        // Get the specified categories used for recommendations
        $recommendedCategory = $this->category->whereHas('recommendations')->first();

        // Handling when categories are not found
        if (!$recommendedCategory) {
            return view('your.view.name', [
                'eventRecommendations' => collect(),
                'tourismRecommendations' => collect(),
                'recommendedCategory' => null
            ]);
        }

        // Get recommendations for event type (0)
        $eventRecommendations = $this->recommendation->where('category_id', $recommendedCategory->id)
                                                    ->whereHas('post', function($query) {
                                                        $query->where('type', 0);
                                                    })
                                                    ->with('post')
                                                    ->get();

        // Get recommendations for tourism type (1)
        $tourismRecommendations = $this->recommendation->where('category_id', $recommendedCategory->id)
                                                    ->whereHas('post', function($query) {
                                                        $query->where('type', 1);
                                                    })
                                                    ->with('post')
                                                    ->get();

        // Pass data to the view
        return view('your.view.name', compact('eventRecommendations', 'tourismRecommendations', 'recommendedCategory'));
    }
}
