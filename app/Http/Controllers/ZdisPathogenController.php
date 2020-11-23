<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Carbon\Carbon;
use App\Zdispathogen;
use App\Pathogen;
use App\Antibiotic;
use Session;
use PDF;

class ZdisPathogenController extends Controller
{
    public function view()
    {
        //$zdispathogen = Zdispathogen::with('antibiotic')->get();

        //$zdispathogen = Zdispathogen::with('pathogen','antibiotic')->orderBy('pathogen_name', 'asc')->get();

         $zdispathogen = Zdispathogen::with('pathogen','antibiotic')->get();


        // dd($zdispathogen);
        return view('zdis.view',compact('zdispathogen'));
    }

    public function create()
    {
              
        //$pathogen = Pathogen::get();
        $pathogen = Pathogen::orderBy('pathogen_name', 'asc')->get();
        //$antibiotic = Antibiotic::get();
        $antibiotic = Antibiotic::orderBy('antibiotic_name', 'asc')->get();

        return view('zdis.create',compact('pathogen','antibiotic'));
    }

    public function store(Request $request) {
        
        $user = Auth::user();
        $current_time = Carbon::now();
       //dd($request);

        $zdisstore = DB::table('zdispathogens')->insert(['pathogen_id'=>$request->pathogen, 'antibiotic_id'=>$request->antibiotic, 'sensitive_mm'=>$request->sensitives, 'intermediate_mm'=>$request->intermediate, 'resistance_mm'=>$request->resistance,'esbl_mm'=>$request->esbl, 'created_by' => $user->id, 'created_at' => $current_time]);
       
        if($zdisstore){
        	Session::flash('message', 'Zone Diameter Interpretative Criteria (ZDIS) is Added on the Record!');

        	return redirect('/zdis/view');

        }
    }

        public function DeleteZdisID($id) {
       
      	$zdisid = Zdispathogen::find($id);
      	if($zdisid->delete()) {
        Session::flash('message', 'Zone Diameter Interpretative Criteria (ZDIS) is Deleted fron the Record!');
        return redirect('/zdis/view');
      }

        
    }




    public function EditZdisValues($id) {
       
     	$zdisvalues = Zdispathogen::find($id);
     	$pathogen = Pathogen::get();
        $antibiotic = Antibiotic::get();

  
     return view('zdis.edit',compact('pathogen','antibiotic','zdisvalues'));
    }


    public function UpdateZdisValues(Request $request)
    {
    	$zdisvalues = Zdispathogen::find($request->zdis_id);
        //dd($zdisvalues);

        $zdisvalues->pathogen_id = $request->pathogen;
        $zdisvalues->antibiotic_id = $request->antibiotic;
       
        $zdisvalues->sensitive_mm = $request->sensitives;
        $zdisvalues->intermediate_mm = $request->intermediate;
        $zdisvalues->resistance_mm = $request->resistance;
        $zdisvalues->esbl_mm = $request->esbl;
        
        if($zdisvalues->save()) {
        Session::flash('message', 'ZDIS Values are Updated in the Record!');

        return redirect('/zdis/view');
     }

    }
  
    public function ZdisRefTablePDFExport(Request $request)
    {
        $user = Auth::user();
        $zdisrefvalues = Zdispathogen::get();
        //dd($zdisrefvalues);
        //$zdispathogenvalues = Zdispathogen::with('antibiotic')->get();
        //return view('zdis.pdfview', compact('zdisrefvalues', 'user'));
        $pdf = PDF::loadView('zdis.pdfview', compact('zdisrefvalues', 'user'));
        return $pdf->download('zdis-pathogen-list.pdf');
    }


    public function PdfView()
    {
        
       return view('zdis.pdfview');
    }

}

         
       
    



