<?php

namespace App\Http\Controllers;

use App\Exports\PatientsExport;
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
}
