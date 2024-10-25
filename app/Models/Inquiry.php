<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'body'];

    // respnses - one to many
    public function responses()
    {
        return $this->hasMany(Response::class, 'inquiry_id');
    }

    // users many to one
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
