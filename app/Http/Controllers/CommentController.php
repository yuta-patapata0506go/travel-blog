<?php
namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Spot;
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
        // post_id または spot_id のどちらかをセット
        if ($request->has('post_id')) {
            $comment->post_id = $id;
        } elseif ($request->has('spot_id')) {
            $comment->spot_id = $id;
        }
        $comment->parent_id = $request->parent_id ?? null; // リプライがある場合
        if ($comment->save()) {
            return redirect()->back()->with('success', 'コメントが保存されました！');
        } else {
            return redirect()->back()->with('error', 'コメントの保存に失敗しました。');
        }
    }
    // コメントを表示
    public function show($id)
    {
        // まず Post として検索し、見つからなければ Spot として検索
        $post = Post::find($id);
        $spot = Spot::find($id);
        if ($post) {
            $comments = Comment::where('post_id', $id)
                ->whereNull('parent_id')
                ->with(['user', 'replies.user'])
                ->orderBy('created_at', 'desc')
                ->get();
            return view('posts.show', compact('post', 'comments'));
        } elseif ($spot) {
            $comments = Comment::where('spot_id', $id)
                ->whereNull('parent_id')
                ->with(['user', 'replies.user'])
                ->orderBy('created_at', 'desc')
                ->get();
            return view('spot.show', compact('spot', 'comments'));
        } else {
            abort(404); // 見つからない場合、404エラーを返す
        }
    }
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->delete()) {
            return redirect()->back()->with('success', 'コメントが削除されました。');
        } else {
            return redirect()->back()->with('error', 'コメントの削除に失敗しました。');
        }
    }
}