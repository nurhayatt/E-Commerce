<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasketProduct extends Model
{
    use SoftDeletes;

    protected $table = "basket_product";
    protected $guarded = [];
    const CREATED_AT = "created_date";
    const UPDATED_AT = "updated_date";
    public function getProduct()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}