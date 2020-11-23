<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\SglisampleExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use App\Summarizeipersample;
use App\Summarizeipersampletest;
use App\Pathogen;
use App\Antibiotic;
use Carbon\Carbon;
use Session;

class SummarizeIsolatePercentSampleTestController extends Controller
{
    public function view()
    {
    
      $summarizeipersampletest = Summarizeipersampletest::get();
         
        
       return view('summarizeipersampletest.view',compact('summarizeipersampletest'));
    }

  public function create($id)
    {
        
        $summarizeipersample = Summarizeipersample::get();
    	$summarizeipersampletest = Summarizeipersampletest::get();
        $pathogen = Pathogen::get();
        $antibiotic = Antibiotic::orderBy('antibiotic_name', 'asc')->get();
        $sampleDetails = Summarizeipersample::where('sample_id',$id)->first();

        return view('summarizeipersampletest.create',compact('summarizeipersample','summarizeipersampletest','pathogen','antibiotic','sampleDetails'));
    }


	 public function store(Request $request) 
    {
        $user = Auth::user();
        $current_time = Carbon::now();

        foreach($request->antibiotics as $row=>$val)
          {
        
				    DB::table('summarizeipersampletests')->insert(['sample_id' => $request->sample_id, 
            'pathogen_id' => $request->pathogen_id, 'antibiotic_id'=>$request->antibiotics[$row],
            'test_result_percent'=>$request->test_result_percent[$val],'created_by' => $user->id, 'created_at' => $current_time]);
          }

        return redirect('/summarizeipersampletest/view');
    }
}


