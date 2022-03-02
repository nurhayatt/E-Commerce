<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Basket extends Model
{
    use SoftDeletes;

    protected $table = "basket";
    // protected $fillable = ['name', 'slug','description'];
    protected $guarded = [];
    const CREATED_AT = "created_date";
    const UPDATED_AT = "updated_date";
  
    public function getOrder()
    {
        return $this->hasOne('App\Models\Order');
    }
    public function getBasketProduct()
    {
        return $this->hasMany('App\Models\BasketProduct');
    }
    public static function  activeBasketId()
    {
        $active_basket = DB::table('basket as b')
        ->leftJoin('order as o', 'o.basket_id','=','b.id')
        ->where('b.user_id',auth()->id())
        ->whereRaw('o.id is null')
        ->orderByDesc('b.created_date')
        ->select('b.id')
        ->first();
       if(!is_null($active_basket))
       
       return $active_basket->id;
       
    }

    public function getBasketProductNumber()

     {
        return DB::table('basket_product')->where('basket_id',$this->id)->sum('number');   
     }

}