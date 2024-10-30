<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category; 
use App\Models\Image;   
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $post;

    private $category;
    private $image;

    public function __construct(Post $post, Category $category, Image $image)

    {
        $this->post = $post;
        $this->category = $category;
        $this->image = $image;
    }


     // 新規投稿フォームの表示
     public function create($type)
{
    // Categoryモデルから全てのカテゴリを取得
    $all_categories = Category::all();  // インスタンスではなく、直接モデルを呼び出す

    // $typeと$all_categoriesをビューに渡す
    return view('posts.create', compact('type', 'all_categories'));
}

     
     // 投稿の詳細表示
     public function show($id)
     {
        //  $post = $this->post->with('user', 'spot', 'comments')->findOrFail($id);
       $post = $this->post->with(['images','categories'])->findOrFail($id);

         return view('posts.show', compact('post'));
     }

   

    // 新規投稿の保存
    public function store(Request $request)
    {
       // バリデーションルールを定義
        $rules = [
            'title' => 'string|max:30',
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
        $this->post->CategoryPost()->createMany($category_post);

        // / 画像の保存（ImageControllerで処理を行う）
        app(ImageController::class)->store($request, $this->post->id,null);

        return redirect()->route('post.show', ['id' => $this->post->id])
        ->with('success', 'Post created successfully.');
    }

    // 投稿編集フォームの表示
    public function edit($id)
    {
        $post = Post::with(['CategoryPost', 'images'])->findOrFail($id);

        // 投稿者であるか確認
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        $type = $post->type; // Postモデルのtypeフィールドを取得
        $startDate = $post->start_date ? $post->start_date->format('Y-m-d') : null;
        $endDate = $post->end_date ? $post->end_date->format('Y-m-d') : null;
       
    // 全てのカテゴリを取得
    $all_categories = Category::all(); // これで$all_categoriesがビューに渡されます
    $selectedCategories = $post->CategoryPost->pluck('category_id')->toArray(); // 選択済みのカテゴリID
    

        return view('posts.edit', compact('post', 'type', 'startDate', 'endDate','all_categories', 'selectedCategories'));
    }

    
    public function update(Request $request, $id)
    {
        \Log::info("Update method called for post ID: " . $id);
    
        // バリデーションルールを定義
        $rules = [
            'title' => 'string|max:30',
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
    
        // カテゴリIDを配列に変換
        $categoryIds = is_array($request->category) 
            ? array_map('intval', $request->category) 
            : array_map('intval', explode(',', $request->category));
    
        \Log::info("Categories to save:", ['category_ids' => $categoryIds]);
    
        $post->CategoryPost()->delete();
    
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
        $post->CategoryPost()->insert($category_post);
        \Log::info("Received categories:", ['category' => $request->category]);

        \Log::info("Categories updated successfully for post ID: " . $post->id . " with categories: " . implode(',', $categoryIds));
    
        if ($request->hasFile('image')) {
            \Log::info("Updating images for post ID: " . $id);
            foreach ($post->images as $image) {
                app(ImageController::class)->destroy($image->id);
            }
            app(ImageController::class)->store($request, $post->id, null);
            \Log::info("Images updated successfully for post ID: " . $id);
        }
    
        \Log::info("Update process completed for post ID: " . $id . ". Redirecting to show page.");
        return redirect()->route('post.show', $post->id)->with('success', 'Post updated successfully.');
    }
    

    

    
    
    

    // 投稿の削除
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // 投稿者であるか確認
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        // 投稿を削除
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
