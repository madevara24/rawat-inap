<?php

namespace App\Exports;

use App\Exports\TreatmentRecapsMonthlyExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TreatmentRecapsExport implements WithMultipleSheets
{
    use Exportable;

    protected $year;
    protected $months;

    public function __construct(int $year, array $months)
    {
        $this->year = $year;
        $this->months = $months;
    }

    public function sheets(): array
    {
        $sheets = [];

        for ($i = 0; $i < 12; $i++) {
            if ($this->months[$i] == 1) {
                $sheets[] = new TreatmentRecapsMonthlyExport($this->year, $i + 1);
            }
        }
        return $sheets;
    }
}
