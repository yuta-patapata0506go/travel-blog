<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        // ユーザー情報を取得してページネーションを設定
        $all_users = User::orderBy('updated_at', 'asc')->paginate(10);

        // ビューにデータを渡す
        return view('admin.users.users-index', compact('all_users'));
    }
}
