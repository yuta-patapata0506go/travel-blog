<?php

// app/Http/Controllers/Admin/UsersController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        // ユーザー情報を取得してページネーションを設定
        $all_users = User::withTrashed()->paginate(10);

        // ビューにデータを渡す
        return view('admin.users.users-index', compact('all_users'));
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


