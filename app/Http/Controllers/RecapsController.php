<?php

namespace App\Http\Controllers;

use App\Exports\DiseaseCountRecapsExport;
use App\Exports\TreatmentRegistrationsExport;
use App\Exports\TopTensExport;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RecapsController extends Controller
{
    //REGISTRASI RAWAT INAP FUNCTIONS
    public function treatmentRegistrationRedirect(Request $request){
        return $this->treatmentRegistration($request->year,$request->month);
    }

    public function treatmentRegistrationExport(Request $request){
        $year = $request->year;
        $month = $request->month;
        
        if (!$year || !$month) {
            $year = date('Y');
            $month = date('n');
        }

        switch ($month) {
            case '1': $titleMonth = "Januari"; break;
            case '2': $titleMonth = "Februari"; break;
            case '3': $titleMonth = "Maret"; break;
            case '4': $titleMonth = "April"; break;
            case '5': $titleMonth = "Mei"; break;
            case '6': $titleMonth = "Juni"; break;
            case '7': $titleMonth = "Juli"; break;
            case '8': $titleMonth = "Agustus"; break;
            case '9': $titleMonth = "September"; break;
            case '10': $titleMonth = "Oktober"; break;
            case '11': $titleMonth = "November"; break;
            case '12': $titleMonth = "Desember"; break;
            default: $titleMonth = ""; break;
        }
        
        return (new TreatmentRegistrationsExport($year, $month))->download('Register Rawat Inap Tahun '.$year.' Bulan '.$titleMonth.'.xlsx');
    }

    public function treatmentRegistration($year = null, $month = null){

        if (!$year || !$month) {
            $year = date('Y');
            $month = date('n');
        }

        $option['first'] = (DB::table('patients')
                ->select(DB::raw('EXTRACT(YEAR FROM exit_date) as first'))
                ->orderBy('first', 'asc')
                ->limit(1)
                ->pluck('first'))[0];

        $option['last'] = (DB::table('patients')
                ->select(DB::raw('EXTRACT(YEAR FROM exit_date) as last'))
                ->orderBy('last', 'desc')
                ->limit(1)
                ->pluck('last'))[0];

        $patients = DB::table('patients')
            ->leftJoin('diseases', 'patients.disease_code', '=', 'diseases.disease_code')
            ->select('patients.id', 'no_rm', 'treatment_type', 'name', 'birthday', 'age', 'gender', 'patients.disease_code', 'domicile',
                'patient_type', 'entry_date', 'exit_date', 'payment_type', 'release_note', 'diseases.disease_name',
                DB::raw('DATEDIFF(exit_date,entry_date) as duration'))
            ->whereYear('exit_date', $year)
            ->whereMonth('exit_date', $month)
            ->paginate(10);
        //->get();

        foreach ($patients as $patient) {
            if ($patient->duration < 1) {
                $patient->duration = 1;
            }

        }
        //return $patients;
        return view('patients.index', compact('patients','option','year','month'));
    }
    //DATA KESAKITAN FUNCTIONS
    public function dataKesakitan()
    {
        $years[0] = DB::table('patients')
            ->select(DB::raw('extract(year from exit_date) as year'))
            ->orderBy('exit_date', 'asc')
            ->first();
        $years[1] = DB::table('patients')
            ->select(DB::raw('extract(year from exit_date) as year'))
            ->orderBy('exit_date', 'desc')
            ->first();

        return view('recaps.dataKesakitan', compact('years'));
    }

    public function downloadCountRecap(Request $request)
    {
        $year = $request->year;
        $months = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        if ($request->month_jan) {$months[0] = 1;}
        if ($request->month_feb) {$months[1] = 1;}
        if ($request->month_mar) {$months[2] = 1;}
        if ($request->month_apr) {$months[3] = 1;}
        if ($request->month_may) {$months[4] = 1;}
        if ($request->month_jun) {$months[5] = 1;}
        if ($request->month_jul) {$months[6] = 1;}
        if ($request->month_aug) {$months[7] = 1;}
        if ($request->month_sep) {$months[8] = 1;}
        if ($request->month_oct) {$months[9] = 1;}
        if ($request->month_nov) {$months[10] = 1;}
        if ($request->month_dec) {$months[11] = 1;}

        return (new DiseaseCountRecapsExport($year, $months))->download('Rekap Data Kesakitan Tahun ' . $year . '.xlsx');
        //return compact('year', 'months');
    }

    //TOP TEN FUNCTIONS
    public function topTenExport(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        
        if (!$year || !$month) {
            $year = date('Y');
            $month = date('n');
        }

        switch ($month) {
            case '1': $titleMonth = "Januari"; break;
            case '2': $titleMonth = "Februari"; break;
            case '3': $titleMonth = "Maret"; break;
            case '4': $titleMonth = "April"; break;
            case '5': $titleMonth = "Mei"; break;
            case '6': $titleMonth = "Juni"; break;
            case '7': $titleMonth = "Juli"; break;
            case '8': $titleMonth = "Agustus"; break;
            case '9': $titleMonth = "September"; break;
            case '10': $titleMonth = "Oktober"; break;
            case '11': $titleMonth = "November"; break;
            case '12': $titleMonth = "Desember"; break;
            default: $titleMonth = ""; break;
        }
        //return $request;
        return (new TopTensExport($year, $month))->download('Sepuluh Besar Penyakit Tahun '.$year.' Bulan '.$titleMonth.'.xlsx');
    }

    public function topTenRedirect(Request $request)
    {
        return $this->topTen($request->year, $request->month);
    }

    public function topTen($year = false, $month = false)
    {
        if (!$year || !$month) {
            $year = date('Y');
            $month = date('n');
        }

        $option['first'] = (DB::table('patients')
                ->select(DB::raw('EXTRACT(YEAR FROM exit_date) as first'))
                ->orderBy('first', 'asc')
                ->limit(1)
                ->pluck('first'))[0];

        $option['last'] = (DB::table('patients')
                ->select(DB::raw('EXTRACT(YEAR FROM exit_date) as last'))
                ->orderBy('last', 'desc')
                ->limit(1)
                ->pluck('last'))[0];

        $result['count'] = DB::table('patients')
            ->select(DB::raw('count(name) as total'), 'disease_code as code')
            ->whereYear('exit_date', $year)
            ->whereMonth('exit_date', $month)
            ->groupBy('code')
            ->orderBy('total', 'desc')
            ->get();

        for ($i = 0; $i < count($result['count']); $i++) {
            $result['count'][$i]->name = (DB::table('diseases')
                    ->select('disease_name')
                    ->where('disease_code', $result['count'][$i]->code)
                    ->pluck('disease_name'))[0];

            $result['count'][$i]->alive_male = (DB::table('patients')
                    ->select(DB::raw('count(name) as count'))
                    ->where([
                        ['gender', 'Laki-Laki'],
                        ['disease_code', $result['count'][$i]->code],
                    ])
                    ->where(function ($query) {
                        $query->where('release_note', 'Pulang')->orWhere('release_note', 'Dirujuk');
                    })
                    ->whereYear('exit_date', $year)
                    ->whereMonth('exit_date', $month)
                    ->get())[0]->count;

            $result['count'][$i]->alive_female = (DB::table('patients')
                    ->select(DB::raw('count(name) as count'))
                    ->where([
                        ['gender', 'Perempuan'],
                        ['disease_code', $result['count'][$i]->code],
                    ])
                    ->where(function ($query) {
                        $query->where('release_note', 'Pulang')->orWhere('release_note', 'Dirujuk');
                    })
                    ->whereYear('exit_date', $year)
                    ->whereMonth('exit_date', $month)
                    ->get())[0]->count;

            $result['count'][$i]->deceased_male = (DB::table('patients')
                    ->select(DB::raw('count(name) as count'))
                    ->where([
                        ['gender', 'Laki-Laki'],
                        ['disease_code', $result['count'][$i]->code],
                        ['release_note', 'like', 'Meninggal%'],
                    ])
                    ->whereYear('exit_date', $year)
                    ->whereMonth('exit_date', $month)
                    ->get())[0]->count;
            $result['count'][$i]->deceased_female = (DB::table('patients')
                    ->select(DB::raw('count(name) as count'))
                    ->where([
                        ['gender', 'Perempuan'],
                        ['disease_code', $result['count'][$i]->code],
                        ['release_note', 'like', 'Meninggal%'],
                    ])
                    ->whereYear('exit_date', $year)
                    ->whereMonth('exit_date', $month)
                    ->get())[0]->count;
        }
        $disease_count = count($result['count']);
        if ($disease_count > 10) {
            $disease_count = 10;
        }

        //return $request;
        return view('recaps.topTen', compact('result', 'disease_count', 'option', 'request', 'year', 'month'));
    }

    //MBUH FUNCTIONS
    public function exportPatient()
    {
        return Excel::download(new DiseaseCountRecapsExport, 'patients.xlsx');
    }

    public function requestSandbox(Request $request)
    {
        return $request;
    }

    public function querySandbox()
    {
        $query = DB::table('patients')
            ->select('birthday')
            ->whereYear('birthday', '2018')
            ->whereMonth('birthday', '10')
            ->get();

        return compact('query');
    }
}
