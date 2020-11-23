<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\SglisampleExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use App\Sglisample;
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

class SingleIsolateSampleController extends Controller
{
    public function view()
    {
        $sglisample = Sglisample::get();
       //dd($sglisample);
        return view('singleisolatesample.view',compact('sglisample'));
    }

    public function create()
    {
              //$institutions = Institutions::get();
              $institutions = Institutions::orderBy('institution_name', 'asc')->get();
              $species = Species::get();
              $breeds = Breed::get();
              $specimen = Specimen::get();
              $specimencollectionlocation = Specimencollectionlocation::get();
              $testmethod = Testmethod::get();

              $pathogen = Pathogen::orderBy('pathogen_name','asc')->get();

              //$pathogen = Pathogen::get();

              //return redirect('/singleisolatesample/create');

        return view('singleisolatesample.create',compact('institutions','species','breeds','specimen','specimencollectionlocation','testmethod','pathogen'));
    }


    public function getBreedBySpecies($id){
        $breeds = Breed::where('species_id',$id)->get();
        $html='';
        foreach ($breeds as $key => $value) {
            $html.='<option value='.$value->breed_id.'>'.$value->breed_name.'</option>';
        }
        return $html;
    }



    public function SglIsirSampleFormConfirmation(Request $request){
    //validate the form
   // $this->validate($request, [
     //   'title' => 'required',
     //   'body' => 'required'
   // ]);

           $sglisirsamplepostreview = $request->all();
           $test_date=$request->test_date;
           $institutions=$request->institutions;
           $species=$request->species;
           $breeds=$request->breeds;
           $specimen=$request->specimen;
           $specimencollectionlocation=$request->specimencollectionlocation;
           $testmethods=$request->testmethods;
           $pathogen=$request->pathogen;       

        return view('singleisolatesample.createpostconfirmation', compact('sglisirsamplepostreview','test_date','institutions','species','breeds','specimen','specimencollectionlocation','testmethods','pathogen'));

    }

    public function store(Request $request) {
        
        $user = Auth::user();
        $current_time = Carbon::now();
       // dd($request);

        $store=DB::table('sglisamples')->insert(['test_date' => $request->test_date, 
            'institution_id' => $request->institutions, 'species_id'=>$request->species, 'breed_id'=>$request->breeds, 'specimen_id'=>$request->specimen, 'specimen_location_id'=>$request->specimencollectionlocation, 'test_method_id'=>$request->testmethods, 'pathogen_id'=>$request->pathogen, 'created_by' => $user->id, 'created_at' => $current_time]);

        $lastId= DB::getPdo()->lastInsertId();

        return redirect('/singleisolatesampletest/create/'.$lastId);
         
       
    }

    public function DeleteSglISampleID($id)
    {
       
      $sglisolatesampleid = Sglisample::find($id);
      //dd($sglisolatesampleid);
      if($sglisolatesampleid->delete()) {
        Session::flash('message', 'Single Isolate Sample ID is Deleted from the Record!');
        return redirect('/singleisolatesample/view');
      }
    }


    public function SglISampleTableExport() 
    {
        return Excel::download(new SglisampleExport, 'SingleIsolateSampleTable.xlsx');

    }
    




}
