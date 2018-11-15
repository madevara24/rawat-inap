<?php

namespace App\Http\Controllers;

use App\Exports\DiseaseCountRecapsExport;
use App\Exports\TreatmentRegistrationsExport;
use App\Exports\TopTensExport;
use App\Exports\TreatmentRecapsExport;
use App\Disease;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Faker\Factory as Faker;

class RecapsController extends Controller
{
    //PELAYANAN PERAWATAN FUNCTIONS
    public function treatmentRecaps(){
        $years[0] = DB::table('patients')
            ->select(DB::raw('extract(year from exit_date) as year'))
            ->orderBy('exit_date', 'asc')
            ->first();
        $years[1] = DB::table('patients')
            ->select(DB::raw('extract(year from exit_date) as year'))
            ->orderBy('exit_date', 'desc')
            ->first();

        return view('recaps.treatmentRecaps', compact('years'));
    }

    public function treatmentRecapsExport(Request $request){
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

        return (new TreatmentRecapsExport($year, $months))->download('Rekap Pelayanan Perawatan Tahun ' . $year . '.xlsx');
    }
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

        if((DB::table('patients')->select(DB::raw('count(id) as count'))->pluck('count'))[0] < 1){
            $diseases = Disease::all();
            return view('patients.create', compact('diseases'))->with('success', 'Data pasien masih kosong, mohon diisi dahulu');
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
            //->paginate(10);
            ->get();

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
    public function topTenChart(){
        $thisMonth = DB::table('patients')
            ->select(DB::raw('count(name) as total'), 'disease_code as code')
            ->whereYear('exit_date', now())
            ->whereMonth('exit_date', now())
            ->groupBy('code')
            ->orderBy('total', 'desc')
            ->get();

        for ($i = 0; $i < count($thisMonth); $i++) {
            $thisMonth[$i]->name = (DB::table('diseases')
                ->select('disease_name')
                ->where('disease_code', $thisMonth[$i]->code)
                ->pluck('disease_name'))[0];
        }

        $prevMonth = DB::table('patients')
            ->select(DB::raw('count(name) as total'), 'disease_code as code')
            ->whereYear('exit_date', date("Y", strtotime("first day of previous month")))
            ->whereMonth('exit_date', date("m", strtotime("first day of previous month")))
            ->groupBy('code')
            ->orderBy('total', 'desc')
            ->get();

        for ($i = 0; $i < count($prevMonth); $i++) {
            $prevMonth[$i]->name = (DB::table('diseases')
                ->select('disease_name')
                ->where('disease_code', $prevMonth[$i]->code)
                ->pluck('disease_name'))[0];
        }
        $disease_count[0] = count($thisMonth);
        $disease_count[1] = count($prevMonth);

        $monthsName[0] = date("F", strtotime("first day of previous month"));
        $monthsName[1] = date("F");
        //var_dump($monthsName);
        return view('recaps.topTenChart', compact('thisMonth','prevMonth','disease_count','monthsName'));
    }
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

    //MISC FUNCTIONS
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
        
    }

    private function createFakePatient(array $diseases){
        $faker = Faker::create('App/Patient');
        
        $result['no_rm'] = $faker->ean8();
        $result['gender'] = $faker->randomElement($array = array ('Laki-Laki','Perempuan'));
        $result['birthday'] = $faker->dateTimeBetween($startDate = '-60 years', $endDate = 'now', $timezone = null);
        $result['disease_code'] = $faker->randomElement($array = $diseases);
        $result['domicile'] = $faker->randomElement($array = array ('DW','LW'));
        $result['patient_type'] = $faker->randomElement($array = array ('Lama','Baru'));
        $result['payment_type'] = $faker->randomElement($array = array ('UM','ASK','JAMKESMAS','JAMKESDA','BPJS','KIS','SPM'));
        $result['age'] = date_diff($result['birthday'],date_create())->y;
        $result['entry_date'] = $faker->dateTimeBetween($startDate = '2018-01-01', $endDate = '2018-01-31', $timezone = null);
        $result['exit_date'] = $faker->dateTimeBetween($startDate = $result['entry_date'], $endDate = '2018-02-10', $timezone = null);
        
        if($result['gender'] == 'Laki-Laki' || $result['age'] < 18 || $result['age'] > 40)
            $result['treatment_type'] = 'Umum';
        else
            $result['treatment_type'] = $faker->randomElement($array = array ('Umum','Persalinan'));
        
        if($result['gender'] == 'Laki-Laki')
            $result['name'] = $faker->firstNameMale()." ".$faker->lastName();
        else
            $result['name'] = $faker->firstNameFemale()." ".$faker->lastName();
        
        if(date_diff($result['entry_date'],$result['exit_date'])->m==0 && date_diff($result['entry_date'],$result['exit_date'])->d<3)
            $result['release_note'] = $faker->randomElement($array = array ('Pulang','Dirujuk','Meninggal < 48 jam'));
        else
            $result['release_note'] = $faker->randomElement($array = array ('Pulang','Dirujuk','Meninggal > 48 jam'));
        
        $result['age_class'] = $this->getAgeClass($result['birthday'],$result['exit_date']);

        return $result;
    }

    private function getAgeClass($birthday,$exitDate){
        $diff=date_diff($birthday,$exitDate);
        if($diff->y == 0){
            if ($diff->m == 0) {
                if($diff->d < 8)
                    return 0;
                else if($diff->d < 29)
                    return 1;
                else
                    return 2;
            }else
                return 2;
        }else if($diff->y < 4)
            return 3;
        else if($diff->y < 6)
            return 4;
        else if($diff->y < 10)
            return 5;
        else if($diff->y < 12)
            return 6;
        else if($diff->y < 15)
            return 7;
        else if($diff->y < 18)
            return 8;
        else if($diff->y < 20)
            return 9;
        else if($diff->y < 25)
            return 10;
        else if($diff->y < 35)
            return 11;
        else if($diff->y < 45)
            return 12;
        else if($diff->y < 55)
            return 13;
        else if($diff->y < 60)
            return 14;
        else if($diff->y < 65)
            return 15;
        else if($diff->y < 70)
            return 16;
        else
            return 17;   
    }
}
