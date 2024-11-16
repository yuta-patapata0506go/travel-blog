<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spot; // 必要に応じてモデルを変更してください
use App\Models\Post; // 必要に応じてモデルを変更してください 
use App\Http\Controllers\PostController;
use App\Http\Controllers\RecommendationController; 

class SearchController extends Controller
{

    
    public function search(Request $request,RecommendationController $recommendationController)
    {
        $query = $request->input('query'); // 検索キーワードを取得
        $userLatitude = $request->input('latitude'); // ユーザーの緯度
        $userLongitude = $request->input('longitude'); // ユーザーの経度

        // getSpotsメソッドを呼び出し、検索条件を処理
        $spots = $this->getSpots($userLatitude, $userLongitude, $query);

        // PostControllerのgetCommonDataメソッドを呼び出し
          //getCommonDataはおすすめの投稿を表示する
        $commonData = PostController::getCommonData($recommendationController);

        $parentCategories = $commonData['parentCategories'];
        $recommendations = $commonData['recommendations'];
        
        //sort
        $spotsQuery = Spot::query();
        $query = $request->input('query');
        $sort = $request->input('sort', 'newest');
        $sortedQuery = PostController::applySort($spotsQuery, $sort);

        $results = $sortedQuery->get();

        //条件の投稿を検索する
        $postsQuery = Post::with('images')
        ->withCount(['likes', 'favorites'])
        ->where(function($q) use ($query) {
            $q->where('event_name', 'LIKE', "%{$query}%")
              ->orWhere('comments', 'LIKE', "%{$query}%");
        });

        $posts = PostController::applySort($postsQuery, $sort)->get();
        

        // 検索結果とキーワードをビューに渡す
        // return view('display.events-tourism', [
        //     'results' => $results,
        //     'query' => $query,
        // ]);
        return view('display.events-tourism', compact('results','spots','posts','query', 'parentCategories','sort', 'recommendations'))
        ->with('eventRecommendations', $commonData['recommendations']['eventRecommendations'])
        ->with('tourismRecommendations', $recommendations['tourismRecommendations'])
              ->with('recommendedCategory', $commonData['recommendations']['recommendedCategory']);
    }

   private function getSpots($userLatitude, $userLongitude, $keyword)
{
    // Spotと関連するPostのlikesRelationとfavoritesのカウントも取得
    $query = Spot::with(['posts' => function ($postQuery) use ($keyword) {
        $postQuery->with('images')
                  ->withCount(['likes', 'favorites']); // likesとfavoritesのカウントを追加

        // Postの検索条件を追加
        if (!empty($keyword)) {
            $postQuery->where(function($q) use ($keyword) {
                $q->where('title', 'LIKE', "%{$keyword}%") // 'title' in posts table
                  ->orWhere('comments', 'LIKE', "%{$keyword}%")
                  ->orWhere('event_name', 'LIKE', "%{$keyword}%"); // 'comments' and 'event_name' in posts table
            });
        }
    }, 'images']); // 必要なリレーションをロード

    // Spotのnameやaddressに対しても検索条件を追加
    if (!empty($keyword)) {
        $query->where(function ($q) use ($keyword) {
            $q->where('name', 'LIKE', "%{$keyword}%")
              ->orWhere('address', 'LIKE', "%{$keyword}%")
              ->orWhereHas('posts', function ($postQuery) use ($keyword) {
                  $postQuery->where('title', 'LIKE', "%{$keyword}%")
                            ->orWhere('comments', 'LIKE', "%{$keyword}%")
                            ->orWhere('event_name', 'LIKE', "%{$keyword}%");
              });
        });
    }

    return $query->get();
}
}