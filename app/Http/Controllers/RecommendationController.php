<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recommendation;
use App\Models\Category;
use App\Models\Post;
use App\Models\Image; // for recommendation

class RecommendationController extends Controller
{
    private $recommendation;
    private $category;
    private $post;
    private $image;

    public function __construct(Recommendation $recommendation, Category $category, Post $post, Image $image)
    {
        $this->recommendation = $recommendation;
        $this->category = $category;
        $this->post = $post;
        $this->image = $image;
    }

    // show recommended posts
    // Recommendation data retrieval only (for use in other controllers)
    public function getRecommendations()
    {
        // Get the existing recommendation category
    $recommendedCategory = $this->category->whereHas('recommendations')->first();

    // Handling when categories are not found
    if (!$recommendedCategory) {
        return [
            'eventRecommendations' => collect(),
            'tourismRecommendations' => collect(),
            'recommendedCategory' => null
        ];
    }

    // Get recommendations for event posts (type = 0)
    $eventRecommendations = $this->recommendation
        ->where('category_id', $recommendedCategory->id)
        ->whereHas('post', function($query) {
            $query->where('type', 0);
        })
        ->with(['post', 'post.images']) // Eager load posts and images
        ->get();

    // Get recommendations for tourism posts (type = 1)
    $tourismRecommendations = $this->recommendation
        ->where('category_id', $recommendedCategory->id)
        ->whereHas('post', function($query) {
            $query->where('type', 1);
        })
        ->with(['post', 'post.images']) // Eager load posts and images
        ->get();

    // Return data only
    return [
        'eventRecommendations' => $eventRecommendations,
        'tourismRecommendations' => $tourismRecommendations,
        'recommendedCategory' => $recommendedCategory
    ];
    }

}
