<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use softDeletes;
    
    protected $table = "categories";
    protected $fillable = ['name','slug'];
    protected $guarded =[];   
    const CREATED_AT ="created_date";
    const UPDATED_AT = "updated_date";

    public function getProducts()
    {
        return $this->belongsTo(Product::class,'category_product');
    }
}