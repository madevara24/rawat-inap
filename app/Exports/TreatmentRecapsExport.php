<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class TreatmentRecapsExport implements FromView, WithTitle
{
    use Exportable;
    public function __construct(int $year, int $month)
    {
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * @return Builder
     */
    public function view(): View
    {
        $result[0][0] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Umum'],
                    ['age', '<=', '55'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;

        $result[0][1] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Umum'],
                    ['age', '>', '55'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;

        $result[0][2] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Umum'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;

        $result[0][3] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Persalinan'],
                    ['age', '<=', '55'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;

        $result[0][4] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Persalinan'],
                    ['age', '>', '55'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;

        $result[0][5] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Persalinan'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;
        
        $result[0][5] = (DB::table('patients')
                ->select(DB::raw('count(id) as sum'))
                ->where([
                    ['treatment_type', 'Persalinan'],
                    ['patient_type', 'Lama'],
                    ['domicile', 'DW'],
                    ['gender', 'Laki-Laki'],
                ])
                ->whereYear('exit_date', $this->year)
                ->whereMonth('exit_date', $this->month)
                ->get())[0]->sum;

        //return $patients;
        return view('recaps.treatmentRecapsExport', compact('patients', 'year', 'month'));
    }

    public function title(): string
    {
        $titleMonth = "";
        switch ($this->month) {
            case '1':$titleMonth = "Januari";
                break;
            case '2':$titleMonth = "Februari";
                break;
            case '3':$titleMonth = "Maret";
                break;
            case '4':$titleMonth = "April";
                break;
            case '5':$titleMonth = "Mei";
                break;
            case '6':$titleMonth = "Juni";
                break;
            case '7':$titleMonth = "Juli";
                break;
            case '8':$titleMonth = "Agustus";
                break;
            case '9':$titleMonth = "September";
                break;
            case '10':$titleMonth = "Oktober";
                break;
            case '11':$titleMonth = "November";
                break;
            case '12':$titleMonth = "Desember";
                break;
            default:$titleMonth = "";
                break;
        }

        return "Pelayanan Perawatan " . $titleMonth . " " . $this->year;
    }
}
