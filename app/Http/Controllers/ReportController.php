<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Sglisample;
use App\Sglisampletest;
use App\Sglizdissample;
use App\Sglizdissampletest;
use App\Antibiotic;
use App\Samples;
use App\Institutions;
use App\Species;
use App\Breed;
use App\Specimen;
use App\Testmethod;
use App\Pathogen;
use App\Testsensitivitie;
use App\Specimencollectionlocation;
use Carbon\Carbon;
use Session;
use PDF;


class ReportController extends Controller
{
   
   
  //To show the Menu's of Report Page
    public function view()
    {
        return view('report.view');
    }

   /* 
    public function IndIzdisReportview()
    {
        return view('report.indizdisresportview');
    }


    public function SingleIsolateSIRspecimencreate()
    {
              
              $specimen = Specimen::get();
                          
       return view('report.sglisircreate',compact('specimen'));
    }


    public function SingleIsolateZDISspecimencreate()
    {
              
              $specimen = Specimen::get();
                          
        return view('report.sglizdiscreate',compact('specimen'));
    }  
    */


   //Individual Isolate SIR Data Report Create Model for all Sample parameters

    public function IndIsirReportCreate()
    {
              
            $institution = Institutions::orderBy('institution_name', 'asc')->get();
            $species = Species::orderBy('species_name', 'asc')->get();
            $breed = Breed::get();
            $specimen = Specimen::orderBy('specimen_name', 'asc')->get();
            $samplinglocation = Specimencollectionlocation::orderBy('specimen_location_name', 'asc')->get();
            $testmethod = Testmethod::orderBy('test_method_name', 'asc')->get();

                          
        return view('report.indisolatesirreportcreate',compact('institution','species','breed','specimen','samplinglocation','testmethod'));
    }



 public function IndIzdisReportCreate()
    {
              
            $institution = Institutions::orderBy('institution_name', 'asc')->get();
            $species = Species::orderBy('species_name', 'asc')->get();
            $breed = Breed::get();
            $specimen = Specimen::orderBy('specimen_name', 'asc')->get();
            $samplinglocation = Specimencollectionlocation::orderBy('specimen_location_name', 'asc')->get();
            $testmethod = Testmethod::orderBy('test_method_name', 'asc')->get();

                          
        return view('report.indisolatezdisreportcreate',compact('institution','species','breed','specimen','samplinglocation','testmethod'));
    }


   //Individual Isolate SIR Data Report Calculation Method for all Sample parameters

    public function IndIsirReportCalculation(Request $request)

    { 
            $testCount= array();            
            $sensitivity= array();
            $pathogenCount=array();

            $getData=Sglisample::with('sglisampletest');         
    
            // dd($getData->get());

        if(isset($request->institution)){

             $getData=$getData->where('institution_id',$request->institution);       
        }


        if(isset($request->species) && isset($request->breed)){

             $getData=$getData->where('species_id',$request
                ->species)->where('breed_id',$request->breed);
        }


        if(isset($request->specimen)){

            $getData=$getData->where('specimen_id',$request->specimen);
        }


        if(isset($request->samplinglocation)){

            $getData=$getData->where('specimen_location_id',$request->samplinglocation);
        }

        if(isset($request->testmethod)){

            $getData=$getData->where('test_method_id',$request->testmethod);
        }


        if(isset($request->from_test_date) && isset($request->to_test_date)){

            $getData=$getData->whereBetween('test_date',[$request->from_test_date,$request->to_test_date]); 
        }


            $getData=$getData->get();

            //dd($getData);   
           
            $testSensetivity= Testsensitivitie::get();
            $pathogen  = Pathogen::get();

            foreach ($pathogen as $pkey => $pvalue) {
                $pathogenName[$pvalue->pathogen_id] = $pvalue->pathogen_name;
            }

            $antibiotic  = Antibiotic::get();

            foreach ($antibiotic as $akey => $avalue) {
                $antibioticName[$avalue->antibiotic_id] = $avalue->antibiotic_name;
            }

            foreach ($getData as $key => $value) {
                $test=Sglisampletest::where('sample_id', $value->sample_id)->get(); 

                $testCount[$value->pathogen_id] = count($test);
                foreach ($test as $tKey => $tValue) {
                    $testAntibiotic=Sglisampletest::where([['sample_id', $value->sample_id],['antibiotic_id',$tValue->antibiotic_id]])->get();
                    $antibioticCount[$value->pathogen_id][$tValue->antibiotic_id] = count($testAntibiotic);
                    foreach ($testSensetivity as $senkey => $senvalue) {
                        foreach ($testAntibiotic as $Akey => $Avalue) {
                            $count=Sglisampletest::where([['sample_id', $value->sample_id],['antibiotic_id',$tValue->antibiotic_id],['test_sensitivity_id',$senvalue->test_sensitivity_id]])->count();

                            if (isset($sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id])) {

                                $sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id] = $sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id] + $count;
                            }
                            else{
                                $sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id] = $count;
                            }
                        }
                    }
                    
                }       
            }
    

        if('@if(count($testCount)>0)') {
          Session::flash('message', '--------------------------------------------------- Culture Sensitivity Pattern Testing for Single Isolate Data : Result for Antibiotic Sensitivity  -----------------------------------------------------');
         
            if('@if(count(pathogenCount)>0'){

                foreach ($sensitivity as $skey => $svalue) {
                    $pathogenCount[$skey]=0;
                    foreach ($svalue as $row => $value) {
                     $pathogenCount[$skey] = $pathogenCount[$skey]+ array_sum($value);
                    }
                }

                $totalCount = array_sum($pathogenCount);

             return view('report/SpecimenReport',compact('testCount','sensitivity','testSensetivity','pathogen','antibiotic','pathogenName','antibioticName','pathogenCount','totalCount'));
            }
        }

    }  //End of Individual Isolate SIR Data Report Calculation 


    //Individual Isolate ZDIS Data Report Calculation Method for all Sample parameters

    public function IndIzdisReportCalculation(Request $request)
    { 
            $testCount= array();            
            $sensitivity= array();
            $pathogenCount=array();

            $getData=Sglizdissample::with('sglizdissampletest');    
    
        // dd($getData->get());

        if(isset($request->institution)){

           $getData=$getData->where('institution_id',$request->institution);      
        
            }


        if(isset($request->species) && isset($request->breed)){

            $getData=$getData->where('species_id',$request
                ->species)->where('breed_id',$request->breed);

            }



        if(isset($request->specimen)){

            $getData=$getData->where('specimen_id',$request->specimen);

            }


        if(isset($request->samplinglocation)){

            $getData=$getData->where('specimen_location_id',$request->samplinglocation);

            }

        if(isset($request->testmethod)){

            $getData=$getData->where('test_method_id',$request->testmethod);

            }


        if(isset($request->from_test_date) && isset($request->to_test_date)){

            $getData=$getData->whereBetween('test_date',[$request->from_test_date,$request->to_test_date]); 

            }


            $getData=$getData->get();

            //dd($getData);

           
            $testSensetivity= Testsensitivitie::get();
            $pathogen  = Pathogen::get();

            foreach ($pathogen as $pkey => $pvalue) {
                $pathogenName[$pvalue->pathogen_id] = $pvalue->pathogen_name;
            }

            $antibiotic  = Antibiotic::get();

            foreach ($antibiotic as $akey => $avalue) {
                $antibioticName[$avalue->antibiotic_id] = $avalue->antibiotic_name;
            }

            
            foreach ($getData as $key => $value) {
                $test=Sglizdissampletest::where('sample_id', $value->sample_id)->get(); 

                $testCount[$value->pathogen_id] = count($test);
                foreach ($test as $tKey => $tValue) {
                    $testAntibiotic=Sglizdissampletest::where([['sample_id', $value->sample_id],['antibiotic_id',$tValue->antibiotic_id]])->get();
                    $antibioticCount[$value->pathogen_id][$tValue->antibiotic_id] = count($testAntibiotic);
                    foreach ($testSensetivity as $senkey => $senvalue) {
                        foreach ($testAntibiotic as $Akey => $Avalue) {
                               $count=Sglizdissampletest::where([['sample_id', $value->sample_id],['antibiotic_id',$tValue->antibiotic_id],['test_sensitivity_id',$senvalue->test_sensitivity_id]])->count();

                             if (isset($sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id])) {

                                $sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id] = $sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id] + $count;
                                 }

                             else{
                                $sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id] = $count;
                                 }
                        }
                    }
                    
                }       
            }
    

        if('@if(count($testCount)>0)') {
         Session::flash('message', '--------------------------------------------------- Culture Sensitivity Pattern Testing for Individual Isolate ZDIS Data : Result for Antibiotic Sensitivity  -----------------------------------------------------');
         
            if('@if(count(pathogenCount)>0'){

                foreach ($sensitivity as $skey => $svalue) {
                 $pathogenCount[$skey]=0;
                 foreach ($svalue as $row => $value) {
                   $pathogenCount[$skey] = $pathogenCount[$skey]+ array_sum($value);
                 }
                }

             $totalCount = array_sum($pathogenCount);

             return view('report/indizdisresportview',compact('testCount','sensitivity','testSensetivity','pathogen','antibiotic','pathogenName','antibioticName','pathogenCount','totalCount'));

            // return view('report/SpecimenReport',compact('testCount','sensitivity','testSensetivity','pathogen','antibiotic','pathogenName','antibioticName','pathogenCount','totalCount'));
            }
        }

    }  // End of Individual Isolate ZDIS Data Report Calculation




  /*
    public function SpecimenReport(Request $request)
    {
            $testCount= array();            
            $sensitivity= array();

    		$getData=Sglisample::with('sglisampletest')->where('specimen_id',$request
    			->specimen)->whereBetween('test_date',[$request->from_test_date,$request->to_test_date])->get();
            $testSensetivity= Testsensitivitie::get();
    		$pathogen  = Pathogen::get();
    		foreach ($pathogen as $pkey => $pvalue) {
    			$pathogenName[$pvalue->pathogen_id] = $pvalue->pathogen_name;
    		}

    		$antibiotic  = Antibiotic::get();

    		foreach ($antibiotic as $akey => $avalue) {
    			$antibioticName[$avalue->antibiotic_id] = $avalue->antibiotic_name;
    		}

    		foreach ($getData as $key => $value) {
    			$test=Sglisampletest::where('sample_id', $value->sample_id)->get(); 

    			$testCount[$value->pathogen_id] = count($test);
    			foreach ($test as $tKey => $tValue) {
    				$testAntibiotic=Sglisampletest::where([['sample_id', $value->sample_id],['antibiotic_id',$tValue->antibiotic_id]])->get();
    				$antibioticCount[$value->pathogen_id][$tValue->antibiotic_id] = count($testAntibiotic);
    				foreach ($testSensetivity as $senkey => $senvalue) {
    					foreach ($testAntibiotic as $Akey => $Avalue) {
    						$count=Sglisampletest::where([['sample_id', $value->sample_id],['antibiotic_id',$tValue->antibiotic_id],['test_sensitivity_id',$senvalue->test_sensitivity_id]])->count();

    						if (isset($sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id])) {

    							$sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id] = $sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id] + $count;
    						}
    						else{
    							$sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id] = $count;
    						}
    					}
    				}
    				
    			}		
    		}

   if('@if(count($testCount)>0)') {
        Session::flash('message', '--------------------------------------------------- Culture Sensitivity Pattern Testing for Single Isolate Data : Result for Antibiotic Sensitivity  -----------------------------------------------------');
         
         foreach ($sensitivity as $skey => $svalue) {
            $pathogenCount[$skey]=0;
             foreach ($svalue as $row => $value) {
                 $pathogenCount[$skey] = $pathogenCount[$skey]+ array_sum($value);
             }
         }

         $totalCount = array_sum($pathogenCount);



         // dd();

        return view('report/SpecimenReport',compact('testCount','sensitivity','testSensetivity','pathogen','antibiotic','pathogenName','antibioticName','pathogenCount','totalCount'));
    }
  		

    }






    public function ZdisSpecimenReport(Request $request)
    {
            $testCount= array();            
            $sensitivity= array();

            $getData=Sglizdissample::with('sglizdissampletest')->where('specimen_id',$request
                ->specimen)->whereBetween('test_date',[$request->from_test_date,$request->to_test_date])->get();
            $testSensetivity= Testsensitivitie::get();
            $pathogen  = Pathogen::get();
            foreach ($pathogen as $pkey => $pvalue) {
                $pathogenName[$pvalue->pathogen_id] = $pvalue->pathogen_name;
            }

            $antibiotic  = Antibiotic::get();

            foreach ($antibiotic as $akey => $avalue) {
                $antibioticName[$avalue->antibiotic_id] = $avalue->antibiotic_name;
            }

            foreach ($getData as $key => $value) {
                $test=Sglizdissampletest::where('sample_id', $value->sample_id)->get(); 

                $testCount[$value->pathogen_id] = count($test);
                foreach ($test as $tKey => $tValue) {
                    $testAntibiotic=Sglizdissampletest::where([['sample_id', $value->sample_id],['antibiotic_id',$tValue->antibiotic_id]])->get();
                    $antibioticCount[$value->pathogen_id][$tValue->antibiotic_id] = count($testAntibiotic);
                    foreach ($testSensetivity as $senkey => $senvalue) {
                        foreach ($testAntibiotic as $Akey => $Avalue) {
                            $count=Sglizdissampletest::where([['sample_id', $value->sample_id],['antibiotic_id',$tValue->antibiotic_id],['test_sensitivity_id',$senvalue->test_sensitivity_id]])->count();

                            if (isset($sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id])) {

                                $sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id] = $sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id] + $count;
                            }
                            else{
                                $sensitivity[$value->pathogen_id][$tValue->antibiotic_id][$senvalue->test_sensitivity_id] = $count;
                            }
                        }
                    }
                    
                }       
            }


              if('@if(count($testCount)>0)') {
        Session::flash('message', '--------------------------------------------------- Culture Sensitivity Pattern Testing for Single Isolate Data : Result for Antibiotic Resistance  -----------------------------------------------------');


        return view('report/SpecimenReport',compact('testCount','sensitivity','testSensetivity','pathogen','antibiotic','pathogenName','antibioticName'));
       }
        

    } */

/**
    public function PathogenPdfExport(Request $request)
    {
        $user = Auth::user();
        $pathogen = Pathogen::orderBy('pathogen_name', 'asc')->get();
        $pdf = PDF::loadView('report.pdfview', compact('pathogen', 'user'));
        return $pdf->download('pathogen-list.pdf');
    }


   public function PdfView()
    {
        
       return view('report.pdfview');
    }
    **/

}



