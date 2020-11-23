<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Exports\SglisampleExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use App\Summarizeinumsample;
use App\Institutions;
use App\Species;
use App\Specimen;
use App\Pathogen;
use Carbon\Carbon;
use Session;

class SummarizeIsolateNumericSampleController extends Controller
{
    public function view()
    {
        $summarizeinumsample = Summarizeinumsample::get();
       
        return view('summarizeinumsample.view',compact('summarizeinumsample'));
    }

    public function create()
    {
              $institution = Institutions::get();
              $species = Species::get();
              $specimen = Specimen::get();
              $pathogen = Pathogen::orderBy('pathogen_name','asc')->get();

      return view('summarizeinumsample.create',compact('institution','species','specimen','pathogen'));
    }

	public function store(Request $request)
	{
        
        $user = Auth::user();
        $current_time = Carbon::now();
     

        $store=DB::table('summarizeinumsamples')->insert([ 'test_date_from' => $request->test_date_from,'test_date_to' => $request->test_date_to,'institution_id' => $request->institution,  
            'species_id'=>$request->species, 'specimen_id'=>$request->specimen, 'pathogen_id'=>$request->pathogen,'created_by' => $user->id, 'created_at' => $current_time]);

        //'no_of_isolate_tested'=>$request->number_of_isolate_tested, 'sensitivity_pattern'=>$request->sensitivity_pattern,

        $lastId= DB::getPdo()->lastInsertId();

        //return redirect('/summarizeinumsample/view');



       return redirect('/summarizeinumsampletest/create/'.$lastId);


       
    }









}
