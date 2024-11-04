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

     public function user(){
        return $this->belogsTo(User::class, 'id');
     }
     public function favoritePostsDetail(){
        return $this->hasOne(Post::class, 'id');
    }
    public function favoriteSpotsDetail(){
        return $this->hasOne(Spot::class, 'id');
    }


}
