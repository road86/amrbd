<?php

namespace App\Http\Controllers;
//namespace App\Exports;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Institutions;
use Carbon\Carbon;
use Session;
use PDF;
//use Maatwebsite\Excel\Facades\Excel;
//use Maatwebsite\Excel\Concerns\FromCollection;
//use App\Http\Controllers\Controller;
//use App\Exports\InstitutionExport;


class InstitutionController extends Controller
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
        if(auth('web')->user()->hasAnyPermission(['Institutions']))  {

            $institution = Institutions::orderBy('institution_name', 'asc')->get();

            return view('institution.view', ['institution'=>$institution]);
        }
        else{
         return view('unauthorize');
        }

    }

    public function create() 
    {
         return view('institution.create');
    }

    public function store(Request $request) {
        
        $user = Auth::user();
        $current_time = Carbon::now();

        $storeinstitutionname = DB::table('institution')->insert(['institution_name' => $request->institution_name, 'created_by' => $user->id, 'created_at' => $current_time]);

        if($storeinstitutionname){
        Session::flash('message', 'New Institution name is Added on the Record!');

        return redirect('/institution/view');

       }
       
    }

     
    public function DeteteInstitutionID($id)
       {
 
       $institution_id = Institutions::find($id);
       
       if($institution_id->delete()){
       Session::flash('message', 'Institution Name is Deleted from the Record!');

       return redirect('/institution/view');
        }

      }


    public function EditInstitutionName($id)
    {
       
        $institution = Institutions::find($id);
        return view('institution.edit',compact('institution'));
    }

    public function UpdateInstitutionName(Request $request){

        $institutionname = Institutions::find($request->institution_id);
        $institutionname->institution_name = $request->institution_name;
       
        if($institutionname->save()) {
        Session::flash('message', 'Institution Name is Updated to the Record!');
        
        return redirect('/institution/view');
       }
      }




 public function InstitutionPdfExport(Request $request)
    {
        $user = Auth::user();
        $current_time = Carbon::now();
        $institution = Institutions::orderBy('institution_name', 'asc')->get();
        $pdf = PDF::loadView('institution.pdfview', compact('institution', 'user'));
        return $pdf->download('institution-list.pdf');
    }


  public function PdfView()
    {
        
       return view('institution.pdfview');
    }




}













