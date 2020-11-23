<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Testsensitivitie;
use Session;
use PDF;


class TestSensitivityController extends Controller
{
    public function view()
    {
        //$testsensitivity = DB::table('testsensitivities')->get();

       $testsensitivity = Testsensitivitie::get();

        //dd($testsensitivity);

        return view('testsensitivity.view',compact('testsensitivity'));
        //, ['testmethods'=>$testmethods]);
    }
    
    
    public function create() 
    {
    return view('testsensitivity.create');
    }

    
    public function store(Request $request) 
    {
        
        $user = Auth::user();
        $current_time = Carbon::now();

        $storetestsensitivitypattern=DB::table('testsensitivities')->insert(['test_sensitivity_type' => $request->test_sensitivity_type, 'created_by' => $user->id, 'created_at' => $current_time]);


       if($storetestsensitivitypattern) {
        Session::flash('message', 'New Test Sensitivity Pattern is Added on the Record!');

        return redirect('/testsensitivity/view');
      }
    }



    public function  DeleteTestSensitivityType($id)
    {
       
      $testsensitivityid = Testsensitivitie::find($id);
     
      if($testsensitivityid->delete()){

        Session::flash('message', 'Test Sensitivity Pattern is Deleted!');

        return redirect('/testsensitivity/view');
      }     
    }



  public function EditTestSensitivityType($id)
   {
       
     $testsensitivitytype = Testsensitivitie::find($id);
     //dd($testsensitivitytype);
     return view('testsensitivity.edit',compact('testsensitivitytype'));
    }

    public function UpdateTestSensitivityType(Request $request)
    {
        $testsensitivitytype = Testsensitivitie::find($request->test_sensitivity_id);
        $testsensitivitytype->test_sensitivity_type = $request->test_sensitivity_type;
        //dd($testsensitivitytype);
        
        if($testsensitivitytype->save()) {
        Session::flash('message', 'Test Sensitivity Pattern is updated!');
        
        return redirect('/testsensitivity/view');
      }

    }
 
    public function TestSensitivityPDFExport(Request $request)
    {
        $user = Auth::user();
        $testsensitivitytype = Testsensitivitie::get();
        $pdf = PDF::loadView('testsensitivity.pdfview', compact('testsensitivitytype', 'user'));
        return $pdf->download('testsensitivity-type-list.pdf');
    }


    public function PdfView()
    { 
       return view('testsensitivity.pdfview');
    }



    
}
