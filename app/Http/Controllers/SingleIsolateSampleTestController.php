<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Sglisample;
use App\Sglisampletest;
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
use App\Exports\SglisampletestsExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Session;

class SingleIsolateSampleTestController extends Controller
{
    public function view()
    {
    	$sglisample = Sglisample::get();
    	$sglisampletest = Sglisampletest::get();
		$pathogen = Pathogen::get()->sortby("pathogen_name");
		$antibiotic = Antibiotic::get()->sortby("antibiotic_name");
		$testsensitivity = Testsensitivitie::get();
        
       return view('singleisolatesampletest.view',compact('sglisampletest','sglisample','pathogen','antibiotic','testsensitivity'));
    }

  public function create($id)
    {
        $sglisample = Sglisample::get();
    	$sglisampletest = Sglisampletest::get();
        $pathogen = Pathogen::get()->sortby("pathogen_name");
        $antibiotic = Antibiotic::get()->sortby("antibiotic_name");
        $testsensitivity = Testsensitivitie::get();
        $sampleDetails = Sglisample::where('sample_id',$id)->first();

        return view('singleisolatesampletest.create',compact('sglisample','sglisampletest','pathogen','antibiotic','testsensitivity','sampleDetails'));
    }


	public function store(Request $request) 
    {
        $user = Auth::user();
        $current_time = Carbon::now();
        $checkExistingId = Sglisampletest::where('sample_id',$request->sample_id)->get();
        // dd(count($checkExistingId));
        if (count($checkExistingId)!=0) {
			Session::flash('message', 'Sample ID Already Exist');
			return redirect('/singleisolatesampletest/view');
        } else {
			foreach($request->antibiotics as $row=>$val)
			{
				//dd($request->testsensitivity[$val]);
				DB::table('sglisampletests')->insert(['sample_id' => $request->sample_id, 'pathogen_id' => $request->pathogen_id, 'antibiotic_id'=>$request->antibiotics[$row], 'test_sensitivity_id'=>$request->testsensitivity[$val],'created_by' => $user->id, 'created_at' => $current_time]);
			}
			return redirect('/singleisolatesampletest/view');
        }        
    }


    public function DeleteSingleISampleTestID($id)
    {
        $sglisolatesampletestid = Sglisampletest::find($id);
     
		if($sglisolatesampletestid->delete()) {
			Session::flash('message', 'Single Isolate Sample Test ID is Deleted from the Record!');
			return redirect('/singleisolatesampletest/view');
		}
    }


    public function SglISampleTestTableExport() 
    {
        return Excel::download(new SglisampletestsExport, 'SingleIsolateTestTable.xlsx');
    }


}
