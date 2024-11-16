<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Spot;
use App\Models\Category; 
use App\Models\Image;   
use App\Models\Comment;
use App\Models\Like;
use App\Models\Favorite;
use App\Models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; 
use App\Http\Controllers\RecommendationController; 
use Illuminate\Support\Facades\Schema;


class PostController extends Controller
{
    
    private $post;
    private $category;
    private $image;
    private $spot;
    public function __construct(Post $post, Category $category, Image $image, Spot $spot)

    {
        
        $this->post = $post;
        $this->category = $category;
        $this->image = $image;
        $this->spot = $spot;
    }


     // 新規投稿フォームの表示
     public function create($type)
{
    // Categoryモデルから全てのカテゴリを取
    $all_categories = Category::where('status', 1)->get();  // インスタンスではなく、直接モデルを呼び出す

    $spots = Spot::all(); // 全てのスポットデータを取得

    // $typeと$all_categoriesをビューに渡す
    return view('posts.create', compact('type', 'all_categories', 'spots'));
}

     
public function show($id)
{
    $post = $this->post->with(['images', 'categories', 'spot', 'comments.user',  'comments.replies.user', 'comments','likes'])->findOrFail($id);

    if (Schema::hasColumn('posts', 'views')) {
        $post->increment('views');
    }
  
    $userId = auth()->id();

    // Spot ID のデバッグログを記録
    \Log::info("Spot ID for post ID {$post->id}: " . $post->spot_id);

    // 最初の画像を取得
    $firstImage = $post->images->first();

    if (!$post->spot) {
        \Log::warning("Spot not found for post ID: {$post->id}, spot ID: {$post->spot_id}");
        $spotName = 'Location not available';
    } else {
        $spotName = $post->spot->name;
    }

      // ポストに関連するコメント（親コメントとリプライ）を取得
      $comments = Comment::where('post_id', $id)
      ->whereNull('parent_id')
      ->with(['user', 'replies.user']) // user と replies.user を明示的にロード
      ->get();

      $commentCount = $post->comments()->count();

       // Like
       $liked = Like::where('user_id', $userId)->where('post_id', $id)->exists();
       $likesCount = Like::where('post_id', $id)->count();

       // Favorite
       $favorited = $post->isFavorited; // アクセサを使用
       $favoritesCount = Favorite::where('post_id', $id)->count();

   

    return view('posts.show', compact('post', 'firstImage','spotName',  'comments',  'commentCount' ,'liked', 'likesCount','favorited', 'favoritesCount'));
}


   

    // 新規投稿の保存
    public function store(Request $request)
    {
       // バリデーションルールを定義
        $rules = [
            'title' => 'string|max:50',
            'type' => 'integer|in:0,1',
            'event_name' => 'nullable|string|max:30',
            'adult_fee' => 'nullable|numeric|min:0',
            'adult_currency' => 'nullable|string|in:JPY,USD,EUR,GBP,AUD,CAD,CHF,CNY,KRW,INR,Free',
            'child_fee' => 'nullable|numeric|min:0',
            'child_currency' => 'nullable|string|in:JPY,USD,EUR,GBP,AUD,CAD,CHF,CNY,KRW,INR,Free',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'comments' => 'nullable|string|max:255',
            'category' => 'required|array', // 配列であることを指定
            'helpful_info' => 'nullable|string',
            'image' => 'required|array', // 画像が必須
        ];

        // `type` が `0` の場合のみ `start_date` を必須にする
        if ($request->type == 0) {
            $rules['start_date'] = 'required|date';
            $rules['end_date'] = 'required|date';
        }

        // バリデーションを実行
        $request->validate($rules);
   
        $this->post->user_id = auth()->id(); // 現在のユーザーIDをセット
        $this->post->spots_id = $request->spot; // スポットID
        $this->post->title = $request->title??'';
        $this->post->type = $request->type;
        $this->post->event_name = $request->input('event_name');
            
        // Adult Fee and Child Fee
        $this->post->adult_fee = $request->adult_fee;
        $this->post->adult_currency = $request->adult_currency;
        $this->post->child_fee = $request->child_fee;
        $this->post->child_currency = $request->child_currency;
         // start_dateとend_dateの保存
        $this->post->start_date = $request->start_date ?: null; // 空ならNULLを設定
        $this->post->end_date = $request->end_date ?: null; // 空ならNULLを設定
        $this->post->comments = $request->comments;
        $this->post->helpful_info = $request->helpful_info;

        // 投稿を保存
        $this->post->save();

        $categoryIds = is_array($request->category) ? $request->category : explode(',', $request->category);
        $category_post = [];
        foreach ($request->category as $category_id) {
            $category_post[] = [
                "category_id" => trim($category_id),
                "post_id" => $this->post->id,
                "status" => 'new'
            ];
        }
        // dd($category_post);
        $this->post->categoryPosts()->createMany($category_post);
        $this->post->categoryPosts()->createMany($category_post);

        // / 画像の保存（ImageControllerで処理を行う）
        app(ImageController::class)->store($request, $this->post->id,null);

        return redirect()->route('post.show', ['id' => $this->post->id])
        ->with('success', 'Post created successfully.');
    
    }

    public function like($id)
    {
        $userId = auth()->id();
        $existingLike = Like::where('user_id', $userId)->where('post_id', $id)->first();

        if ($existingLike) {
            // すでに「いいね」している場合は削除して、いいねを取り消し
            $existingLike->delete();
        } else {
            // 新しく「いいね」を追加
            Like::create([
                'user_id' => $userId,
                'post_id' => $id
            ]);
        }

        // リダイレクトしてページを再読み込み
        return redirect()->back();
    }

    public function favorite($id)
    {
        $userId = auth()->id();
        $existingFavorite = Favorite::where('user_id', $userId)->where('post_id', $id)->first();

        if ($existingFavorite) {
            // すでに「いいね」している場合は削除して、いいねを取り消し
            $existingFavorite->delete();
        } else {
            // 新しく「いいね」を追加
            Favorite::create([
                'user_id' => $userId,
                'post_id' => $id
            ]);
        }

        // リダイレクトしてページを再読み込み
        return redirect()->back();
    }

    // 投稿編集フォームの表示
    public function edit($id)
{
    $post = Post::with(['categoryPosts', 'images', 'spot'])->findOrFail($id);
    $spots = Spot::all();

    // 投稿者であるか確認
    if ($post->user_id !== auth()->id()) {
        return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
    }

    $type = $post->type; // Postモデルのtypeフィールドを取得
    $startDate = $post->start_date ? $post->start_date->format('Y-m-d') : null;
    $endDate = $post->end_date ? $post->end_date->format('Y-m-d') : null;

    $all_categories = Category::all();
    $selectedCategories = $post->categoryPosts->pluck('category_id')->toArray();

    return view('posts.edit', compact(
        'post', 'spots', 'type', 'startDate', 'endDate', 'all_categories', 'selectedCategories'
    ));
}


    
    public function update(Request $request, $id)
{
    \Log::info("Update method called for post ID: " . $id);
    
    // バリデーションルール
    $rules = [
        'spot' => 'required|exists:spots,id', // Spotのバリデーション追加
        'title' => 'string|max:50',
        'event_name' => 'nullable|string|max:30',
        'adult_fee' => 'nullable|numeric|min:0',
        'adult_currency' => 'nullable|string|in:JPY,USD,EUR,GBP,AUD,CAD,CHF,CNY,KRW,INR,Free',
        'child_fee' => 'nullable|numeric|min:0',
        'child_currency' => 'nullable|string|in:JPY,USD,EUR,GBP,AUD,CAD,CHF,CNY,KRW,INR,Free',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'comments' => 'nullable|string|max:255',
        'category' => 'required',  // 配列またはカンマ区切り文字列
        'helpful_info' => 'nullable|string',
        'image' => 'nullable|array',
    ];
    
    $request->validate($rules);
    
    $post = Post::findOrFail($id);
    
    if ($post->user_id !== auth()->id()) {
        return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
    }

    // Postフィールドの更新
    $post->spot_id = $request->spot; // Spot IDを保存
    \Log::info('Spot ID before save: ' . $post->spot_id);

    $post->title = $request->title ?? '';
    $post->event_name = $request->event_name;
    $post->adult_fee = $request->adult_fee;
    $post->adult_currency = $request->adult_currency;
    $post->child_fee = $request->child_fee;
    $post->child_currency = $request->child_currency;
    $post->start_date = $request->start_date ?: null;
    $post->end_date = $request->end_date ?: null;
    $post->comments = $request->comments;
    $post->helpful_info = $request->helpful_info;
    $post->save();

    \Log::info("Post fields (including helpful_info) updated successfully for post ID: " . $id);

    // カテゴリの更新
    $categoryIds = is_array($request->category) 
        ? array_map('intval', $request->category) 
        : array_map('intval', explode(',', $request->category));
    \Log::info("Categories to save:", ['category_ids' => $categoryIds]);

    $post->categoryPosts()->delete();
    $category_post = [];
    foreach ($categoryIds as $category_id) {
        $category_post[] = [
            "category_id" => $category_id,
            "post_id" => $post->id,
            "status" => 'updated',
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
    $post->categoryPosts()->insert($category_post);
    \Log::info("Checking if new images need to be added for post ID: " . $id);
if ($request->hasFile('image')) {
    \Log::info("Adding new images for post ID: " . $id);
    $imageAdded = app(ImageController::class)->store($request, $post->id, null);

    if ($imageAdded) {
        \Log::info("New images added successfully for post ID: " . $id);
    } else {
        \Log::error("Failed to add new images for post ID: " . $id);
        return redirect()->back()->withErrors(['error' => 'Failed to add new images.']);
    }
}
    



    \Log::info("Update process completed for post ID: " . $id . ". Redirecting to show page.");
    return redirect()->route('post.show', $post->id)->with('success', 'Post updated successfully.');
}

    


    // 投稿の削除
    public function destroy($id)
    {
       $this->post->destroy($id);

       return redirect()->route('home')->with('success', 'Post deleted successfully.');
    }


    private function getCommonData(RecommendationController $recommendationController)
{
    $parentCategories = Category::whereNull('parent_id')->with('children')->get();
    $recommendations = $recommendationController->getRecommendations();

    return compact('parentCategories', 'recommendations');
}

private function applySort($query, $sort)
{
    // ソート条件の適用
    switch ($sort) {
        case 'newest':
            $query->orderBy('created_at', 'desc');
            break;
        case 'popular':
            $query->orderBy('favorites_count', 'desc'); // favorites_countでソート
            break;
        case 'many_likes':
            $query->orderBy('likes_count', 'desc'); // likes_countでソート
            break;
        case 'many_views':
            // viewsカラムが存在する場合のみ views でソート
            if (Schema::hasColumn('posts', 'views')) {
                $query->orderBy('views', 'desc');
            }
            break;
        default: 
            $query->orderBy('created_at', 'desc'); // デフォルトは created_at を使用
            break;
    }

    return $query;
}

    // イベントページ 投稿の表示
      //おすすめの投稿を表示
    public function showEventsPosts(Request $request,RecommendationController $recommendationController )
{
    $sort = $request->input('sort', 'recommended'); // 設定がなければ 'recommended' をデフォルトに設定
    $commonData = $this->getCommonData($recommendationController);
    $user = Auth::user();

    $keyword = $request->input('keyword', null);

    // 基本クエリの作成
    $query = Post::with('images')->where('type', 0)
                 ->withCount(['likes', 'favorites']); // likes と favorites のカウントを追加

     // ソート適用
     $query = $this->applySort($query, $sort);

    $posts = $query->get();
    
    return view('display.events', compact('posts','sort','keyword'))
    ->with('user', $user)
    ->with('parentCategories', $commonData['parentCategories'])
    ->with('eventRecommendations', $commonData['recommendations']['eventRecommendations'])
    ->with('recommendedCategory', $commonData['recommendations']['recommendedCategory']);
}

    //カテゴリごとに表示
    public function showCategoryEventsPosts(Request $request, $category_id = null, RecommendationController $recommendationController)
      {
          $commonData = $this->getCommonData($recommendationController);
          $category = Category::find($category_id);
          $sort = $request->input('sort', 'recommended'); // デフォルトは 'recommended'

          $recommendedCategoryId = $commonData['recommendations']['recommendedCategory']->id ?? null;

          // 基本クエリの作成
            $query = Post::where('type', 1)->with('images')
            ->withCount(['likes', 'favorites']); // likesとfavoritesのカウントを追加
          
          // カテゴリのフィルタリング
    if ($category && $category->parent_id === null) {
        $query->whereHas('categories', function ($query) use ($category) {
            $query->where('renew_categories.parent_id', $category->id);
        });
    } elseif ($category) {
        $query->whereHas('categories', function ($query) use ($category_id) {
            $query->where('renew_categories.id', $category_id);
        });
    } elseif ($recommendedCategoryId) {
        $query->whereHas('categories', function ($query) use ($recommendedCategoryId) {
            $query->where('renew_categories.id', $recommendedCategoryId);
        });
    }

    // ソート適用
    $query = $this->applySort($query, $sort);

    $posts = $query->get();
      
          return view('display.events', compact('posts', 'category'))
          ->with('selectedCategory', $category)
              ->with('parentCategories', $commonData['parentCategories'])
              ->with('eventRecommendations', $commonData['recommendations']['eventRecommendations'])
              ->with('recommendedCategory', $commonData['recommendations']['recommendedCategory'])
              ->with('sort', $sort);
      }

      // 検索機能
  //検索条件の指定
private function getEventsPosts($keyword, $sort)
{
    // クエリビルダを使用して検索条件を設定
    $query = Post::with('images')->where('type', 0)
    ->withCount(['likes', 'favorites']); // likes と favorites のカウントを追加

    // 検索条件を追加
    if (!empty($keyword)) {
        $query->where(function($q) use ($keyword) {
            $q->where('title', 'LIKE', "%{$keyword}%") //'title' in posts table
              ->orWhere('comments', 'LIKE', "%{$keyword}%") // 'comments' in posts table
              ->orWhere('event_name', 'LIKE', "%{$keyword}%"); //'event_name' in posts table
        });
    }

   // ソート適用
   $query = $this->applySort($query, $sort);

    // 最大6件の投稿を取得
    return $query->limit(8)->get();
}

//検索した投稿の取得
public function searchEventsPosts(Request $request, RecommendationController $recommendationController)
{
    $keyword = $request->input('keyword', null);
    $sort = $request->input('sort', 'created_at'); // デフォルトを 'created_at' に設定
    $posts = $this->getEventsPosts($keyword,'sort');
    $commonData = $this->getCommonData($recommendationController);

    return view('display.events', compact('posts', 'sort'))
        ->with('parentCategories', $commonData['parentCategories'])
        ->with('eventRecommendations', $commonData['recommendations']['eventRecommendations'])
        ->with('recommendedCategory', $commonData['recommendations']['recommendedCategory']);
}

// ツアリストページ 投稿の表示 
      //おすすめの投稿を表示
      public function showTourismPosts(Request $request, RecommendationController $recommendationController)
{
    $sort = $request->input('sort', 'recommended'); // 設定がなければ 'recommended' をデフォルトに設定
    $commonData = $this->getCommonData($recommendationController);
    $user = Auth::user();

    $keyword = $request->input('keyword', null);

    // 基本クエリの作成
    $query = Post::with('images')->where('type', 1)
                 ->withCount(['likes', 'favorites']); // likes と favorites のカウントを追加


    // ソート適用
    $query = $this->applySort($query, $sort);

    $posts = $query->get();

    

    return view('display.tourism', compact('posts', 'sort','keyword'))
        ->with('user', $user)
        ->with('parentCategories', $commonData['parentCategories'])
        ->with('tourismRecommendations', $commonData['recommendations']['tourismRecommendations'])
        ->with('recommendedCategory', $commonData['recommendations']['recommendedCategory']);
}
      
   
public function showCategoryTourismPosts(Request $request, $category_id = null, RecommendationController $recommendationController)
{
    $commonData = $this->getCommonData($recommendationController);
    $category = Category::find($category_id);
    $sort = $request->input('sort', 'recommended'); // デフォルトは 'recommended'

    $recommendedCategoryId = $commonData['recommendations']['recommendedCategory']->id ?? null;

    // 基本クエリの作成
    $query = Post::where('type', 1)->with('images')
                 ->withCount(['likes', 'favorites']); // likesとfavoritesのカウントを追加

    // カテゴリのフィルタリング
    if ($category && $category->parent_id === null) {
        $query->whereHas('categories', function ($query) use ($category) {
            $query->where('renew_categories.parent_id', $category->id);
        });
    } elseif ($category) {
        $query->whereHas('categories', function ($query) use ($category_id) {
            $query->where('renew_categories.id', $category_id);
        });
    } elseif ($recommendedCategoryId) {
        $query->whereHas('categories', function ($query) use ($recommendedCategoryId) {
            $query->where('renew_categories.id', $recommendedCategoryId);
        });
    }

    $query = $this->applySort($query, $sort);

    $posts = $query->get();

    return view('display.tourism', compact('posts', 'category'))
        ->with('selectedCategory', $category)
        ->with('parentCategories', $commonData['parentCategories'])
        ->with('tourismRecommendations', $commonData['recommendations']['tourismRecommendations'])
        ->with('recommendedCategory', $commonData['recommendations']['recommendedCategory'])
        ->with('sort', $sort);
}
// 検索機能
  //検索条件の指定
  private function getTourismPosts($keyword, $sort)
  {
      // クエリビルダを使用して検索条件を設定
      $query = Post::with('images')->where('type', 1)
                   ->withCount(['likes', 'favorites']); // likes と favorites のカウントを追加
  
      // 検索条件を追加
      if (!empty($keyword)) {
          $query->where(function($q) use ($keyword) {
              $q->where('title', 'LIKE', "%{$keyword}%") // 'title' in posts table
                ->orWhere('comments', 'LIKE', "%{$keyword}%"); // 'comments' in posts table
          });
      }
  
      // ソート適用
    $query = $this->applySort($query, $sort);
      
      // 最大6件の投稿を取得
      return $query->limit(8)->get();
  }

//検索した投稿の取得
public function searchTourismPosts(Request $request, RecommendationController $recommendationController)
{
    $keyword = $request->input('keyword', null);
    $sort = $request->input('sort', 'created_at'); // デフォルトを 'created_at' に設定
    $posts = $this->getTourismPosts($keyword, $sort); // ソート条件を渡す
    $commonData = $this->getCommonData($recommendationController);

    return view('display.tourism', compact('posts', 'sort'))
        ->with('parentCategories', $commonData['parentCategories'])
        ->with('tourismRecommendations', $commonData['recommendations']['tourismRecommendations'])
        ->with('recommendedCategory', $commonData['recommendations']['recommendedCategory']);
}

}

