<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'id','services_name','salon_id','created_at','updated_at'
    ];

    public function scopeSelection($query)
    {

        return $query->select( 'services_name','salon_id');
    }
}
