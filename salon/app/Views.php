<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Views extends Model
{
    protected $table = 'views';

    protected $fillable = [
        'id','user_id','salon_id','created_at','updated_at'
    ];

}
