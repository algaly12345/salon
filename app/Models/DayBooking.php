<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayBooking extends Model
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
