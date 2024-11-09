<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Spot;
use App\Models\SpotUserPivot;
use App\Models\Category;
use App\Models\Recommendation;
use Illuminate\Http\Request;

class SpotApplicationsController extends Controller
{
    private $user;
    private $spot;
    private $category;
    private $recommendation;

    public function __construct(User $user, Spot $spot, Category $category, Recommendation $recommendation)
    {
        $this->user = $user;
        $this->spot = $spot;
        $this->category = $category;
        $this->recommendation = $recommendation;
    }

    // Display pending spots
    public function index()
    {
        // get spots status = 0 (pending) with pagination
        $pendingSpots = $this->spot
            ->select('spots.*')
            ->join('spot_user_pivot', 'spots.id', '=', 'spot_user_pivot.spot_id')
            ->where('spot_user_pivot.status', 0)  // ピボットテーブルのstatusが0のものを条件に
            ->paginate(10);
    
        $categories = $this->category->all();
        $existingRecommendation = $this->recommendation->first();
    
        return view('admin.spot_applications.spot_applications-index')
            ->with('pendingSpots', $pendingSpots)
            ->with('categories', $categories)
            ->with('existingRecommendation', $existingRecommendation);
    }
    

//     public function index()
// {
//     $pendingSpots = $this->spot->whereHas('users', function($query) {
//         $query->wherePivot('status', 0);
//     })->paginate(10);

//     $categories = $this->category->all();
//     $existingRecommendation = $this->recommendation->first();

//     return view('admin.spot_applications.spot_applications-index')
//         ->with('pendingSpots', $pendingSpots)
//         ->with('categories', $categories)
//         ->with('existingRecommendation', $existingRecommendation);
// }




}
