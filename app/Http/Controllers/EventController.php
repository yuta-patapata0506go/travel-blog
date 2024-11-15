<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Post; // Postモデルをインポート
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{
    private $post;

    /**
     * コンストラクタで Post モデルのインスタンスを注入
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        // イベントページのビューを返す
        return view('display.events'); // 'resources/views/display/events.blade.php' を表示
    }

    /**
     * 特定の日付のイベントを検索する
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function searchByDate(Request $request)
    {
        $date = Carbon::parse($request->query('date'));
        
        $todayEvents = Post::where('type', 0)
                           ->whereDate('start_date', '<=', $date->toDateString())
                           ->whereDate('end_date', '>=', $date->toDateString())
                           ->with(['images', 'categories'])  // リレーションを取得
                           ->get();

        $tomorrow = $date->copy()->addDay();
        $tomorrowEvents = Post::where('type', 0)
                              ->whereDate('start_date', '<=', $tomorrow->toDateString())
                              ->whereDate('end_date', '>=', $tomorrow->toDateString())
                              ->with(['images', 'categories'])  // リレーションを取得
                              ->get();

        $monthEvents = Post::where('type', 0)
                           ->whereMonth('start_date', $date->month)
                           ->whereYear('start_date', $date->year)
                           ->with(['images', 'categories'])  // リレーションを取得
                           ->get();

        $selectedEvents = Post::where('type', 0)
                              ->whereDate('start_date', '<=', $date->toDateString()) 
                              ->whereDate('end_date', '>=', $date->toDateString())
                              ->with(['images', 'categories'])  // リレーションを取得
                              ->get();

        return response()->json([
            'today' => $todayEvents->isEmpty() ? null : $todayEvents,
            'tomorrow' => $tomorrowEvents->isEmpty() ? null : $tomorrowEvents,
            'month' => $monthEvents->isEmpty() ? null : $monthEvents,
            'selected' => $selectedEvents->isEmpty() ? null : $selectedEvents,
        ]);
    }

    public function showEvents()
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $startOfMonth = $today->copy()->startOfMonth();
        $endOfMonth = $today->copy()->endOfMonth();
    
        $todayEvents = Post::where('type', 0)
                           ->whereDate('start_date', '<=', $today)
                           ->whereDate('end_date', '>=', $today)
                           ->with(['images', 'categories'])  // リレーションを取得
                           ->take(4)
                           ->get();
    
        $tomorrowEvents = Post::where('type', 0)
                              ->whereDate('start_date', '<=', $tomorrow)
                              ->whereDate('end_date', '>=', $tomorrow)
                              ->with(['images', 'categories'])
                              ->take(4)
                              ->get();
    
        $monthEvents = Post::where('type', 0)
                           ->whereBetween('start_date', [$startOfMonth, $endOfMonth])
                           ->orWhereBetween('end_date', [$startOfMonth, $endOfMonth])
                           ->with(['images', 'categories'])
                           ->take(4)
                           ->get();
    
        return view('events.index', compact('todayEvents', 'tomorrowEvents', 'monthEvents'));
    }

    public function like(Request $request, $id)
{
    try {
        $post = Post::findOrFail($id);
        $user = Auth::user();

        if ($post->isLiked()) {
            $post->likes()->detach($user->id);
            $isLiked = false;
        } else {
            $post->likes()->attach($user->id);
            $isLiked = true;
        }

        return response()->json([
            'isLiked' => $isLiked,
            'likeCount' => $post->likes->count(),
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while updating like.'], 500);
    }
}

public function favorite(Request $request, $id)
{
    try {
        $post = Post::findOrFail($id);
        $user = Auth::user();

        if ($post->isFavorited()) {
            $post->favorites()->detach($user->id);
            $isFavorited = false;
        } else {
            $post->favorites()->attach($user->id);
            $isFavorited = true;
        }

        return response()->json([
            'isFavorited' => $isFavorited,
            'favoriteCount' => $post->favorites->count(),
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while updating favorite.'], 500);
    }
}
}