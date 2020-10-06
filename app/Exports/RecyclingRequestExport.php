<?php

namespace App\Exports;

use App\RecyclingRequest;
use Maatwebsite\Excel\Concerns\FromCollection;

class RecyclingRequestExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RecyclingRequest::all();
    }
}
