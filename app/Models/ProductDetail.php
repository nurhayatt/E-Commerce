<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = "product_details";
    public $timestamps =false;
    public function getProduct()
    {
        return $this->belongsTo(Product::class);
    }
}