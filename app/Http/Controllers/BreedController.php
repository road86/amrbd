<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Breed;
use App\Species;
use Carbon\Carbon;
use Session;
use PDF;

class BreedController extends Controller
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
         
        $breed = Breed::with('species')->get();

        return view('breed.view', compact('breed'));
    }

    public function create(){
        $species = Species::get();
        //dd($species);
        return view('breed.create',compact('species'));
    }

    public function store(Request $request) {
              
        $user = Auth::user();
        $current_time = Carbon::now();

        $storebreed = DB::table('breed')->insert(['breed_name' => $request->breed_name, 'species_id' => $request->spacies, 'created_by' => $user->id, 'created_at' => $current_time]);

        if($storebreed){
        Session::flash('message', 'New Breed Name is Addred on the Record!');
        
        return redirect('/breed/view');
        }
    }

    public function DeleteBreedName($id)
       {
 
       $breed_id = Breed::find($id);
       
       if($breed_id->delete()){
       Session::flash('message', 'Breed Name is Deleted from the Record!');

       return redirect('/breed/view');
        }

      }

    public function EditBreedName($id)
    {
       
        $breedname = Breed::find($id);
        return view('breed.edit',compact('breedname'));
    }

    public function UpdateBreedName(Request $request){

        $breedname = Breed::find($request->breed_id);
        $breedname->breed_name = $request->breed_name;
       
        if($breedname->save()) {
        Session::flash('message', 'Breed Name is Updated to the Record!');
        
        return redirect('/breed/view');
       }
      }

    public function BreedPdfExport(Request $request)
    {
        $user = Auth::user();
        $current_time = Carbon::now();
        $breed = Breed::orderBy('species_id', 'asc')->get();

        //$breed = Species::with('breed')->orderBy('species_name', 'asc')->get(); 

        $pdf = PDF::loadView('breed.pdfview', compact('breed', 'user'));
        return $pdf->download('breed-list.pdf');
    }


   public function PdfView()
    {
        
       return view('breed.pdfview');
    }








}

