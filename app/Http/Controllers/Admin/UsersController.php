<?php

// app/Http/Controllers/Admin/UsersController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Recommendation;

class UsersController extends Controller
{
    private $user;
    protected $category;
    protected $recommendation;

    public function __construct(User $user, Category $category, Recommendation $recommendation)
    {
        $this->user = $user;
        $this->category = $category;
        $this->recommendation = $recommendation;
    }

    public function index()
    {
        // ユーザー情報を取得してページネーションを設定
        $all_users = User::withTrashed()->paginate(10);
        $categories = $this->category->all();
        $existingRecommendation = $this->recommendation->first();

        // ビューにデータを渡す
        return view('admin.users.users-index', compact('all_users', 'categories', 'existingRecommendation'));
    }

    public function hide($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User hidden successfully!');
        }
        return redirect()->back()->with('error', 'User not found.');
    }
    public function unhide($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user && $user->trashed()) {
            $user->restore();
            return redirect()->back()->with('success', 'User unhidden successfully!');
        }
        return redirect()->back()->with('error', 'User not found or not hidden.');
    }

}


