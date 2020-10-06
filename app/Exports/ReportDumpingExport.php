<?php

namespace App\Exports;

use App\ReportDumping;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportDumpingExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ReportDumping::all();
    }
}
