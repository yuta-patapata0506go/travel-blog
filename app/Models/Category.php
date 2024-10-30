<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

   
    protected $fillable =[
        'title',
        'status'
    ];

    #To get the number of categories for each post
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);

       
    }   
}









