<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\DB;

class TreatmentRecapsMonthlyExport implements FromView, WithTitle
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
    private function countQueryBuilder($patientType,$domicile,$gender,$paymentType, $release, $year, $month){
        $releaseTypeA = $releaseTypeB = '';
        if($release == 0){
            $releaseTypeA = $releaseTypeB = '';
        }
        else if ($release == 1) {
            $releaseTypeA = 'Pulang';
            $releaseTypeB = 'Dirujuk';
        }
        else if ($release == 2) {
            $releaseTypeA = $releaseTypeB = '<';
        }
        elseif ($release == 3) {
            $releaseTypeA = $releaseTypeB = '>';
        }

        $result[0] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['treatment_type', 'Umum'],
                ['age', '<=', '55'],
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->where(function ($query) use($releaseTypeA, $releaseTypeB) {
                $query->where('release_note', 'like', '%'.$releaseTypeA.'%')->orWhere('release_note', 'like', '%'.$releaseTypeB.'%');
            })
            ->whereYear('exit_date', $year)
            ->whereMonth('exit_date', $month)
            ->get())[0]->sum;

        $result[1] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['treatment_type', 'Umum'],
                ['age', '>', '55'],
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->where(function ($query) use($releaseTypeA, $releaseTypeB){
                $query->where('release_note', 'like', '%'.$releaseTypeA.'%')->orWhere('release_note', 'like', '%'.$releaseTypeB.'%');
            })
            ->whereYear('exit_date', $year)
            ->whereMonth('exit_date', $month)
            ->get())[0]->sum;

        $result[2] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['treatment_type', 'Umum'],
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->where(function ($query) use($releaseTypeA, $releaseTypeB){
                $query->where('release_note', 'like', '%'.$releaseTypeA.'%')->orWhere('release_note', 'like', '%'.$releaseTypeB.'%');
            })
            ->whereYear('exit_date', $year)
            ->whereMonth('exit_date', $month)
            ->get())[0]->sum;

        $result[3] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['treatment_type', 'Persalinan'],
                ['age', '<=', '55'],
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->where(function ($query) use($releaseTypeA, $releaseTypeB){
                $query->where('release_note', 'like', '%'.$releaseTypeA.'%')->orWhere('release_note', 'like', '%'.$releaseTypeB.'%');
            })
            ->whereYear('exit_date', $year)
            ->whereMonth('exit_date', $month)
            ->get())[0]->sum;

        $result[4] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['treatment_type', 'Persalinan'],
                ['age', '>', '55'],
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->where(function ($query) use($releaseTypeA, $releaseTypeB){
                $query->where('release_note', 'like', '%'.$releaseTypeA.'%')->orWhere('release_note', 'like', '%'.$releaseTypeB.'%');
            })
            ->whereYear('exit_date', $year)
            ->whereMonth('exit_date', $month)
            ->get())[0]->sum;

        $result[5] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['treatment_type', 'Persalinan'],
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->where(function ($query) use($releaseTypeA, $releaseTypeB){
                $query->where('release_note', 'like', '%'.$releaseTypeA.'%')->orWhere('release_note', 'like', '%'.$releaseTypeB.'%');
            })
            ->whereYear('exit_date', $year)
            ->whereMonth('exit_date', $month)
            ->get())[0]->sum;

        $result[6] = (DB::table('patients')
            ->select(DB::raw('count(id) as sum'))
            ->where([
                ['patient_type', 'like', '%'.$patientType.'%'],
                ['domicile', 'like', '%'.$domicile.'%'],
                ['gender', 'like', '%'.$gender.'%'],
                ['payment_type', 'like', '%'.$paymentType.'%']
            ])
            ->where(function ($query) use($releaseTypeA, $releaseTypeB){
                $query->where('release_note', 'like', '%'.$releaseTypeA.'%')->orWhere('release_note', 'like', '%'.$releaseTypeB.'%');
            })
            ->whereYear('exit_date', $year)
            ->whereMonth('exit_date', $month)
            ->get())[0]->sum;

        //var_dump($result);
        return $result;
    }

    public function view(): View
    {
        $result = array();
        $ENUM_TREATMENT_TYPE = ['Umum', 'Persalinan'];
        $ENUM_PATIENT_TYPE = ['Lama', 'Baru'];
        $ENUM_DOMICILE = ['DW', 'LW'];
        $ENUM_GENDER = ['Laki-Laki', 'Perempuan'];
        $ENUM_PAYMENT_TYPE = ['UM', 'ASK', 'JAMKESMAS', 'JAMKESDA', 'BPJS', 'KIS', 'SPM'];
        $ENUM_RELEASED_NONE = 0;
        $ENUM_RELEASED_ALIVE = 1;
        $ENUM_RELEASED_LESS_48 = 2;
        $ENUM_RELEASED_MORE_48 = 3;

        //JUMLAH PENDERITA R.I. BERDASARKAN JENIS PASIEN, DOMISILI, GENDER
        for ($i = 0; $i < count($ENUM_PATIENT_TYPE); $i++) {
            for ($j = 0; $j < count($ENUM_DOMICILE); $j++) {
                for ($k = 0; $k < count($ENUM_GENDER); $k++) {
                    array_push($result, $this->countQueryBuilder($ENUM_PATIENT_TYPE[$i], $ENUM_DOMICILE[$j], $ENUM_GENDER[$k], '', $ENUM_RELEASED_NONE, $this->year, $this->month));
                }
            }
        }

        array_push($result, $this->countQueryBuilder('', '', $ENUM_GENDER[0], '', $ENUM_RELEASED_NONE, $this->year, $this->month));
        array_push($result, $this->countQueryBuilder('', '', $ENUM_GENDER[1], '', $ENUM_RELEASED_NONE, $this->year, $this->month));

        //JUMLAH PENDERITA R.I. BERDASARKAN JENIS PEMBAYARAN, GENDER
        for ($i = 0; $i < count($ENUM_PAYMENT_TYPE); $i++) {
            for ($j = 0; $j < count($ENUM_GENDER); $j++) {
                array_push($result, $this->countQueryBuilder('', '', $ENUM_GENDER[$j], $ENUM_PAYMENT_TYPE[$i], $ENUM_RELEASED_NONE, $this->year, $this->month));
            }
        }

        array_push($result, $this->countQueryBuilder('', '', $ENUM_GENDER[0], '', $ENUM_RELEASED_NONE, $this->year, $this->month));
        array_push($result, $this->countQueryBuilder('', '', $ENUM_GENDER[1], '', $ENUM_RELEASED_NONE, $this->year, $this->month));

        //"HARI PERAWATAN"/JUMLAH PASIEN YANG DIRAWAT BERDASARKAN JENIS PEMBAYARAN, DOMISILI, GENDER
        for ($i = 0; $i < count($ENUM_PAYMENT_TYPE); $i++) {
            for ($j = 0; $j < count($ENUM_DOMICILE); $j++) {
                for ($k = 0; $k < count($ENUM_GENDER); $k++) {
                    array_push($result, $this->countQueryBuilder('', $ENUM_DOMICILE[$j], $ENUM_GENDER[$k], $ENUM_PAYMENT_TYPE[$i], $ENUM_RELEASED_NONE, $this->year, $this->month));
                }
            }
        }

        array_push($result, $this->countQueryBuilder('', '', $ENUM_GENDER[0], '', $ENUM_RELEASED_NONE, $this->year, $this->month));
        array_push($result, $this->countQueryBuilder('', '', $ENUM_GENDER[1], '', $ENUM_RELEASED_NONE, $this->year, $this->month));

        //RUJUKAN PENDERITA BERDASARKAN JENIS PEMBAYARAN, DOMISILI, GENDER
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < count($ENUM_DOMICILE); $j++) {
                for ($k = 0; $k < count($ENUM_GENDER); $k++) {
                    array_push($result, $this->countQueryBuilder('', $ENUM_DOMICILE[$j], $ENUM_GENDER[$k], $ENUM_PAYMENT_TYPE[$i], $ENUM_RELEASED_NONE, $this->year, $this->month));
                }
            }
        }

        array_push($result, $this->countQueryBuilder('', '', $ENUM_GENDER[0], '', $ENUM_RELEASED_NONE, $this->year, $this->month));
        array_push($result, $this->countQueryBuilder('', '', $ENUM_GENDER[1], '', $ENUM_RELEASED_NONE, $this->year, $this->month));

        //PASIEN PULANG BERDASARKAN DOMISILI, GENDER
        for ($i = 0; $i < count($ENUM_DOMICILE); $i++) {
            for ($j = 0; $j < count($ENUM_GENDER); $j++) {
                array_push($result, $this->countQueryBuilder('', $ENUM_DOMICILE[$i], $ENUM_GENDER[$j], '', $ENUM_RELEASED_ALIVE, $this->year, $this->month));
            }
        }

        array_push($result, $this->countQueryBuilder('', '', $ENUM_GENDER[0], '', $ENUM_RELEASED_ALIVE, $this->year, $this->month));
        array_push($result, $this->countQueryBuilder('', '', $ENUM_GENDER[1], '', $ENUM_RELEASED_ALIVE, $this->year, $this->month));

        //PASIEN MATI < 48 JAM BERDASARKAN DOMISILI, GENDER
        for ($i = 0; $i < count($ENUM_DOMICILE); $i++) {
            for ($j = 0; $j < count($ENUM_GENDER); $j++) {
                array_push($result, $this->countQueryBuilder('', $ENUM_DOMICILE[$i], $ENUM_GENDER[$j], '', $ENUM_RELEASED_LESS_48, $this->year, $this->month));
            }
        }
        //PASIEN MATI > 48 JAM BERDASARKAN DOMISILI, GENDER
        for ($i = 0; $i < count($ENUM_DOMICILE); $i++) {
            for ($j = 0; $j < count($ENUM_GENDER); $j++) {
                array_push($result, $this->countQueryBuilder('', $ENUM_DOMICILE[$i], $ENUM_GENDER[$j], '', $ENUM_RELEASED_MORE_48, $this->year, $this->month));
            }
        }

        array_push($result, $this->countQueryBuilder('', '', '', '', $ENUM_RELEASED_NONE, $this->year, $this->month));

        //return $result;
        return view('recaps.treatmentRecapsExport', compact('result'));
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

        return "Rekap Bulan " . $titleMonth;
    }
}
