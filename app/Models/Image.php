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
    protected $fillable = ['image_url', 'post_id', 'spot_id', 'user_id', 'caption', 'status'];

    // スポットとのリレーション
    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
