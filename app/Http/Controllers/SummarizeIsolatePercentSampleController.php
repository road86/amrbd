<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\SglisampleExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use App\Summarizeipersample;
use App\Institutions;
use App\Species;
use App\Specimen;
use App\Pathogen;
use Carbon\Carbon;
use Session;

class SummarizeIsolatePercentSampleController extends Controller
{ 

	public function view()
    {
        $summarizeipersample = Summarizeipersample::get();
       
        return view('summarizeipersample.view',compact('summarizeipersample'));
    }

    public function create()
    {
             //$institution = Institutions::get();
               $institution = Institutions::orderBy('institution_name', 'asc')->get();
             //$species = Species::get();
               $species = Species::orderBy('species_name', 'asc')->get();
             //$specimen = Specimen::get();
               $specimen =  Specimen::orderBy('specimen_name', 'asc')->get();
               $pathogen = Pathogen::orderBy('pathogen_name','asc')->get();

      return view('summarizeipersample.create',compact('institution','species','specimen','pathogen'));
    }

	public function store(Request $request)
	{
        
    $user = Auth::user();
    $current_time = Carbon::now();
     
     //dd($request);

    $store=DB::table('summarizeipersamples')->insert(['test_date_from' => $request->test_date_from,'test_date_to' => $request->test_date_to,'institution_id' => $request->institution,'species_id'=>$request->species, 'specimen_id'=>$request->specimen, 'pathogen_id'=>$request->pathogen,'no_of_isolate_tested'=>$request->number_of_isolate_tested, 'sensitivity_pattern'=>$request->sensitivity_pattern, 'created_by' => $user->id, 'created_at' => $current_time]);

        $lastId= DB::getPdo()->lastInsertId();

        
       return redirect('/summarizeipersampletest/create/'.$lastId);


       
    }


}
