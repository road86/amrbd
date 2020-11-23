<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Session;
use App\Specimencollectionlocation;
use PDF;



class SpecimenCollectionLocationController extends Controller
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
        $specimen_collection_location = DB::table('specimencollectionlocations')->get();

        return view('specimencollectionlocation.view', ['specimen_collection_location'=>$specimen_collection_location]);
    }


    public function create()
    {
    return view('specimencollectionlocation.create');
    }

    public function store(Request $request) {
        
        $user = Auth::user();
        $current_time = Carbon::now();

        $storesamplinglocation = DB::table('specimencollectionlocations')->insert(['specimen_location_name' => $request->specimen_location_name, 'created_by' => $user->id, 'created_at' => $current_time]);

        if($storesamplinglocation){

        Session::flash('message', 'New Sampling Location Name is Added on the Record!');
        return redirect('/specimencollectionlocation/view');
        }
        
    }

    public function DeleteSamplingLocationName($id) {

        $samplinglocname = Specimencollectionlocation :: find($id);

        if($samplinglocname->delete()){

        Session::flash('message', 'Sampling Location Name is Deleted from the Record!');

        return redirect('/specimencollectionlocation/view');
      }

    }

    public function EditSamplingLocationName($id)
    {
       
     $samplinglocname = Specimencollectionlocation :: find($id);
     return view('specimencollectionlocation.edit',compact('samplinglocname'));
    }

    public function UpdateSamplingLocationName(Request $request)
    {
        $samplinglocname = Specimencollectionlocation::find($request->specimen_location_id);
        $samplinglocname->specimen_location_name = $request->specimen_location_name;
                
        if($samplinglocname->save()) {
        Session::flash('message', 'Sampling Location Name is Updated to the Record!');
        
        return redirect('/specimencollectionlocation/view');
      }

    }

    public function SamplingLocationPdfExport(Request $request)
    {
        $user = Auth::user();
        $samplinglocname = Specimencollectionlocation::orderBy('specimen_location_name', 'asc')->get();
        $pdf = PDF::loadView('specimencollectionlocation.pdfview', compact('samplinglocname', 'user'));
        return $pdf->download('sampling-location-list.pdf');
    }


   public function PdfView()
    {
        
       return view('specimencollectionlocation.pdfview');
    }


    

}
