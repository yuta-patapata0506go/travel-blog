<?php

namespace App\Http\Controllers;

use App\Models\Spot;  // Spotモデルの読み込み
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Favorite;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class SpotController extends Controller
{
    private $spot;
    private $category;
    private $image;

    public function __construct(Spot $spot, category $category, image $image) {
        $this->spot = $spot;
        $this->category = $category;
        $this->image = $image;
    
    }
    // スポット一覧を表示するメソッド
    public function index($id = null)
    {
        // 特定のスポットIDが指定されている場合、そのIDのスポットのみを取得
        if ($id) {
            $spots = Spot::where('id', $id)->get();
        } else {
        // spotsテーブルから全データを取得
        $spots = Spot::all();

        // ビューにデータを渡して表示
        return view('spot', [
            'spots' => $spots,
            'isDetail' => $id ? true : false, // 一覧表示かどうかを示すフラグ
        ]);
    }
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
<<<<<<< HEAD
            'address' => 'required|string|max:255',           
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
=======
            'address' => 'required|string|max:255',
           
            'image' => 'required|array',
>>>>>>> main
        ]);

        // Geocoding APIを使って住所から緯度と経度を取得
        $address = $request->address;
        $mapboxApiKey = env('MAPBOX_API_KEY'); // 環境変数にAPIキーを設定
<<<<<<< HEAD
        $response = Http::withOptions([ 'verify' => false, ])->get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$address}.json", [ 'access_token' => $mapboxApiKey, ]);
=======

        $response = Http::withOptions([ 'verify' => false, ])->get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$address}.json", [
            'access_token' => $mapboxApiKey,
        ]);
>>>>>>> main
        
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
        $spot = Spot::with('images','likes','favorites')->findOrFail($id); // imagesリレーションを読み込む
        $userId = auth()->id();

        // Like
        $liked = Like::where('user_id', $userId)->where('spot_id', $id)->exists();
        $likesCount = Like::where('spot_id', $id)->count();

        // Favorite
        $favorited = $spot->isFavorited; // アクセサを使用
        $favoritesCount = Favorite::where('spot_id', $id)->count();

        // スポットが見つからなかった場合のエラーハンドリング
        if (!$spot) {
            return redirect('/spot')->with('error', 'Spot not found');
        }

        // spot.blade.php に $spot 変数を渡す
        return view('spot', compact('spot', 'liked', 'likesCount','favorited', 'favoritesCount'));

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
