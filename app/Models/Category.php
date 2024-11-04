<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    protected $table ="renew_categories";

    #To get the number of categories for each post
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post_pivot', 'category_id', 'post_id')
                    ->using(CategoryPost::class) // カスタムピボットモデルを指定
                    ->withPivot('status'); // 追加のピボット属性を指定
    }

}









