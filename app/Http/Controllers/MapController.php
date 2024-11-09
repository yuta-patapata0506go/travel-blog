<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spot;

class MapController extends Controller
{
    private $spot;

    public function __construct(Spot $spot){
        $this->spot = $spot;
    }

    public function index(Request $request){
        
        // ユーザーの現在地を取得するためのデフォルト値を設定 //Set default values to obtain the user's current location
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');

        // 近くの6つのスポットを取得（Haversine formulaを利用）//Retrieve the 6 nearest spots using the Haversine formula
        $spots = $this->spot
            ->selectRaw(
                '*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                [$userLatitude, $userLongitude, $userLatitude]
            )
            ->orderBy('distance')
            ->limit(6)
            ->get();

            return response()->json(['spots' => $spots]);
    }


    public function showMapPage(Request $request)
    {
        // ユーザーの現在地を取得するためのデフォルト値を設定 //Set default values to obtain the user's current location
        $userLatitude = $request->input('latitude', null);
        $userLongitude = $request->input('longitude', null);


        // 検索キーワードの取得
        $keyword = $request->input('keyword', null);

        // クエリビルダを使用して検索条件を設定
        $query = $this->spot->with(['posts', 'images']);


        // 近くのスポットを取得する
        $spots = [];

        if ($userLatitude && $userLongitude) {
            $spots = $this->spot
                ->with(['posts', 'images'])
                ->where(function($query) use ($keyword) {
                    if (!empty($keyword)) {
                        $query->where('name', 'LIKE', "%{$keyword}%")
                              ->orWhereHas('posts', function($q) use ($keyword) {
                                  $q->where('title', 'LIKE', "%{$keyword}%")
                                    ->orWhere('comments', 'LIKE', "%{$keyword}%");
                              });
                    }
                })
                ->selectRaw(
                    '*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                    [$userLatitude, $userLongitude, $userLatitude]
                )
                ->orderBy('distance')
                ->limit(6)
                ->get();
        }
    
        return view('map_page.map', compact('spots')); // 検索条件を追加
        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhereHas('posts', function($postQuery) use ($keyword) {
                      $postQuery->where('title', 'LIKE', "%{$keyword}%")
                                ->orWhere('comments', 'LIKE', "%{$keyword}%");
                  });
            });
        }
    
        // 近くのスポットを取得
        $spots = [];
        if ($userLatitude && $userLongitude) {
            $spots = $query->selectRaw(
                    '*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                    [$userLatitude, $userLongitude, $userLatitude]
                )
                ->orderBy('distance')
                ->limit(6)
                ->get();
        } else {
            // 現在地がない場合、全件検索
            $spots = $query->limit(6)->get();
        }
    
        return view('map_page.map', compact('spots'));

       
        /*
        // 近くのスポットを取得する
        $spots = [];

        if ($userLatitude && $userLongitude) {
            // 近くの6つのスポットを取得（Haversine formulaを利用）//Retrieve the 6 nearest spots using the Haversine formula
            $spots = $this->spot
                ->with(['posts', 'images']) //各スポットに紐づくポストも取得(Retrieve posts associated with each spot)
                ->selectRaw(
                    '*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                    [$userLatitude, $userLongitude, $userLatitude]
                )
                ->orderBy('distance')
                ->limit(6)
                ->get();
        }

        return view('map_page.map', compact('spots'));  */

    } 
}
