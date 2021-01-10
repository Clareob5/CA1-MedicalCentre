<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    //describing that the doctor belongs to user ie a user object can be a doctor
    public function user(){
      return $this->belongsTo('App\Models\User');
    }

    //describes to one to many relationship that the doctors have with visits
    public function visits(){
      return $this->hasMany('App\Models\Visit');
    }
}
