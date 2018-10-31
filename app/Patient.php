<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'no_rm',
        'treatment_type',
        'name',
        'birthday',
        'age_class',
        'gender',
        'disease_code',
        'domicile',
        'patient_type',
        'entry_date',
        'exit_date',
        'payment_type',
        'release_note',
    ];

    public function disease()
    {
        return $this->belongsTo('App\Disease');
    }
}
