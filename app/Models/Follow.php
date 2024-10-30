<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    #user this method to get the info of a follower
    public function follower(){
        return $this->belongsTo(User::class, 'followed_user_id')->withTrashed();
    }
    #use this method to ge tht info of the user being followed
    public function following(){
        return $this->belongsTo(User::class, 'following_user_id')->withTrashed();
    }
}
