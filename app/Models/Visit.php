<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Visit extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function doctor(){
      return $this->belongsTo('App\Models\Doctor');
    }

    public function patient(){
      return $this->belongsTo('App\Models\Patient');
    }
}
