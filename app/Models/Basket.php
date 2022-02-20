<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Basket extends Model
{
    use SoftDeletes;

    protected $table = "basket";
    // protected $fillable = ['name', 'slug','description'];
    protected $guarded = [];
    const CREATED_AT = "created_date";
    const UPDATED_AT = "updated_date";
}