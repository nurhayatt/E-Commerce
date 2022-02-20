<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = "products";
   // protected $fillable = ['name', 'slug','description'];
    protected $guarded = [];
    const CREATED_AT = "created_date";
    const UPDATED_AT = "updated_date";

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_product');
    }
    public function getDetail()
    {
        return $this->hasOne(ProductDetail::class);
    }
}