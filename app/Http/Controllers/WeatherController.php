<?php

// app/Http/Controllers/WeatherController.php

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

        $apiKey = env('7c431d4846c86a615608f1e1cae38cf4');
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
        $apiKey = env('7c431d4846c86a615608f1e1cae38cf4');
        $url = "http://api.openweathermap.org/data/2.5/uvi?lat={$lat}&lon={$lon}&appid={$apiKey}";
        $response = Http::get($url);
        $data = $response->json();
        return $data['value'];
    }
}

