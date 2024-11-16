<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;
use App\Models\Image;
// use Illuminate\Database\Eloquent\SoftDeletes;



class Spot extends Model
{
    use HasFactory;

    protected $table = 'spots'; // テーブル名を指定

    // 更新可能なカラムのリストを指定
    protected $fillable = [
        'user_id',
        'name',
        'postalcode',
        'address',
        'latitude',
        'longitude'
    ];
    // 画像とのリレーション
    public function images()
    {
        return $this->hasMany(Image::class, 'spot_id'); // 'post_id'が外部キー
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    # To get all the comments of a post
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id'); // parent_idでリプライを取得
    }
    public function likes(){
        // select * from likes
        return $this->hasMany(Like::class);
    }
    public function isLiked(){
        // CHECK IF YOU LIKED THE POST ALREADY
       return $this->likes()->where('user_id', auth()->id())->exists();
    }
    // select * from likes where post_id = 15 and user_id = 2 ???? == TRUE

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    // アクセサとしてisFavoritedを定義
    public function getIsFavoritedAttribute()
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'spots_id');
    }

    

}
