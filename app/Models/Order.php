<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = "orders";
    protected $fillable = ['basket_id', 'order_amount', 'status','bank', 'number_of_installments','name','adress','telephone','phone'];
   
    const CREATED_AT = "created_date";
    const UPDATED_AT = "updated_date";

    public function getBasket()
    {
        return $this->belongsTo('App\Models\Basket');
    }
}