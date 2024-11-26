<?php

// app/Http/Controllers/Admin/PostsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Spot;
use App\Models\Category;
use App\Models\Recommendation;
use App\Models\User;

class PostsController extends Controller
{
    private $post;
    private $user;
    private $spot;
    private $category;
    private $recommendation;

    public function __construct(Post $post, User $user, Spot $spot, Category $category, Recommendation $recommendation)
    {
        $this->post = $post;
        $this->user = $user;
        $this->spot = $spot;
        $this->category = $category;
        $this->recommendation = $recommendation;
    }

    public function index(Request $request)
{
    // Initialize query for posts with trashed
    $query = Post::withTrashed()->latest();

    // Search processing: filter by title, event_name, and comments if search input is provided
    if ($request->has('search')) {
        $query->where(function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('event_name', 'like', '%' . $request->search . '%')
                ->orWhere('comments', 'like', '%' . $request->search . '%');
        });
    }

    // Status Filter for soft deletes
    if ($request->status !== null) {
        if ($request->status == 'deleted') {
            $query->onlyTrashed();  // Show only soft-deleted posts
        } elseif ($request->status == 'active') {
            $query->whereNull('deleted_at');  // Show only non-deleted posts
        }
    }

    // Retrieve post information and set pagination
    $all_posts = $query->paginate(5)->withQueryString();

    // Retrieve other data
    $categories = $this->category->all();
    $existingRecommendation = $this->recommendation->first();

    // Pass data to the view
    return view('admin.posts.posts-index', compact('all_posts', 'categories', 'existingRecommendation'));
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
