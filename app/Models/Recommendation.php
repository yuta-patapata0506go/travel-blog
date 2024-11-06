<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 
        'post_id',
    ];

    // categories - many to one
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // posts - many to one
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
