<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name','phone','address'];

    protected $hidden=['created_at','updated_at'];

    protected $casts = [
        'phone' => 'array'
    ];
}
