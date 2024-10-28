<?php

namespace App\Http\Controllers;

use App\Models\Spot;  // Spotモデルの読み込み
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Favorite;


class SpotController extends Controller
{
    private $spot;
    public function __construct(Spot $spot) {
        $this->spot = $spot;
    
    }
    // スポット一覧を表示するメソッド
    public function index()
    {
        // spotsテーブルから全データを取得
        $spots = Spot::all();

        // ビューにデータを渡して表示
        return view('spot', [
            'spots' => $spots,
            'isDetail' => false, // 一覧表示かどうかを示すフラグ
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
        // バリデーションの追加
        $request->validate([
            'name' => 'required|string|max:255',
            'postalcode' => 'required|string|max:10',
            'address' => 'required|string|max:255',
           
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:1048',
        ]);

        $this->spot->name = $request->name;
        // this code converts the image into a text;
        /*$this->spot->image       = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));*/
        $this->spot->user_id     = auth()->user()->id;
        $this->spot->postalcode  = $request->postalcode;
        $this->spot->address     = $request->address;
        /*$this->spot->latitude = $request->latitude;
        $this->spot->longitude = $request->longitude;*/

        /*// 画像をストレージに保存
        $imagePath = $request->file('image')->store('images', 'public'); // 'public'ストレージに保存
        $this->spot->image = $imagePath; // スポットに画像パスを設定*/


        $this->spot->save();

        return redirect()->route('home')->with('success', 'Pending approval by Admin.');

        

        // スポットを作成
        /*$spot = Spot::create([
            'name' => $request->input('name'),
            'postalcode' => $request->input('postalcode'),
            'address' => $request->input('address'),
            'user_id' => auth()->id(), // ユーザーIDを追加
            'latitude' => $request->input('latitude'), // 緯度を追加
            'longitude' => $request->input('longitude'), // 経度を追加
        ]);*/

        

        /*// 画像をストレージに保存
        $imagePath = $request->file('image')->store('images', 'public'); // 'public'ストレージに保存

        // 画像情報を保存
        Image::create([
            'image_url' => $imagePath,
            'spot_id' => $spot->id, // 作成したスポットに関連付け
            'user_id' => auth()->id(), // 認証されたユーザーのID
        ]);

        // 保存後、一覧ページにリダイレクト
        return redirect()->route('index')->with('success', 'スポットが追加されました。'); */
    }

    public function show($id)
    {

        // IDを使ってスポットデータを取得
        $spot = Spot::findOrFail($id);
        $userId = auth()->id();

        // いいね済みかどうかを確認
        $liked = Like::where('user_id', $userId)->where('spot_id', $id)->exists();

        // いいね数を取得
        $likesCount = Like::where('spot_id', $id)->count();

            // お気に入りの状態と数を取得
        $favorited = $spot->isFavorited; // アクセサを使用
        $favoritesCount = Favorite::where('spot_id', $id)->count();

        // デバッグ用: 取得したスポットデータを確認
        //dd($spot);  // ここで変数の内容を出力して処理を中断します

        // スポットが見つからなかった場合のエラーハンドリング
        if (!$spot) {
            return redirect('/spot')->with('error', 'Spot not found');
        }

        // spot.blade.php に $spot 変数を渡す
        return view('spot', compact('spot', 'liked', 'likesCount','favorited', 'favoritesCount'));

        /*// ビューにスポットデータを渡す
        return view('spot', [
            'spot' => $spot,
            'isDetail' => true, // 詳細表示かどうかを示すフラグ
        ]);*/
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
