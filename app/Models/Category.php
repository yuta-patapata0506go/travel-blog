<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ="renew_categories";

    #To get the number of categories for each post
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post_pivot', 'category_id', 'post_id')
                    ->using(CategoryPost::class) // カスタムピボットモデルを指定
                    ->withPivot('status'); // 追加のピボット属性を指定
    }

    // parent - children : one to many
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // children - parent : many to one
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // category - recommendation: one to many
    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }


}









