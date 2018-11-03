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
            ->leftJoin('diseases', 'patients.disease_code', '=', 'diseases.disease_code')
            ->select('patients.disease_code','diseases.disease_name')
            ->distinct('patients.disease_code')
            ->get();
            

        for ($i = 0; $i < count($listOfDiseases); $i++) {
            $totals[$i] = DB::table('patients')
                ->where('disease_code', $listOfDiseases[$i]->disease_code)
                ->count();

            $results[$i][0][0] = DB::table('patients')
                ->where('disease_code', $listOfDiseases[$i]->disease_code)
                ->where([['gender', 'Laki-Laki'], ['patient_type', 'Baru']])
                ->count();
            $results[$i][0][1] = DB::table('patients')
                ->where('disease_code', $listOfDiseases[$i]->disease_code)
                ->where([['gender', 'Laki-Laki'], ['patient_type', 'Lama']])
                ->count();
            $results[$i][0][2] = DB::table('patients')
                ->where('disease_code', $listOfDiseases[$i]->disease_code)
                ->where([['gender', 'Perempuan'], ['patient_type', 'Baru']])
                ->count();
            $results[$i][0][3] = DB::table('patients')
                ->where('disease_code', $listOfDiseases[$i]->disease_code)
                ->where([['gender', 'Perempuan'], ['patient_type', 'Lama']])
                ->count();

            for ($j = 0; $j < 18; $j ++) {
                $results[$i][$j+1][0] = DB::table('patients')
                    ->where('disease_code', $listOfDiseases[$i]->disease_code)
                    ->where([['gender', 'Laki-Laki'], ['patient_type', 'Baru'],['age_class',$j]])
                    ->count();
                $results[$i][$j+1][1] = DB::table('patients')
                    ->where('disease_code', $listOfDiseases[$i]->disease_code)
                    ->where([['gender', 'Laki-Laki'], ['patient_type', 'Lama'],['age_class',$j]])
                    ->count();
                $results[$i][$j+1][2] = DB::table('patients')
                    ->where('disease_code', $listOfDiseases[$i]->disease_code)
                    ->where([['gender', 'Perempuan'], ['patient_type', 'Baru'],['age_class',$j]])
                    ->count();
                $results[$i][$j+1][3] = DB::table('patients')
                    ->where('disease_code', $listOfDiseases[$i]->disease_code)
                    ->where([['gender', 'Perempuan'], ['patient_type', 'Lama'],['age_class',$j]])
                    ->count();
            }
        }

        return compact('listOfDiseases','totals', 'results');
    }
}
