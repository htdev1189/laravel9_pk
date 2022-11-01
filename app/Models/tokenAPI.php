<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Sanctum\HasApiTokens;

class tokenAPI extends Model
{
    protected $table = 'tokenapi';
    use HasFactory;
}
