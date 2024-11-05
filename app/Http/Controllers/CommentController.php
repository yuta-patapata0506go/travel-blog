<?php
namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use App\Models\spot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    // コメントを投稿する
    public function store(Request $request, $id)
{
    // `$id`がpostsテーブルに存在するか確認
    $post = Post::find($id);
    if (!$post) {
        return redirect()->back()->with('error', '対象の投稿が存在しません。');
    }
    // `$id`がspottsテーブルに存在するか確認
    $spot = Spot::find($id);
    if (!$spot) {
        return redirect()->back()->with('error', '対象のSPOTが存在しません。');
    }

    $request->validate([
        'comment' => 'required|string|max:500',
        'spot_id' => 'nullable|exists:spots,id', // spot_idがspotsテーブルに存在するか確認
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
