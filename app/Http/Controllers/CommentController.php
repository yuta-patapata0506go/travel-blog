<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Spot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // コメントの保存
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $comment = new Comment();
        $comment->body = $request->comment;
        $comment->user_id = Auth::id();

        // post_id または spot_id を設定
        if ($request->has('post_id')) {
            $comment->post_id = $id;
        } elseif ($request->has('spot_id')) {
            $comment->spot_id = $id;
        }

        $comment->parent_id = $request->parent_id ?? null;

        if ($comment->save()) {
            return redirect()->back()->with('success', 'コメントが保存されました！');
        } else {
            return redirect()->back()->with('error', 'コメントの保存に失敗しました。');
        }
    }

    // コメントの削除
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id === Auth::id()) {
            $comment->delete();
            return redirect()->back()->with('success', 'コメントが削除されました。');
        } else {
            return redirect()->back()->with('error', '削除する権限がありません。');
        }
    }

    // コメントの表示
    public function show($id, $type)
    {
        if ($type === 'post') {
            $post = Post::findOrFail($id);
            $comments = Comment::where('post_id', $id)
                ->whereNull('parent_id')
                ->with(['user', 'replies.user'])
                ->orderBy('created_at', 'desc')
                ->get();
            return view('post.show', compact('post', 'comments'));
        } elseif ($type === 'spot') {
            $spot = Spot::findOrFail($id);
            $comments = Comment::where('spot_id', $id)
                ->whereNull('parent_id')
                ->with(['user', 'replies.user'])
                ->orderBy('created_at', 'desc')
                ->get();
            return view('spot.show', compact('spot', 'comments'));
        } else {
            abort(404); // 無効なタイプのときは404エラー
        }
    }
}







