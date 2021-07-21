<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $table = 'salons';

    protected $fillable = [
        'id','salon_name','salon_description','salon_address','longitude','latitude','price','data_id','owner_id','salon_email','category_id','created_at','updated_at'
    ];

    public function scopeSelection($query)
    {

        return $query->select( 'id','salon_name','salon_description','salon_address','longitude','latitude','price','data_id','owner_id','salon_email','category_id'
        );
    }

    public function salonImages(){

        return $this -> hasMany(SalonImage::class,'salon_id','id');
    }

    public function bookingdays(){

        return $this -> hasMany(DayBooking::class,'salon_id','id');
    }


    public function salonServices(){
        return $this -> hasMany(Services::class,'salon_id','id');
    }


    public function salonOffers(){
        return $this -> hasMany(Offers::class,'salon_id','id');
    }


    public function salonSpecialists(){
        return $this -> hasMany(Specialist::class,'salon_id','id');
    }
}
