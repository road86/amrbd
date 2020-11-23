<?php

namespace App\Exports;

use App\Antibiotic;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AntibioticsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Antibiotic::all();
       
       // Antibiotic return in sorting order ascending by name

      return  $antibiotic = Antibiotic::orderBy('antibiotic_name', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'User',
            'created_at',
            'updated_at'
        ];
    }
}
