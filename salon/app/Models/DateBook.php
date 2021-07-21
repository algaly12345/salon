<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DateBook extends Model
{
    protected $table = 'day_bookings';

    protected $fillable = [
        'id','salon_id','day','from','to','created_at','updated_at'
    ];

    public function scopeSelection($query)
    {

        return $query->select('id','salon_id','day','from','to','created_at','updated_at');
    }
}
