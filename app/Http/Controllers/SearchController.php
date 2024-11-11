<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // ユーザーからの検索クエリを取得
        $query = $request->input('query');
        $sort = $request->input('sort'); // ソート条件を取得
        
        // 基本の検索クエリ
        $resultsQuery = Product::where('name', 'LIKE', "%{$query}%")
                                ->orWhere('description', 'LIKE', "%{$query}%");
        
        // ソート条件に基づいてクエリを調整
        switch ($sort) {
            case 'recommended':
                // 推奨ロジック（例えば、ランダム並びや特定条件）
                $resultsQuery->orderBy('recommend_score', 'desc');
                break;
            case 'newest':
                // 新しい投稿順
                $resultsQuery->orderBy('created_at', 'desc');
                break;
            case 'popular':
                // 人気順（カスタム条件に基づく）
                $resultsQuery->orderBy('popularity_score', 'desc');
                break;
            case 'many_likes':
                // いいね数が多い順
                $resultsQuery->orderBy('likes', 'desc');
                break;
            case 'many_views':
                // 閲覧数が多い順
                $resultsQuery->orderBy('views', 'desc');
                break;
        }
        
        // 検索結果を取得
        $results = $resultsQuery->get();
        
        // 検索結果をビューに渡して表示
        return view('events-tourism', compact('results', 'query', 'sort'));
    }
}
