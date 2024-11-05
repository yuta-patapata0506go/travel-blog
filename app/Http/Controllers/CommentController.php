<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // コメントを投稿する
    public function store(Request $request, $id)
{
    $request->validate([
        'comment' => 'required|string|max:500',
    ]);

    $comment = new Comment();
    $comment->body = $request->comment;
    $comment->user_id = Auth::id();
    $comment->post_id = $id; // `post_id` に対応
    $comment->spot_id = $request->spot_id ?? null; // 必要であれば
    $comment->parent_id = $request->parent_id ?? null; // リプライがある場合

    if ($comment->save()) {
        return redirect()->back()->with('success', 'コメントが保存されました！');
    } else {
        return redirect()->back()->with('error', 'コメントの保存に失敗しました。');
    }
}

public function destroy($id)
{
    $comment = Comment::findOrFail($id);

    // コメントの削除
    if ($comment->delete()) {
        return redirect()->back()->with('success', 'コメントが削除されました。');
    } else {
        return redirect()->back()->with('error', 'コメントの削除に失敗しました。');
    }
}



}
