<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Spot;
use App\Models\CategoryPost;
use App\Models\Category;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    // Define the table associated with the model
    protected $table = 'posts';

    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'spots_id',
        'type',
        'title',
        'event_name',
        'adult_fee',
        'adult_currency',
        'child_fee',
        'child_currency',
        'comments',
        'helpful_info',
        'visibility_status',
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];

    // Cast attributes to appropriate types
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Relationships
     */

    // A post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function CategoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }

    public function SpotPost()
    {
        return $this->hasOne(Spot::class, 'id', 'spots_id');
    }

    
    // A post belongs to a spot
    public function spot()
    {
        return $this->belongsTo(Spot::class, 'spots_id', 'id');
    }

    // A post has many images
    public function images()
    {
        return $this->hasMany(Image::class, 'post_id');
    }

    // A post has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // A post has many likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Check if the post is liked by a specific user
    public function isLiked()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    // A post has many favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // likes_count をアクセサとして定義
    public function getLikesCountAttribute()
    {
        return $this->attributes['likes_count']; // データベースの likes_count カラムを返す
    }

    // Accessor to check if the post is favorited by the authenticated user
    public function getIsFavoritedAttribute()
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }

    // A post belongs to many categories through the pivot table category_post_pivot
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post_pivot', 'post_id', 'category_id')
                    ->using(CategoryPost::class)
                    ->withPivot('status');
    }

    // A post has many category posts (pivot model)
    public function categoryPosts()
    {
        return $this->hasMany(CategoryPost::class, 'post_id');
    }

    /**
     * Scopes
     */

    // Scope to filter posts that are events (type = 1)
    public function scopeEvents($query)
    {
        return $query->where('type', 1);
    }

    // Scope to filter posts that are tourism (type = 0)
    public function scopeTourism($query)
    {
        return $query->where('type', 0);
    }

    /**
     * Accessors and Mutators
     */

    // Accessor to check if the post is an event
    public function getIsEventAttribute()
    {
        return $this->type === 1;
    }

    // Accessor to get formatted start date
    public function getFormattedStartDateAttribute()
    {
        return $this->start_date ? $this->start_date->format('Y-m-d') : null;
    }

    // Accessor to get formatted end date
    public function getFormattedEndDateAttribute()
    {
        return $this->end_date ? $this->end_date->format('Y-m-d') : null;
    }

    // Mutator to set start date
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? \Carbon\Carbon::parse($value) : null;
    }

    // Mutator to set end date
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? \Carbon\Carbon::parse($value) : null;
    }

    protected $attributes = [
        'views' => 0, // デフォルト値を0に設定
    ];
}



// app/Models/Post.php