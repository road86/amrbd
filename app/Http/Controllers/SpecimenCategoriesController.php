<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Session;
use App\SpecimenCategories;
use PDF;

class SpecimenCategoriesController extends Controller
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
        $specimen_categories = DB::table('specimen_categories')->get();

        return view('specimencategories.view', ['specimen_categories'=>$specimen_categories]);
    }


    public function create() 
    {
		return view('specimencategories.create');
    }


    public function store(Request $request) 
    {
        

     if(isset($request->specimen_category_name))
         {

        $storespecimencategoryname = DB::table('specimen_categories')->insert(['specimen_category_name' => $request->specimen_name]);

        if($storespecimencategoryname) 
            {
             Session::flash('message', 'New Specimen category is Added on the Record!');

             return redirect('/specimenCategory/view');
            }

         else
         {
            Session::flash('message', 'Specimen category is not Added on the Record!');

            return redirect('/specimenCategory/view');

         }

        }

      else
         {
          Session::flash('message', 'No entry found on the Specimen Name!');
          return redirect('/specimenCategory/view');
         }
     
    }

    
    public function DeleteSpecimenCategoryName($id) {

        $specimencategoryname = SpecimenCategories::find($id);

        if($specimencategoryname->delete()){

        Session::flash('message', 'Specimen Name is Deleted from the Record!');

        return redirect('/specimenCategory/view');
      }

    }

    public function EditSpecimenCategoryName($id)
    {
       
     $specimencategoryname = SpecimenCategories :: find($id);
     return view('specimencategories.edit',compact('specimencategoryname'));
    }

    public function UpdateSpecimenCategoryName(Request $request)
    {
        $specimencategoryname = SpecimenCategories::find($request->specimen_category_id);
        $specimencategoryname->specimen_category_name = $request->specimen_category_name;
                
        if($specimencategoryname->save()) {
        Session::flash('message', 'Specimen Category is Updated to the Record!');
        
        return redirect('/specimenCategory/view');
      }

    }

    public function SpecimenCategoriesPdfExport(Request $request)
    {
        $user = Auth::user();
        $current_time = Carbon::now();
        $specimen = SpecimenCategories::orderBy('specimen_category_name', 'asc')->get();
        $pdf = PDF::loadView('specimencategories.pdfview', compact('specimen_category_name', 'user'));
        return $pdf->download('specimen-categories-list.pdf');
    }


   public function PdfView()
    {
        
       return view('specimencategories.pdfview');
    }





}
