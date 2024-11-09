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
            case 'name_asc':
                $resultsQuery->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $resultsQuery->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $resultsQuery->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $resultsQuery->orderBy('price', 'desc');
                break;
            default:
                // ソート条件がない場合はデフォルトの並び順
                break;
        }
        
        // 検索結果を取得
        $results = $resultsQuery->get();
        
        // 検索結果をビューに渡して表示
        return view('events-tourism', compact('results', 'query', 'sort'));
    }
}
