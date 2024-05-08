<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postsTranslation extends Model
{
    use HasFactory;

     protected $table = 'post_translations';

    public $timestamps = false;
    protected $fillable = ['title', 'content','post_id'];

}
