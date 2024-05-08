<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoryTranslation extends Model
{
    use HasFactory;
    protected $table = 'category_traslations';

    protected $fillable = ['name'];

    public $timestamps = false;
}
