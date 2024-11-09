<?php

namespace App\Http\Controllers;

use App\Models\Spot;  // Spotモデルの読み込み
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Favorite;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class SpotController extends Controller
{
    private $spot;
    private $category;
    private $image;
    private $post;

    public function __construct(Spot $spot, category $category, image $image, Post $post) {
        $this->spot = $spot;
        $this->category = $category;
        $this->image = $image;
        $this->post = $post;
    
    }
    // スポット一覧を表示するメソッド
    public function index($id)
    {
        // 指定されたIDのスポットを取得（1つのみ）
        $spot = Spot::findOrFail($id);

        // 指定されたスポットIDに関連する全てのポストを取得
        $posts = Post::where('spot_id', $id)->get();

        // スポットとポストをビューに渡して表示
        return view('spot', [
            'spot' => $spot,
            'posts' => $posts,
        ]);
    }

    
    // 新しいスポットを登録するフォームの表示
    public function create()
    {
        return view('spot-post-form');
    }

    // 新しいスポットを保存する処理
    public function store(Request $request)
    {
        try{
        // バリデーションの追加
        $request->validate([
            'name' => 'required|string|max:255',
            'postalcode' => 'required|string|max:10',
            'address' => 'required|string|max:255',           
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);

        // Geocoding APIを使って住所から緯度と経度を取得
        $address = $request->address;
        $mapboxApiKey = env('MAPBOX_API_KEY'); // 環境変数にAPIキーを設定


        $response = Http::withOptions([ 'verify' => false, ])->get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$address}.json", [
            'access_token' => $mapboxApiKey,
        ]);

        
        if ($response->successful()) {
            $data = $response->json();
            $coordinates = $data['features'][0]['geometry']['coordinates'];
            $latitude = $coordinates[1];
            $longitude = $coordinates[0];
        } else { 
            return back()->withErrors(['error' => 'The retrieval of latitude and longitude for the address has failed.']);
        }        

        $this->spot->name = $request->name;
        // this code converts the image into a text;
        /*$this->spot->image       = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));*/
        $this->spot->user_id     = auth()->user()->id;
        $this->spot->postalcode  = $request->postalcode;
        $this->spot->address     = $request->address;
        $this->spot->latitude = $latitude;
        $this->spot->longitude = $longitude;

        $this->spot->save();
        // / 画像の保存（ImageControllerで処理を行う）
        app(ImageController::class)->store($request, null, spotId: $this->spot->id);

        return redirect()->route('home')->with('success', 'Pending approval by Admin.');

        } catch (\Exception $e) { 
            Log::error('Failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed']);
        }
    }

    
    public function show($id)
    {

        // IDを使ってスポットデータを取得
        $spot = Spot::with('images','likes','favorites', 'comments.replies')->findOrFail($id); // imagesリレーションを読み込む
        $userId = auth()->id();

        // Like
        $liked = Like::where('user_id', $userId)->where('spot_id', $id)->exists();
        $likesCount = Like::where('spot_id', $id)->count();

        // Favorite
        $favorited = $spot->isFavorited; // アクセサを使用
        $favoritesCount = Favorite::where('spot_id', $id)->count();

        // Comment
        // ポストに関連するコメント（親コメントとリプライ）を取得
        $comments = Comment::where('spot_id', $id)
        ->whereNull('parent_id')
        ->with(['user', 'replies.user']) // user と replies.user を明示的にロード
        ->get();

        $commentCount = $spot->comments()->count();

        //天気機能
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
        $spot->weather_icon = $data['weather'][0]['icon']; // 追加      
        $spot->save();        

        // スポットが見つからなかった場合のエラーハンドリング
        if (!$spot) {
            return redirect('/spot')->with('error', 'Spot not found');
        }

        // spot.blade.php に $spot 変数を渡す
        return view('spot', compact('spot', 'liked', 'likesCount','favorited', 'favoritesCount', 'comments'));

    }

    private function getUVIndex($lat, $lon)
    {
        $apiKey = env('OPENWEATHERMAP_API_KEY');
        $url = "http://api.openweathermap.org/data/2.5/uvi?lat={$lat}&lon={$lon}&appid={$apiKey}";
        $response = Http::get($url);
        $data = $response->json();
        return $data['value'];
    }

    public function like($id)
    {
        $userId = auth()->id();
        $existingLike = Like::where('user_id', $userId)->where('spot_id', $id)->first();

        if ($existingLike) {
            // すでに「いいね」している場合は削除して、いいねを取り消し
            $existingLike->delete();
        } else {
            // 新しく「いいね」を追加
            Like::create([
                'user_id' => $userId,
                'spot_id' => $id
            ]);
        }

        // リダイレクトしてページを再読み込み
        return redirect()->back();
    }

    public function favorite($id)
    {
        $userId = auth()->id();
        $existingFavorite = Favorite::where('user_id', $userId)->where('spot_id', $id)->first();

        if ($existingFavorite) {
            // すでに「いいね」している場合は削除して、いいねを取り消し
            $existingFavorite->delete();
        } else {
            // 新しく「いいね」を追加
            Favorite::create([
                'user_id' => $userId,
                'spot_id' => $id
            ]);
        }

        // リダイレクトしてページを再読み込み
        return redirect()->back();
    }

    
}
