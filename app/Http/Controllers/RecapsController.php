<?php

namespace App\Http\Controllers;

use App\Exports\PatientsExport;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RecapsController extends Controller
{
    public function dataKesakitan()
    {
        return view('recaps.dataKesakitan');
        //return "asd";
    }

    public function topTen()
    {
        return view('recaps.topTen');
    }

    public function exportPatient()
    {
        return Excel::download(new PatientsExport, 'patients.xlsx');
    }

    public function checkQuery()
    {
        $listOfDiseases = DB::table('patients')
            ->select('disease_code')
            ->distinct('disease_code')
            ->get();

        for ($i = 0; $i < count($listOfDiseases); $i++) {
            $result[$i][0] = DB::table('patients')
                ->where('disease_code', $listOfDiseases[$i]->disease_code)
                ->count();

            $result[$i][1] = DB::table('patients')
                ->where('disease_code', $listOfDiseases[$i]->disease_code)
                ->where([['gender', 'Laki-Laki'], ['patient_type', 'Baru']])
                ->count();
            $result[$i][2] = DB::table('patients')
                ->where('disease_code', $listOfDiseases[$i]->disease_code)
                ->where([['gender', 'Laki-Laki'], ['patient_type', 'Lama']])
                ->count();
            $result[$i][3] = DB::table('patients')
                ->where('disease_code', $listOfDiseases[$i]->disease_code)
                ->where([['gender', 'Perempuan'], ['patient_type', 'Baru']])
                ->count();
            $result[$i][4] = DB::table('patients')
                ->where('disease_code', $listOfDiseases[$i]->disease_code)
                ->where([['gender', 'Perempuan'], ['patient_type', 'Lama']])
                ->count();

            for ($j = 5; $j < 73; $j += 4) {
                $result[$i][$j] = DB::table('patients')
                    ->where('disease_code', $listOfDiseases[$i]->disease_code)
                    ->where([['gender', 'Laki-Laki'], ['patient_type', 'Baru'],['age_class',(($j-5)/4)]])
                    ->count();
                $result[$i][$j + 1] = DB::table('patients')
                    ->where('disease_code', $listOfDiseases[$i]->disease_code)
                    ->where([['gender', 'Laki-Laki'], ['patient_type', 'Lama'],['age_class',(($j-5)/4)]])
                    ->count();
                $result[$i][$j + 2] = DB::table('patients')
                    ->where('disease_code', $listOfDiseases[$i]->disease_code)
                    ->where([['gender', 'Perempuan'], ['patient_type', 'Baru'],['age_class',(($j-5)/4)]])
                    ->count();
                $result[$i][$j + 3] = DB::table('patients')
                    ->where('disease_code', $listOfDiseases[$i]->disease_code)
                    ->where([['gender', 'Perempuan'], ['patient_type', 'Lama'],['age_class',(($j-5)/4)]])
                    ->count();
            }
        }

        return compact('listOfDiseases', 'result');
    }
}
