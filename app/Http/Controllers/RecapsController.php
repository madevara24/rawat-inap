<?php

namespace App\Http\Controllers;

use App\Exports\PatientsExport;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RecapsController extends Controller
{
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

    public function topTen()
    {
        return view('recaps.topTen');
    }

    public function exportPatient()
    {
        return Excel::download(new PatientsExport, 'patients.xlsx');
    }

    public function requestSandbox(Request $request)
    {
        return $request;
    }

    public function downloadCountRecap(Request $request)
    {
        $year = $request->year;
        $months = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        if ($request->month_jan) {
            $months[0] = 1;
        }

        if ($request->month_feb) {
            $months[1] = 1;
        }

        if ($request->month_mar) {
            $months[2] = 1;
        }

        if ($request->month_apr) {
            $months[3] = 1;
        }

        if ($request->month_may) {
            $months[4] = 1;
        }

        if ($request->month_jun) {
            $months[5] = 1;
        }

        if ($request->month_jul) {
            $months[6] = 1;
        }

        if ($request->month_aug) {
            $months[7] = 1;
        }

        if ($request->month_sep) {
            $months[8] = 1;
        }

        if ($request->month_oct) {
            $months[9] = 1;
        }

        if ($request->month_nov) {
            $months[10] = 1;
        }

        if ($request->month_dec) {
            $months[11] = 1;
        }

        return (new PatientsExport($year, $months))->download('Recap.xlsx');
        return compact('year', 'months');
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
