<?php

namespace App\Exports;

use App\Sglisampletest;
use Maatwebsite\Excel\Concerns\FromCollection;

class SglisampletestsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sglisampletest::all();
    }
}
