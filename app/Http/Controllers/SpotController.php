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
use League\CommonMark\Util\LinkParserHelper;
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
    public function index($id, Request $request)
    {
        // 指定されたIDのスポットを取得（1つのみ）
        $spot = Spot::findOrFail($id);

        // リクエストからソート条件を取得し、デフォルトは 'newest'
        $sort = $request->input('sort', 'newest');

        // ソート条件に応じてポストを取得
        $postsQuery = Post::where('spot_id', $id);

        switch ($sort) {
            case 'newest':
                $postsQuery->orderBy('created_at', 'desc');
                break;
            case 'popular':
                $postsQuery->orderBy('views', 'desc');
                break;
            case 'many_likes':
                $postsQuery->orderBy('likes_count', 'desc'); // likes_count カラムがある場合
                break;
            default:
                $postsQuery->orderBy('created_at', 'desc');
                break;
        }

        // ソート済みのポストを取得
        $posts = $postsQuery->get();


        
        // 指定されたスポットIDに関連する全てのポストを取得
        $posts = Post::where('spot_id', $id)->get();
        // スポットとポストをビューに渡して表示
        return view('spot', [
            'spot' => $spot,
            'posts' => $posts,
            'sort' => $sort, // 現在のソート条件をビューに渡す
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
        //dd($request);
        try{
        // バリデーションの追加
        $request->validate([
            'name' => 'required|string|max:255',
            'postalcode' => 'required|string|max:10',
            'address' => 'required|string|max:255',           
            'image' => 'required|array',
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
            print_r($e->getMessage());
        }
    }
    
    public function show($id, Request $request)
    {
        // IDを使ってスポットデータを取得
        $spot = Spot::with('images','likes','favorites', 'comments.replies','posts')->findOrFail($id);// imagesリレーションを読み込む
        
        $userId = auth()->id();
        // Like
        $liked = Like::where('user_id', $userId)->where('spot_id', $id)->exists();
        $likesCount = Like::where('spot_id', $id)->count();
        
        // Favorite
        $favorited = $spot->isFavorited;
        $favoritesCount = Favorite::where('spot_id', $id)->count();
        
        // Comment
        $comments = Comment::where('spot_id', $id)
        ->whereNull('parent_id')
        ->with(['user', 'replies.user']) // user と replies.user を明示的にロード
        ->get();
        $commentCount = $spot->comments()->count();

        $spot->increment('views');

        // spot_id に一致する post 情報を取得
        $posts = Post::where('spots_id', $spot->id)->get();
        
        //天気機能
        $apiKey = env('OPENWEATHERMAP_API_KEY');
        $url = "http://api.openweathermap.org/data/2.5/weather?lat={$spot->latitude}&lon={$spot->longitude}&appid={$apiKey}&units=metric";
        $response = Http::get($url);
        $data = $response->json();

        // 必要なキーが存在するか確認し、存在しない場合はデフォルト値を設定
        if (isset($data['weather'][0]['description'], $data['main']['temp'], $data['main']['humidity'], $data['wind']['speed'])) {
            $spot->weather_condition = $data['weather'][0]['description'];
            $spot->temperature = $data['main']['temp'];
            $spot->humidity = $data['main']['humidity'];
            $spot->wind_speed = $data['wind']['speed'];
            $spot->precipitation = $data['rain']['1h'] ?? 0; // 降水量のデータが存在しない場合は0に設定
            $spot->uv_index = $this->getUVIndex($spot->latitude, $spot->longitude);  
            $spot->weather_icon = $data['weather'][0]['icon']; // 追加
        } else {
        // エラーの場合のデフォルト値を設定
            $spot->weather_condition = 'N/A';
            $spot->temperature = null; // 数値型のカラムにはnullを設定
            $spot->humidity = null; // 数値型のカラムにはnullを設定
            $spot->wind_speed = null; // 数値型のカラムにはnullを設定
            $spot->precipitation = 0; // 数値なので0を設定
            $spot->weather_icon = 'N/A';
        }
        // UVインデックスの取得もエラー処理を追加
        try {
            $spot->uv_index = $this->getUVIndex($spot->latitude, $spot->longitude);
        } catch (\Exception $e) {
            $spot->uv_index = 0; // UVインデックスが取得できなかった場合のデフォルト値
        }

        $spot->save();

        // // リクエストからソートオプションを取得
        
        $sort = $request->get('sort', 'newest'); // デフォルトは最新順
        
         // スポットに関連する投稿を取得してソート
        $posts = Post::where('spots_id', $spot->id)
             ->when($sort === 'newest', function ($query) {
                 $query->orderBy('created_at', 'desc'); // 新しい順
             })
             ->when($sort === 'popular', function ($query) {
                 $query->orderBy('favorites_count', 'desc'); // 人気順（表示回数順）
             })
             ->when($sort === 'many_likes', function ($query) {
                 $query->orderByDesc('likes_count'); // いいね数順
            })
             ->when($sort === 'many_views', function ($query) {
                 $query->orderByDesc('views'); // おきにいり数順
             })
             ->paginate(4); // 1ページに4件の投稿を表示
        
        // スポットが見つからなかった場合のエラーハンドリング
        if (!$spot) {
            return redirect('/spot')->with('error', 'Spot not found');
        }

        

        // spot.blade.php に $spot 変数を渡す
        return view('spot', compact('spot', 'liked', 'likesCount','favorited', 'favoritesCount', 'comments','posts','sort'));

    }

    
    private function getUVIndex($lat, $lon)
    {
        $apiKey = env('OPENWEATHERMAP_API_KEY');
        $url = "http://api.openweathermap.org/data/2.5/uvi?lat={$lat}&lon={$lon}&appid={$apiKey}";
        $response = Http::get($url);
        $data = $response->json();
        // "value" キーが存在するか確認し、存在しない場合はデフォルト値（例：0）を返す
        return $data['value'] ?? 0;
    }
    public function like($id, $type)
    {
        $userId = auth()->id();
        if ($type === 'spot') {
            // スポットへの「いいね」を処理
            $existingLike = Like::where('user_id', $userId)
                                ->where('spot_id', $id)
                                ->whereNull('post_id')
                                ->first();
    
            if ($existingLike) {
                $existingLike->delete();
            } else {
                Like::create([
                    'user_id' => $userId,
                    'spot_id' => $id,
                    'post_id' => null,
                ]);
            }
        } elseif ($type === 'post') {
            // 投稿への「いいね」を処理
            $existingLike = Like::where('user_id', $userId)
                                ->where('post_id', $id)
                                ->whereNull('spot_id')
                                ->first();
    
            if ($existingLike) {
                $existingLike->delete();
            } else {
                Like::create([
                    'user_id' => $userId,
                    'spot_id' => null,
                    'post_id' => $id,
                ]);
            }
        }
    
        return redirect()->back();
    }
    public function favorite($id, $type)
    {
        $userId = auth()->id();
        if ($type === 'spot') {
            // スポットのお気に入りを処理
            $existingFavorite = Favorite::where('user_id', $userId)
                                        ->where('spot_id', $id)
                                        ->whereNull('post_id')
                                        ->first();
    
            if ($existingFavorite) {
                $existingFavorite->delete();
            } else {
                Favorite::create([
                    'user_id' => $userId,
                    'spot_id' => $id,
                    'post_id' => null,
                ]);
            }
        } elseif ($type === 'post') {
            // 投稿のお気に入りを処理
            $existingFavorite = Favorite::where('user_id', $userId)
                                        ->where('post_id', $id)
                                        ->whereNull('spot_id')
                                        ->first();
    
            if ($existingFavorite) {
                $existingFavorite->delete();
            } else {
                Favorite::create([
                    'user_id' => $userId,
                    'spot_id' => null,
                    'post_id' => $id,
                ]);
            }
        }
    
        return redirect()->back();
            }
        }
