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

        return view('map_page.map', compact('spots'));
    }
}
