<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Spot;
use App\Models\Image;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
