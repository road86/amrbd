<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Pathogen;
use Session;
use PDF;


class PathogenController extends Controller
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
        //$pathogen = DB::table('pathogen')->get();

        $pathogen = Pathogen::orderBy('pathogen_name', 'asc')->get();

        return view('pathogen.view', ['pathogen'=>$pathogen]);
    }

       public function create() 
    {
    return view('pathogen.create');
    }

    public function store(Request $request) {
        
        $user = Auth::user();
        $current_time = Carbon::now();

       $storepathogen = DB::table('pathogen')->insert(['pathogen_name' => $request->pathogen_name, 'created_by' => $user->id, 'created_at' => $current_time]);

         if('$storepathogen') {
        Session::flash('message', 'New Pathogen is Added on the Record!');

        return redirect('/pathogen/view');
    }
    }



     public function DeletePathogenName($id)  
    {
       
      $pathogenname = Pathogen::find($id);

     
      if($pathogenname->delete()){
        Session::flash('message', 'Pathogen Name is Deleted from Record!');

        return redirect('/pathogen/view');
      }

    }

   public function EditPathogenName($id)
   {
       
     $pathogenname = Pathogen::find($id);
  
     return view('pathogen.edit',compact('pathogenname'));
    }


    public function UpdatePathogenName(Request $request)
    {
        $pathogenname = Pathogen::find($request->pathogen_id);
        $pathogenname->pathogen_name = $request->pathogen_name;
        
        if($pathogenname->save()) {
        Session::flash('message', 'Pathogen Name is Updated in the Record!');

        return redirect('/pathogen/view');
      }

    }

    
    public function PathogenPdfExport(Request $request)
    {
        $user = Auth::user();
        $pathogen = Pathogen::orderBy('pathogen_name', 'asc')->get();
        $pdf = PDF::loadView('pathogen.pdfview', compact('pathogen', 'user'));
        return $pdf->download('pathogen-list.pdf');
    }


   public function PdfView()
    {
        
       return view('pathogen.pdfview');
    }


}
