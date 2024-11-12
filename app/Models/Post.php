<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Spot;
use App\Models\CategoryPost;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function CategoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }

    
    public function spot()
    {
        return $this->belongsTo(Spot::class, 'spots_id', 'id');
    }
    

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    
    public function images()
    {
        return $this->hasMany(Image::class, 'post_id'); // 'post_id'が外部キー
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post_pivot', 'post_id', 'category_id')
                    ->using(CategoryPost::class) // カスタムピボットモデルを指定
                    ->withPivot('status'); // 追加のピボット属性を指定  
    }

    public function likes(){
        // select * from likes
        return $this->hasMany(Like::class,'post_id');
    }
    public function isLiked(){
        // CHECK IF YOU LIKED THE POST ALREADY
       return $this->likes()->where('user_id', auth()->user()->id)->exists();
    }
    // select * from likes where post_id = 15 and user_id = 2 ???? == TRUE

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    // アクセサとしてisFavoritedを定義
    public function getIsFavoritedAttribute()
    {
        return $this->favorites()->where('user_id', auth()->user()->id)->exists();
    }
    

// 日付としてキャストする属性
protected $casts = [
    'start_date' => 'datetime',
    'end_date' => 'datetime',
];
}

// app/Models/Post.php


