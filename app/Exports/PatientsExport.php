<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class PatientsExport implements FromView
{
    /*public function collection()
    {
    $diseases = DB::table('patients')
    ->select('disease_code')
    ->distinct('disease_code')
    //->groupBy('class_code')
    ->get();
    //return Patient::all();
    return $diseases;
    }*/

    public function view(): View
    {
        $patients = DB::table('patients')
            ->leftJoin('diseases', 'patients.disease_code', '=', 'diseases.disease_code')
            ->select('patients.id', 'no_rm', 'treatment_type', 'name', 'birthday', 'gender', 'patients.disease_code', 'domicile',
                'patient_type', 'entry_date', 'exit_date', 'payment_type', 'release_note', 'diseases.disease_name')
            ->get();
        $listOfDiseases = null;
        return view('recaps.dataKesakitanExport');
    }
}
