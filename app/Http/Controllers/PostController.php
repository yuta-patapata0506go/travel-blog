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

     

    // 投稿の一覧表示
    public function index(Request $request)
    {
      
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

        // `type` が `1` の場合のみ `start_date` を必須にする
        if ($request->type == 0) {
            $rules['start_date'] = 'required|date';
            $rules['end_date'] = 'required|date';
        }

        // バリデーションを実行
        $request->validate($rules);


        // 新しい投稿を作成
   
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
        app(ImageController::class)->store($request, $this->post->id);

        return redirect()->back()->with('success', 'Post created successfully.');
    }

    // 投稿編集フォームの表示
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // 投稿者であるか確認
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        $type = $post->type; // Postモデルのtypeフィールドを取得
        $startDate = $post->start_date ? $post->start_date->format('Y-m-d') : null;
    $endDate = $post->end_date ? $post->end_date->format('Y-m-d') : null;

        return view('posts.edit', compact('post', 'type', 'startDate', 'endDate'));
    }

    // 投稿の更新
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // 投稿者であるか確認
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        // バリデーションルール
        $request->validate([
            'title' => 'required|string|max:30',
            'type' => 'required|integer|in:0,1',
            'event_name' => 'nullable|string|max:30',
            'fee' => 'nullable|numeric|min:0',
            'date' => 'required|date',
            'comments' => 'nullable|string|max:255',
            'helpful_info' => 'nullable|string',
            'visibility_status' => 'required|integer|in:0,1',
        ]);

        // 投稿のデータを更新
        $post->spots_id = $request->input('spots_id');
        $post->title = $request->input('title');
        $post->type = $request->input('type');
        $post->event_name = $request->input('event_name');
        $post->fee = $request->input('fee');
        $post->date = $request->input('date');
        $post->comments = $request->input('comments');
        $post->helpful_info = $request->input('helpful_info');
        $post->visibility_status = $request->input('visibility_status');

        // 投稿を保存
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
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
