<?php

namespace App\Exports;

use App\Sglisample;
use App\Sglisampletest;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// for applying style sheet
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SglisampleExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return $sglisample = Sglisample::with('sglisampletest')->get();
    //     //echo '<pre>'.print_r($sglisample, true).'</pre>';exit;
    // }

    public function view(): View
        {
            $sglisample = Sglisample::with('sglisampletest', 'institutions', 'species','breed','specimen','specimencollectionlocation','testmethod','pathogen')->get();
            //echo '<pre>'.print_r($sglisample, true).'</pre>';exit;
            return view('singleisolatesample.sglisample_excel', ['sglisample' => $sglisample]);
    }
}
