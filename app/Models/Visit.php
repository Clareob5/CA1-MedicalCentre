<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Visit extends Model
{
    use HasFactory;
    use SoftDeletes; //soft deletes are used so that the visit is not permanently deleted from the database

    //describes the relationship taht visits has with doctors (one to many)
    public function doctor(){
      return $this->belongsTo('App\Models\Doctor');
    }

    //describes the relationship taht visits has with doctors (one to many)
    public function patient(){
      return $this->belongsTo('App\Models\Patient');
    }
}
