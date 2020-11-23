<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Sglizdissample;
use App\Sglizdissampletest;
use App\Samples;
use App\Institutions;
use App\Species;
use App\Breed;
use App\Specimen;
use App\Testmethod;
use App\Pathogen;
use App\Antibiotic;
use App\Specimencollectionlocation;
use App\Testsensitivitie;
use App\zdispathogen;
use Carbon\Carbon;
use Session;

class SingleIsolateZdisSampleTestController extends Controller
{
  public function __construct()
    {                                        
       $this->middleware('auth');
    }
   
    public function view()
    {
      $sglizdissample = Sglizdissample::get();
      $sglizdissampletest = Sglizdissampletest::get();
      $pathogen = Pathogen::get();
      $antibiotic = Antibiotic::get();
        
       return view('singleisolatezdissampletest.view',compact('sglizdissampletest','sglizdissample','pathogen','antibiotic'));
    }

  public function create($id)
    {
        $sglizdissample = Sglizdissample::get();
    	  $sglizdissampletest = Sglizdissampletest::get();
        $pathogen = Pathogen::get();
        $antibiotic = Antibiotic::orderBy('antibiotic_name', 'asc')->get();
        $zdispathogen = Zdispathogen::get();
        $sampleDetails = Sglizdissample::where('sample_id',$id)->first();

        return view('singleisolatezdissampletest.create',compact('sglizdissample','sglizdissampletest','pathogen','antibiotic','zdispathogen','sampleDetails'));
    }


	public function store(Request $request) 
    {
        $user = Auth::user();
        $current_time = Carbon::now();


        foreach($request->antibiotics as $row=>$val)
          {
            $zdistable = Zdispathogen::where([['pathogen_id',$request->pathogen_id],['antibiotic_id',$request->antibiotics[$row]]])->first();
            if (!$zdistable ) {


              Session::flash('message', 'Reference value for antibiotic is not availavle in ZDIS table!! Please look at ZDIS Reference Table');
              return redirect()->back();
            }

          }


        foreach($request->antibiotics as $row=>$val)
          {
            $zdistable = Zdispathogen::where([['pathogen_id',$request->pathogen_id],['antibiotic_id',$request->antibiotics[$row]]])->first();

            if ($zdistable) {
              if ($request->zdis_mm[$val]>=$zdistable->sensitive_mm) {
              $testsensitivity=1;
              }
              elseif ($request->zdis_mm[$val]<=$zdistable->resistance_mm) {
                $testsensitivity=3;
              }
              else{
                $testsensitivity=2;
              }
            }
            // else{
            //   Session::flash('message', 'Data is not Availavle!! Please look at ZDIS Reference Table');
            //   return redirect()->back();
            // }

            

            DB::table('sglizdissampletests')->insert(['sample_id' => $request->sample_id, 
            'pathogen_id' => $request->pathogen_id, 'antibiotic_id'=>$request->antibiotics[$row],'zdis_mm'=>$request->zdis_mm[$val], 'test_sensitivity_id'=>$testsensitivity,  'created_by' => $user->id, 'created_at' => $current_time]);
          }

        return redirect('/singleisolatezdissampletest/view');
     }

      public function DeleteSingleIsolateZDISSampleTestID($id)
    {
       
      $sglisolatezdissampletestid = Sglizdissampletest::find($id);
     
      if($sglisolatezdissampletestid->delete()) {
        Session::flash('message', 'Single Isolate ZDIS Sample Test ID is Deleted from the Record!');

      return redirect('/singleisolatezdissampletest/view');
      }
    }

}
