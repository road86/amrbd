<?php

namespace App\Exports;

use App\Sglizdissampletest;
use Maatwebsite\Excel\Concerns\FromCollection;

class SglizdissampletestsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sglizdissampletest::all();
    }
}
