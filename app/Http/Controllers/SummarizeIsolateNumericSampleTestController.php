<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\SglisampleExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use App\Summarizeinumsample;
use App\Summarizeinumsampletest;
use App\Pathogen;
use App\Antibiotic;
use Carbon\Carbon;
use Session;

class SummarizeIsolateNumericSampleTestController extends Controller
{
    public function view()
    {
    
      $summarizeinumsampletest = Summarizeinumsampletest::get();
     // $pathogen = Pathogen::get();
     // $antibiotic = Antibiotic::get();
      
        
       return view('summarizeinumsampletest.view',compact('summarizeinumsampletest'));
    }

  public function create($id)
    {
        $summarizeinumsample = Summarizeinumsample::get();
    	  $summarizeinumsampletest = Summarizeinumsampletest::get();
        $pathogen = Pathogen::get();
        $antibiotic = Antibiotic::orderBy('antibiotic_name', 'asc')->get();
        $sampleDetails = Summarizeinumsample::where('sample_id',$id)->first();

        return view('summarizeinumsampletest.create',compact('summarizeinumsample','summarizeinumsampletest','pathogen','antibiotic','sampleDetails'));
    }


	 public function store(Request $request) 
    {
        $user = Auth::user();
        $current_time = Carbon::now();

        //dd($request);

        foreach($request->antibiotics as $row=>$val)
          {

                $sensitive = $request->total_num_of_samples[$val] - $request->test_result_num_resistance[$val] - $request->test_result_num_intermediate[$val];

           // dd($request->total_num_of_samples[$val]);

                // dd($sensitive);
        
				  DB::table('summarizeinumsampletests')->insert(['sample_id' => $request->sample_id, 
            'pathogen_id' => $request->pathogen_id, 'antibiotic_id'=>$request->antibiotics[$row],'total_num_of_samples'=>$request->total_num_of_samples[$val],'test_result_num_resistance'=>$request->test_result_num_resistance[$val],'test_result_num_intermediate'=>$request->test_result_num_intermediate[$val],'test_result_num_sensitive'=>$sensitive, 'created_by' => $user->id, 'created_at' => $current_time]);
          }

        return redirect('/summarizeinumsampletest/view');
    }
}
