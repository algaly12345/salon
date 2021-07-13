<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'id','name','image_url','created_at','updated_at'
    ];

    public function scopeSelection($query)
    {

        return $query->select( 'name','image_url');
    }
}
