<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedItems extends Model
{
    protected $table = 'saved_items';

    protected $fillable = [
        'id','salon_id','user_id','created_at','updated_at'
    ];

//    public function scopeSelection($query)
//    {
//
//        return $query->select( 'name','image_url');
//    }



}
