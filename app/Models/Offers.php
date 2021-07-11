<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $table = 'offers';

    protected $fillable = [
        'id','salon_id','services_id','descount','created_at','updated_at'
    ];

    public function scopeSelection($query)
    {

        return $query->select( 'salon_id','services_id','descount');
    }
}
