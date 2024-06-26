<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsTranslation extends Model
{
    use HasFactory;


    protected $table = 'products_traslations';

    public $timestamps = false;

    protected $fillable = ['name', 'description'];
}

