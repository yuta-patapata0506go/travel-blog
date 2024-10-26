<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Spot;

class WeatherController extends Controller
{
    public function show($spot_id)
    {
        $spot = Spot::find($spot_id);

        if (!$spot) {
            return response()->json(['message' => 'Spot not found'], 404);
        }

        $apiKey = env('OPENWEATHERMAP_API_KEY');
        $url = "http://api.openweathermap.org/data/2.5/weather?lat={$spot->latitude}&lon={$spot->longitude}&appid={$apiKey}&units=metric";
        $response = Http::get($url);
        $data = $response->json();

        $spot->weather_condition = $data['weather'][0]['description'];
        $spot->temperature = $data['main']['temp'];
        $spot->humidity = $data['main']['humidity'];
        $spot->wind_speed = $data['wind']['speed'];
        $spot->precipitation = $data['rain']['1h'] ?? 0; // 降水量のデータが存在しない場合は0に設定
        $spot->uv_index = $this->getUVIndex($spot->latitude, $spot->longitude);
        $spot->save();

        return view('spot', ['spot' => $spot]);
    }

    private function getUVIndex($lat, $lon)
    {
        $apiKey = env('OPENWEATHERMAP_API_KEY');
        $url = "http://api.openweathermap.org/data/2.5/uvi?lat={$lat}&lon={$lon}&appid={$apiKey}";
        $response = Http::get($url);
        $data = $response->json();
        return $data['value'];
    }

    //位置情報取得
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:50',
            'postalcode' => 'required|max:10',
            'address' => 'required|string|max:255'
        ]);

        // Geocoding APIを使って住所から緯度と経度を取得
        $address = $request->address;
        $mapboxApiKey = env('MAPBOX_API_KEY');
        $response = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$address}.json", [
            'access_token' => $mapboxApiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $coordinates = $data['features'][0]['geometry']['coordinates'];
            $latitude = $coordinates[1];
            $longitude = $coordinates[0];
        } else {
            // エラーハンドリング
            return back()->withErrors(['error' => 'The retrieval of latitude and longitude for the address has failed.']);
        }

        // データの保存
        $spot = new Spot;
        $spot->name = $request->name;
        $spot->postalcode = $request->postalcode;
        $spot->address = $request->address;
        $spot->latitude = $latitude;
        $spot->longitude = $longitude;
        $spot->save();

        return redirect()->route('home');
    }
}
