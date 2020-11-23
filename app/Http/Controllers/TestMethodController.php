<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Testmethod;
use Carbon\Carbon;
use Session;
use PDF;

class TestMethodController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function view()
    {
        $testmethods = DB::table('testmethods')->get();

        return view('testmethod.view', ['testmethods'=>$testmethods]);
    }
    
    public function create() 
    {
    return view('testmethod.create');
    }
    
    public function store(Request $request) 
    {
        
        $user = Auth::user();
        $current_time = Carbon::now();


        $storetestmethod = DB::table('testmethods')->insert(['test_method_name' => $request->test_method_name, 'created_by' => $user->id, 'created_at' => $current_time]);
       // dd($storetestmethod);

       if('$storetestmethod') {
        Session::flash('message', 'New Test Method is is Added on the Record!');

        return redirect('/testmethod/view');
    }
    }

    public function DeleteTestMethod($id)
    {
       
      $testmethod = Testmethod::find($id);
      if($testmethod->delete()) {
        Session::flash('message', 'Test Method is Deleted!');
        return redirect('/testmethod/view');
      }

        //return redirect('/testmethod/view')->with('msg','Test Method Deleted Successfully!!');
    }



  public function EditTestMethod($id)
   {
       
     $testmethod = Testmethod::find($id);
     return view('testmethod.edit',compact('testmethod'));
    }

    public function update(Request $request)
    {
        $testmethod = Testmethod::find($request->test_method_id);
        $testmethod->test_method_name = $request->test_method_name;
        //$testmethod->save();
         if($testmethod->save()) {
        Session::flash('message', 'Test Method is updated!');

        return redirect('/testmethod/view');
      }

    }

    public function TestMethodPDFExport(Request $request)
    {
        $user = Auth::user();
        $testmethod = Testmethod::orderBy('test_method_name', 'asc')->get();
        $pdf = PDF::loadView('testmethod.pdfview', compact('testmethod', 'user'));
        return $pdf->download('testmethod-list.pdf');
    }


    public function PdfView()
    {
        
       return view('testmethod.pdfview');
    }

    

  
}
