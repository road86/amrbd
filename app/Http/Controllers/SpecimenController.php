<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Session;
use App\Specimen;
use App\SpecimenCategories;
use PDF;

class SpecimenController extends Controller
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
		$specimens = Specimen::with('SpecimenCategories')->get();

        return view('specimen.view', ['specimens'=>$specimens]);
    }


    public function create() 
    {
		$specimen_categories = SpecimenCategories::orderBy('specimen_category_name', 'asc')->get();
		return view('specimen.create',compact('specimen_categories'));
    }


    public function store(Request $request) 
    {
        
        $user = Auth::user();
        $current_time = Carbon::now();

     if(isset($request->specimen_name))
         {

        $storespecimenname = DB::table('specimens')->insert(['specimen_name' => $request->specimen_name, 'created_by' => $user->id, 'created_at' => $current_time]);

        if($storespecimenname) 
            {
             Session::flash('message', 'New Specimen name is Added on the Record!');

             return redirect('/specimen/view');
            }

         else
         {
            Session::flash('message', 'Specimen name is not Added on the Record!');

            return redirect('/specimen/view');

         }

        }

      else
         {
          Session::flash('message', 'No entry found on the Specimen Name!');
          return redirect('/specimen/view');
         }
     
    }

    
    public function DeleteSpecimenName($id) {

        $specimenname = Specimen::find($id);

        if($specimenname->delete()){

        Session::flash('message', 'Specimen Name is Deleted from the Record!');

        return redirect('/specimen/view');
      }

    }

    public function EditSpecimenName($id)
    {
		$specimen_categories = SpecimenCategories::orderBy('specimen_category_name', 'asc')->get();
		$specimen = Specimen::with('SpecimenCategories')->find($id);
		return view('specimen.edit',compact('specimen','specimen_categories'));
    }

    public function UpdateSpecimenName(Request $request)
    {
        $specimenname = Specimen::find($request->specimen_id);
        $specimenname->specimen_name = $request->specimen_name;
		$specimenname->specimen_category_id = $request->specimen_category;
                
        if($specimenname->save()) {
        Session::flash('message', 'Specimen Name is Updated to the Record!');
        
        return redirect('/specimen/view');
      }

    }

    public function SpecimenPdfExport(Request $request)
    {
        $user = Auth::user();
        $current_time = Carbon::now();
        $specimen = Specimen::orderBy('specimen_name', 'asc')->get();
        $pdf = PDF::loadView('specimen.pdfview', compact('specimen', 'user'));
        return $pdf->download('specimen-list.pdf');
    }


   public function PdfView()
    {
        
       return view('specimen.pdfview');
    }





}
