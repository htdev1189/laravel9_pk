<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    // get category (one to one)
    public function getCategory()
    {
        return $this->belongsTo(Category::class,'category','id');
    }

}
