<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['body', 'user_id', 'post_id', 'parent_id'];

    // リレーション設定
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }

    // リプライ（自己リレーション）
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // 親コメントを取得
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
