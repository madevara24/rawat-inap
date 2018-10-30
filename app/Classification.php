<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $fillable = [
        'class_code',
        'class_name'
      ];

    public function diseases(){
        return $this->hasMany('App\Disease');
    }
}
