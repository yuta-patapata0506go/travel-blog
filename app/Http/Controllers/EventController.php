<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Post; // Postモデルをインポート
use Carbon\Carbon;


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

    /**
     * 特定の日付のイベントを検索する
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function searchByDate(Request $request)
    {
        $date = Carbon::parse($request->query('date'));

        // 今日のイベントを取得（type = 1 のイベントのみ）
        $todayEvents = Post::where('type', 0)
                           ->whereDate('start_date', '<=', $date->toDateString())
                           ->whereDate('end_date', '>=', $date->toDateString())
                           ->get();

        // 明日のイベントを取得
        $tomorrow = $date->copy()->addDay();
        $tomorrowEvents = Post::where('type', 0)
                              ->whereDate('start_date', '<=', $tomorrow->toDateString())
                              ->whereDate('end_date', '>=', $tomorrow->toDateString())
                              ->get();

        // 今月のイベントを取得（選択された日を含む月）
        $monthEvents = Post::where('type', 0)
                           ->whereMonth('start_date', $date->month)
                           ->whereYear('start_date', $date->year)
                           ->get();

                           return response()->json([
                            'today' => $todayEvents->isEmpty() ? null : $todayEvents,
                            'tomorrow' => $tomorrowEvents->isEmpty() ? null : $tomorrowEvents,
                            'month' => $monthEvents->isEmpty() ? null : $monthEvents,
                        ]);
    }
    /**
     * Post モデルを利用するサンプルメソッド
     */
    public function examplePostUsage()
    {
        // Post モデルからデータを取得（例：全ての投稿を取得）
        $posts = $this->post->all();
        
        // 投稿情報をビューに渡す
        return view('posts.index', compact('posts'));
    }
}
