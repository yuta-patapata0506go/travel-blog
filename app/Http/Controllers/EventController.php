<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // イベントページのビューを返す
        return view('display.events'); // 'resources/views/display/events.blade.php' を表示
    }
}
