<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';

    protected $fillable = [
        'id','user_id','salon_id','rating','content','created_at','updated_at'
    ];

//    public function scopeSelection($query)
//    {
//
//        return $query->select( 'name','image_url');
//    }
}
