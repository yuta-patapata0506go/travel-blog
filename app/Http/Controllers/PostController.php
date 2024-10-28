<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Spot;
use App\Models\Comment;
use App\Models\User;    
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $post;

    private $category;
    private $image;

    public function __construct(Post $post, category $category, image $image)

    {
        $this->post = $post;
        $this->category = $category;
        $this->image = $image;
    }


     // 新規投稿フォームの表示
     public function create($type)
     {
         // カテゴリーを取得
         $all_categories = $this->category->all();
     
         // $typeと$all_categoriesをビューに渡す
         return view('posts.create', compact('type', 'all_categories'));
     }
     

    // 投稿の一覧表示
    public function index(Request $request)
    {
        $type = $request->input('type', 0);  // デフォルトは観光（tourism）

        // typeによってフィルタリングされたポストを取得
        if ($type == 0) {
            // 観光ポストを取得
            $posts = Post::tourism()->get();
        } elseif ($type == 1) {
            // イベントポストを取得
            $posts = Post::event()->get();
        } else {
            // 全てのポストを取得
            $posts = Post::all();
        }

        return view('posts.index', compact('posts'));
    }

     // 投稿の詳細表示
     public function show($id)
     {
         $post = $this->post->with('user', 'spot', 'comments')->findOrFail($id);
         return view('posts.show', compact('post'));
     }

   

    // 新規投稿の保存
    public function store(Request $request)
    {
        // バリデーションルール
        $request->validate([
            'title' => 'required|string|max:30',
            'type' => 'required|integer|in:0,1',
            'event_name' => 'nullable|string|max:30',
            'fee' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'comments' => 'nullable|string|max:255',
            'category' => 'required|array', // 複数カテゴリー対応
            'helpful_info' => 'nullable|string',
            'image' => 'required', // 画像が必須
        ]);

        // 新しい投稿を作成
   
        $this->post->user_id = auth()->id(); // 現在のユーザーIDをセット
        $this->post->spots_id = $request->spots_id; // スポットID
        $this->post->title = $request->title;
        $this->post->type = $request->type;
        $this->post->event_name = $request->input('event_name');
        $this->post->fee = $request->fee;
        $this->post->start_date = $request->start_date;
        $this->post->end_date = $request->end_date;
        $this->post->comments = $request->comments;
        $this->post->helpful_info = $request->helpful_info;

        // 投稿を保存
        $this->post->save();

        foreach($request->category as $category_id):
            $category_post[] = ["category_id"=>$category_id];
        endforeach;

        $this->post->category_post()->createMany($category_post);

        // / 画像の保存（ImageControllerで処理を行う）
        app(ImageController::class)->store($request, $post->id);

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

        return view('posts.edit', compact('post'));
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
