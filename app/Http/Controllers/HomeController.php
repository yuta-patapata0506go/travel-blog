<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RecommendationController; 
use App\Http\Controllers\PostController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
        public function index(RecommendationController $recommendationController)
{
    // 共通データ（おすすめ情報を含む）を取得
    $commonData = PostController::getCommonData($recommendationController);

    // おすすめデータをホームページビューに渡す
    return view('home', [
        'eventRecommendations' => $commonData['recommendations']['eventRecommendations'],
        'tourismRecommendations' => $commonData['recommendations']['tourismRecommendations'],
        'recommendedCategory' => $commonData['recommendations']['recommendedCategory'],
    ]);
}
    
}
