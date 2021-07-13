<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalonImage extends Model
{
    protected $table = 'salon_images';

    protected $fillable = [
        'id','salon_id','title','image_url','created_at','updated_at'
    ];

    public function scopeSelection($query)
    {

        return $query->select( 'salon_id','title','image_url');
    }
}
