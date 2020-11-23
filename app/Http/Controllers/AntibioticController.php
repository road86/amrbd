<?php

namespace App\Http\Controllers;
use App\Exports\AntibioticsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Antibiotic;
use Carbon\Carbon;
use Session;
use PDF;

class AntibioticController extends Controller
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
        //$antibiotic = DB::table('antibiotics')->get();
        //$user = Auth::user();

        $antibiotic = Antibiotic::orderBy('antibiotic_name', 'asc')->get();

        return view('antibiotic.view', ['antibiotic'=>$antibiotic]);
    }

    public function create() 
    {
    return view('antibiotic.create');
    }


    public function store(Request $request) {
        
        $user = Auth::user();
        $current_time = Carbon::now();

        $storeantiobiotic = DB::table('antibiotics')->insert(['antibiotic_name' => $request->antibiotic_name, 'created_by' => $user->id, 'created_at' => $current_time]);

        if('$storeantiobiotic') {
        Session::flash('message', 'New Antibiotic is Added on the Record!');

        return redirect('/antibiotic/view');
      }
    }


    public function DeleteAntibioticName($id)
    {
       
      $antibiotic = Antibiotic::find($id);
      
      if($antibiotic->delete()){
        Session::flash('message', 'Antibiotic Name is Deleted from Record!');

         return redirect('/antibiotic/view');
     }
    }


     public function EditAntibioticName($id)
   {
       
     $antibioticname = Antibiotic::find($id);
     //dd($testsensitivitytype);
     return view('antibiotic.edit',compact('antibioticname'));
    }


    public function UpdateAntibioticName(Request $request)
    {
        $antibioticname = Antibiotic::find($request->antibiotic_id);
        $antibioticname->antibiotic_name = $request->antibiotic_name;
        //dd($antibioticname);
        
        if($antibioticname->save()) {
        Session::flash('message', 'Antibiotic Name is updated in the Record!');
        
        return redirect('/antibiotic/view');
      }

    }

    public function AntibioticsExcelExport() 
    {
        return Excel::download(new AntibioticsExport, 'antibiotics.xlsx');
    }

    public function AntibioticsPDFExport(Request $request)
    {
    
        $user = Auth::user();
        $current_time = Carbon::now();
        //$data = Antibiotic::get();  
        //$pdf = PDF::loadView('antibiotic.view', $data);
        $antibiotic = Antibiotic::orderBy('antibiotic_name', 'asc')->get();

        $pdf = PDF::loadView('antibiotic.pdfview', compact('antibiotic', 'user'));

        
        return $pdf->download('antibiotic-list.pdf');
   
   
    // If you want to store the generated pdf to the server then you can use the store function
   //$pdf->save(storage_path().'_filename.pdf');
    // Finally, you can download the file using download function
    //return $pdf->download('antibiotics.pdf');
    }

    public function PdfView()
    {
        
       return view('antibiotic.pdfview');
    }



}
