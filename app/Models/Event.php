<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    $events = Event::all();

    // 特定のイベント名を取得
    foreach ($events as $event) {
        echo $event->event_name;
    }
    
    // 今日のイベントを取得
    $todayEvents = Event::whereDate('start_date', today())->get();

}
