<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // get post (one to many)
    public function getPosts()
    {
        return $this->hasMany(Post::class,'category','id');
        // hasMany('table','khoa ngoai tai table huong toi','khoa chinh')
    }
}
