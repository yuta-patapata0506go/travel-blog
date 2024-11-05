<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Spot;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['post_id','image_url','spot_id', 'user_id', 'caption', 'status'];

    public function post()
{
    return $this->belongsTo(Post::class);
}

    public function spot()
{
    return $this->belongsTo(Spot::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
