<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $guarded = [];


  //client belongs to orders(client(one)------->client(many))
    public function client()
    {
        return $this->belongsTo(Client::class);
    }




    public function products()
    {

        return $this->belongsToMany(Products::class ,'product_order')->withPivot('quantity');
    }







}
