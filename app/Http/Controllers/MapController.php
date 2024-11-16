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

    // 新規メソッドの追加
    public function saveLocation(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        if ($latitude && $longitude) {
            session(['latitude' => $latitude, 'longitude' => $longitude]);
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'failed'], 400);
    }

    /**
     * 検索条件に当てはまる（ある場合は）かつ、現在地から近いスポット6つを取得するためのメソッド
     * Method to retrieve up to 6 spots that match the search criteria (if any) and are closest to the current location.
     */
    private function getSpots($userLatitude, $userLongitude, $keyword)
    {
        // クエリビルダを使用して検索条件を設定
        $query = $this->spot->with(['posts', 'images']);

        // 検索条件を追加
        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%") //'name' in spots table
                  ->orwhere('address', 'LIKE', "%{$keyword}%") //'address' in spots table
                ->orWhereHas('posts', function($postQuery) use ($keyword) {
                    $postQuery->where('title', 'LIKE', "%{$keyword}%") //'title' in posts table
                                ->orWhere('comments', 'LIKE', "%{$keyword}%") // 'comments' in posts table
                                ->orWhere('event_name', 'LIKE', "%{$keyword}%"); //'event_name' in posts table
                  });
            });
        }

        // 近くの6つのスポットを取得
        if ($userLatitude && $userLongitude) {
            return $query->selectRaw(
                    '*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                    [$userLatitude, $userLongitude, $userLatitude]
                )
                ->orderBy('distance')
                ->limit(6)
                ->get();
        } else {
            // 現在地がない場合、全件検索
            return $query->limit(6)->get();
        }
    }


    /**
     * スポット情報をJSONとして返却するメソッド
     * Method to return spot information as JSON
     */
    public function index(Request $request){
        
        // ユーザーの現在地を取得するためのデフォルト値を設定 //Set default values to obtain the user's current location
        // $userLatitude = $request->input('latitude');
        // $userLongitude = $request->input('longitude');

          // セッションからユーザーの現在地を取得
        $userLatitude = session('latitude');
        $userLongitude = session('longitude');


        // 検索キーワードの取得
        $keyword = $request->input('keyword', null);

        // getSpots() を呼び出してスポット情報を取得
        $spots = $this->getSpots($userLatitude, $userLongitude, $keyword);

        // スポット情報をJSONとして返却
        return response()->json(['spots' => $spots]);
    }


    /**
     * スポット情報をビューに渡して表示するメソッド
     * Method to pass spot information to the view for display
     */
    public function showMapPage(Request $request)
    {
        // ユーザーの現在地を取得
        $userLatitude = $request->input('latitude', null);
        $userLongitude = $request->input('longitude', null);

        // 検索キーワードの取得
        $keyword = $request->input('keyword', null);

        // getSpots() を呼び出してスポット情報を取得
        $spots = $this->getSpots($userLatitude, $userLongitude, $keyword);

        // 各スポットの画像URLを生成
        foreach ($spots as $spot) {
            if ($spot->images->isNotEmpty()) {
                // 最初の画像のURLを生成
                $spot->image_url = asset('storage/' . $spot->images->first()->image_url);
            } else {
                // デフォルト画像のURLを設定
                $spot->image_url = asset('images/map_samples/spot_pc_sample.png');
            }
        }

        // スポット情報をビューに渡して表示
        return view('map_page.map', compact('spots', 'keyword')); //->bladeファイル内でspotを表示
                                                       //->$spotsからposts()を呼び出しpostを表示

    }
}
