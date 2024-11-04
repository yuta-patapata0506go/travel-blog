<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function followers(){
        return $this->hasMany(Follow::class, 'following_user_id');
    }

    public function following(){
        return $this->hasMany(Follow::class, 'followed_user_id');
    }
    public function isFollowed(){
        return $this->followers()->where('followed_user_id', Auth::user()->id)->exists();
    }

    public function favoritePosts(){
        return $this->hasMany(Favorite::class, 'user_id')
        ->whereNotNull('post_id');
    }
    public function favoriteSpots(){
        return $this->hasMany(Favorite::class, 'user_id')
        ->whereNotNull('spot_id');
    }
   

    // check if the role is admin
    public function isAdmin()
    {
        return $this->role === 1; // Check if the role is admin (1)
    }
}
