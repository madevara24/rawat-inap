<?php

namespace App\Exports;

use App\Patient;
use Maatwebsite\Excel\Concerns\FromCollection;

class PatientsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Patient::all();
    }
}
