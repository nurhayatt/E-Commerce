<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table= "user_details";
    protected $timestamps = false;
    protected $guarded = [];

    public function getUser()
    {
        return $this->belongsTo('App\Models\User');
    }
}