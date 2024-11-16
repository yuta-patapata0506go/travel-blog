<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spot; // 必要に応じてモデルを変更してください

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query'); // 検索キーワードを取得
        $userLatitude = $request->input('latitude'); // ユーザーの緯度
        $userLongitude = $request->input('longitude'); // ユーザーの経度

        // getSpotsメソッドを呼び出し、検索条件を処理
        $spots = $this->getSpots($userLatitude, $userLongitude, $query);

        // 検索結果とキーワードをビューに渡す
        // return view('display.events-tourism', [
        //     'results' => $results,
        //     'query' => $query,
        // ]);
        return view('display.events-tourism', compact('spots','query'));
    }

    private function getSpots($userLatitude, $userLongitude, $keyword)
    {
        $query = Spot::with(['posts', 'images']); // 必要なリレーションをロード

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
