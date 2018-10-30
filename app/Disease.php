<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $fillable = [
        'disease_code',
        'disease_name',
        'class_code'
    ];
    
    public function classification(){
        return $this->belongsTo('App\Classification');
    }

    public function patients(){
        return $this->hasMany('App\Patient');
    }
}
