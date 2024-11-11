<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    // laravel-instaから
    use HasFactory;
    public $timestamps = false;

     /*  ChatGPTから */
     use HasFactory;
     // 使用するテーブル名を指定（デフォルトで 'favorites' に対応するので省略可能）
     protected $table = 'favorites';
 
     // 代入可能な属性を指定
     protected $fillable = [
         'user_id',
         'post_id',
         'spot_id',
         'created_at',
     ];
    
     // ユーザーとのリレーション (1対多の「多」側)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ポストとのリレーション (1対多の「多」側)
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // スポットとのリレーション (1対多の「多」側)
    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }

}
