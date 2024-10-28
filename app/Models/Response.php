<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'inquiry_id',
        'user_id',
        'body',
    ];

    // inquiries - many to one
    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }

    // users - many to one
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
