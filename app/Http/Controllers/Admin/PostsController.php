<?php

// app/Http/Controllers/Admin/PostsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Spot;
use App\Models\Category;
use App\Models\User;

class PostsController extends Controller
{
    public function index()
    {
        // $all_posts = Post::withTrashed()
        //                 ->with(['user', 'categories', 'spot']) // 関連データを取得
        //                 ->orderBy('id', 'asc')
        //                 ->paginate(10);
        $all_posts = Post::withTrashed()
                        ->with('user')
                        ->with('categories')
                         ->with('SpotPost')
                        ->orderBy('id', 'asc')
                        ->paginate(10);
        $categories = Category::where('status', 1)->get();
    // dd($all_posts);
        return view('admin.posts.posts-index', compact('all_posts', 'categories'));
    }

    public function hide($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();  // ソフトデリートでポストを非表示にする
            return redirect()->back()->with('success', 'Post hidden successfully!');
        }
        return redirect()->back()->with('error', 'Post not found.');
    }

    public function unhide($id)
    {
        $post = Post::withTrashed()->find($id);
        if ($post && $post->trashed()) {
            $post->restore();  // ソフトデリートから復元してポストを表示する
            return redirect()->back()->with('success', 'Post unhidden successfully!');
        }
        return redirect()->back()->with('error', 'Post not found or not hidden.');
    }
}
