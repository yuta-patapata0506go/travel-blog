<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;

class ProfileController extends Controller
{
     private $user;

    public function __construct(User $user, Post $post, Favorite $favorite){
        $this->user = $user;
        $this->post = $post;
        $this->favorite = $favorite;
    }
    
    public function show($id){
        $user = $this->user->findOrFail($id);

        $post = $this->post->with(['images', 'categories', 'spot', 'comments.user',  'comments.replies.user', 'comments'])->findOrFail($id);
       
         $userId = auth()->id();
     
         // Spot ID のデバッグログを記録
         \Log::info("Spot ID for post ID {$post->id}: " . $post->spot_id);
     
         // 最初の画像を取得
         $firstImage = $post->images->first();
     
         if (!$post->spot) {
             \Log::warning("Spot not found for post ID: {$post->id}, spot ID: {$post->spot_id}");
             $spotName = 'Location not available';
         } else {
             $spotName = $post->spot->name;
         }
     
          //  // ポストに関連するコメント（親コメントとリプライ）を取得
          //  $comments = Comment::where('post_id', $id)
          //  ->whereNull('parent_id')
          //  ->with(['user', 'replies.user']) // user と replies.user を明示的にロード
          //  ->get();
     
          //  $commentCount = $post->comments()->count();
     
            // Like
            $liked = Like::where('user_id', $userId)->where('post_id', $id)->exists();
            $likesCount = Like::where('post_id', $id)->count();
     
            // Favorite
            $favorited = $post->isFavorited; // アクセサを使用
            $favoritesCount = Favorite::where('post_id', $id)->count();
     
         return view('mypage.mypage-show', compact('post', 'firstImage','spotName', 'liked', 'likesCount','favorited', 'favoritesCount'))->with('user', $user);
     }

    /**
     * method to open edit page
     */

     public function edit(){
        $user = $this->user->FindOrFail(Auth::user()->id);
        return view('mypage.mypage-edit')->with('user', $user);
     }

     /**
      * method to perform the update of user details
      */

      public function update(Request $request){ 
        $request->validate([
            'username' => 'required|min:1|max:50',
            'email'  => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'avatar' => 'mimes:jpeg,jpg,png,gif|max:1048',
            'introduction' => 'max:200'
        ]);

        $user = $this->user->findOrFail(Auth::user()->id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->introduction = $request->introduction;
        
        if($request->avatar){
            $user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
        }

        $user->save();
        return redirect()->route('profile.show', Auth::user()->id);
      }

      public function followers($id){
        $user = $this->user->findOrFail($id);
        return view('mypage.mypage-followers')->with('user',$user);

      }
      public function following($id){
        $user = $this->user->findOrFail($id);
        return view('mypage.mypage-following')->with('user',$user);
      }

      public function favorite(){
        $user = $this->user->FindOrFail(Auth::user()->id);
        $favoritePosts = $user->favoritePosts();
        // dd($user->favoritePosts);
        $favoriteSpots = $user->favoriteSpots();
        return view('mypage.mypage-favorite', compact('favoritePosts'))->with('user', $user);
     }
     
}
