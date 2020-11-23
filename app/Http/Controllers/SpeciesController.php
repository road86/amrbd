<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Session;
use App\Species;
use PDF;

class SpeciesController extends Controller
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
       

    if(auth('web')->user()->hasAnyPermission(['Species']))
       {
        $species = DB::table('species')->get();
        return view('species.view', ['species'=>$species]);
        }
    else{
        return view('unauthorize');
        }
    }
    


    public function create() 
    {
        if(auth('web')->user()->hasAnyPermission(['Species']))
        {
          return view('species.create');
        }
        else{
        return view('unauthorize');
        }
    }

    public function store(Request $request) 
    {
        
        $user = Auth::user();
        $current_time = Carbon::now();

        $storespeciesname = DB::table('species')->insert(['species_name' => $request->species_name, 'created_by' => $user->id, 'created_at' => $current_time]);

        if($storespeciesname){
        Session::flash('message', 'New Species name is Added on the Record!');

        return redirect('/species/view');
       }
      
    }

    public function DeteteSpeciesID($id)
       {
 
       $species_id = Species::find($id);
       
       if($species_id->delete()){
       Session::flash('message', 'Species Name is Deleted from the Record!');

       return redirect('/species/view');
        }

      }

    public function EditSpeciesName($id)
    {
       
        $speciesname = Species::find($id);
        return view('species.edit',compact('speciesname'));
    }

    public function UpdateSpeciesName(Request $request){

        $speciesname = Species::find($request->species_id);
        $speciesname->species_name = $request->species_name;
       
        if($speciesname->save()) {
        Session::flash('message', 'Species Name is Updated to the Record!');
        
        return redirect('/species/view');
       }
      }


    public function SpeciesPdfExport(Request $request)
    {
        $user = Auth::user();
        $current_time = Carbon::now();
        $species = Species::orderBy('species_name', 'asc')->get();
        $pdf = PDF::loadView('species.pdfview', compact('species', 'user'));
        return $pdf->download('species-list.pdf');
    }


   public function PdfView()
    {
        
       return view('species.pdfview');
    }

}
