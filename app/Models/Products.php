<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Products extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    protected $table = 'products';
    public $translatedAttributes = ['name','description'];

    protected $fillable=['id', 'category_id', 'image', 'purchase_price', 'sale_price', 'stock', 'created_at', 'updated_at'];

    protected $appends = ['image_path','profit_percent'];

    public function category(){

        return  $this->belongsTo(category::class);

    }


    public function getImagePathAttribute()
     {
       return asset('uploads/product_images/' . $this->image);
     }


     public function getProfitPercentAttribute()
     {

         $profit = $this->sale_price - $this->purchase_price;
         $profit_percent = $profit * 100 / $this->purchase_price;

         return number_format($profit_percent, 2);

     }


     





}
