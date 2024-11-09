<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourismController extends Controller
{
    public function index()
    {
        // ツーリズムページのビューを返す
        return view('display.tourism'); // 'resources/views/display/tourism.blade.php' を表示
    }
}
