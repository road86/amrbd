<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Sglisample;
use App\Sglizdissample;
use App\Samples;
use App\Institutions;
use App\Species;
use App\Breed;
use App\Specimen;
use App\Testmethod;
use App\Pathogen;
use App\Specimencollectionlocation;
use Carbon\Carbon;
use Session;

class SingleIsolateZdisSampleController extends Controller
{
  public function __construct()
    {                                        
       $this->middleware('auth');
    }
    
    public function view()
    {
        $sglizdissample = Sglizdissample::get();
        return view('singleisolatezdissample.view',compact('sglizdissample'));
    }

    public function create()
    {
              $institutions = Institutions::orderBy('institution_name', 'asc')->get();
              $species = Species::orderBy('species_name', 'asc')->get();
              $breeds = Breed::get();
              $specimen = Specimen::orderBy('specimen_name', 'asc')->get();
              $specimencollectionlocation = Specimencollectionlocation::orderBy('specimen_location_name', 'asc')->get();
              $testmethod = Testmethod::get();
              $pathogen = Pathogen::orderBy('pathogen_name', 'asc')->get();
              

           return view('singleisolatezdissample.create',compact('institutions','species','breeds','specimen','specimencollectionlocation','testmethod','pathogen'));
    }


      public function store(Request $request) {
        
        $user = Auth::user();
        $current_time = Carbon::now();
    

        $store=DB::table('sglizdissamples')->insert(['test_date' => $request->test_date, 
            'institution_id' => $request->institutions, 'species_id'=>$request->species, 'breed_id'=>$request->breeds, 'specimen_id'=>$request->specimen, 'specimen_location_id'=>$request->specimencollectionlocation, 'test_method_id'=>$request->testmethods, 'pathogen_id'=>$request->pathogen, 'created_by' => $user->id, 'created_at' => $current_time]);

        $lastId= DB::getPdo()->lastInsertId();

        return redirect('/singleisolatezdissampletest/create/'.$lastId);
         
       }

    public function DeleteSingleIsolateZDISSampleID($id)
    {
       
      $sglisolatezdissampleid = Sglizdissample::find($id);
     
      if($sglisolatezdissampleid->delete()) {
        Session::flash('message', 'Single Isolate ZDIS Sample ID is Deleted from the Record!');

      return redirect('/singleisolatezdissample/view');
      }
    }



}
