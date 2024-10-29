<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\Pivot;


class CategoryPost extends Pivot
{
    use HasFactory;

    protected $table = "category_post_pivot";
    public $timestamps = false;
    protected $fillable = ['category_id','post_id','status'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
