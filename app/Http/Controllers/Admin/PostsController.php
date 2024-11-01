<?php

// app/Http/Controllers/Admin/PostsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $all_posts = Post::with('user')
                        ->select('id', 'title', 'spot', 'user_id', 'category', 'type', 'created_at', 'visibility')
                        ->orderBy('id', 'asc')
                        ->paginate(10);

        return view('admin.posts.posts-index', compact('all_posts'));
    }
}
