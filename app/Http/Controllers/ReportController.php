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
use App\Specimen;
use App\SpecimenCategories;
use App\Testmethod;
use App\Pathogen;
use App\Testsensitivitie;
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
		$specimenCategories = SpecimenCategories::orderBy('specimen_category_name', 'asc')->get();
        
        return view('report.indisolatesirreportcreate',compact('specimenCategories'));
    }

	public function IndIsirPathogenReport()
    {
		$pathogens = Pathogen::orderBy('pathogen_name', 'asc')->get();
        
        return view('report.indisolatesirpathogenreport',compact('pathogens'));
    }



	public function IndIzdisReportCreate()
    {
              
            $institution = Institutions::orderBy('institution_name', 'asc')->get();
            $specimen = Specimen::orderBy('specimen_name', 'asc')->get();
            $testmethod = Testmethod::orderBy('test_method_name', 'asc')->get();

                          
        return view('report.indisolatezdisreportcreate',compact('institution','specimen','testmethod'));
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

			if(isset($request->testmethod)){
				$getData=$getData->where('test_method_id',$request->testmethod);
			}

			if(isset($request->from_test_date) && isset($request->to_test_date)){
				$getData=$getData->whereBetween('test_date',[$request->from_test_date,$request->to_test_date]); 
			}

            $getData=$getData->get();

            //dd($getData);   
           
            $testSensetivity= Testsensitivitie::get();
            $pathogen  = Pathogen::get()->sortby("pathogen_name");

            foreach ($pathogen as $pkey => $pvalue) {
				$pathogenName[$pvalue->pathogen_id] = $pvalue->pathogen_name;
            }

            $antibiotic  = Antibiotic::get()->sortby("antibiotic_name");

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
	
	//Individual Isolate SIR Data Report Calculation Method specimen wise
	
	// Steps to re-do for optimization
	/*
		1. Get selected symptom category from request and get the list of symptom_ids
		2. Select the list of sample_ids from sglisamples table by the symptom_ids and test_date between the given date range (default current month)
		3. Aggregate count for each of the tests for 'S' from sglisampletests table by the list of sglisamples->sample_ids, group by pathogen_id, antibiotic_id, test_sensitivity_id joining for pathgen_name and antibiotic_name
	*/
	public function IndIsirReportSymptomsCalculation(Request $request)
    { 
            $testCount= array();
            $sensitivity= array();
            $pathogenCount=array();
			
			$specimen_category = SpecimenCategories::find($request->specimenCategory);
			$specimenList = Specimen::where('specimen_category_id', $request->specimenCategory)->get();
			$specimenListIDs = array();
			foreach($specimenList as $specimen) {
				$specimenListIDs[] = $specimen->specimen_id;
			}

            $getData=Sglisample::whereIn('specimen_id', $specimenListIDs)->with('sglisampletest');
			
    
            //dd($getData->get());
			if(isset($request->from_test_date) && isset($request->to_test_date)){
				$getData=$getData->whereBetween('test_date',[$request->from_test_date,$request->to_test_date]); 
			}

            $getData=$getData->get();

            //dd($getData);   
           
            $testSensetivity= Testsensitivitie::get();
            $pathogen  = Pathogen::get()->sortby("pathogen_name");

            foreach ($pathogen as $pkey => $pvalue) {
				$pathogenName[$pvalue->pathogen_id] = $pvalue->pathogen_name;
            }

            $antibiotic  = Antibiotic::get()->sortby("antibiotic_name");

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
          Session::flash('message', 'Culture Sensitivity Pattern Testing for Single Isolate Data : Result for Antibiotic Sensitivity of ' . $specimen_category['specimen_category_name']);
         
            if('@if(count(pathogenCount)>0'){

                foreach ($sensitivity as $skey => $svalue) {
                    $pathogenCount[$skey]=0;
                    foreach ($svalue as $row => $value) {
                     $pathogenCount[$skey] = $pathogenCount[$skey]+ array_sum($value);
                    }
                }

                $totalCount = array_sum($pathogenCount);

             return view('report/SpecimenWiseReport',compact('testCount','sensitivity','testSensetivity','pathogen','antibiotic','pathogenName','antibioticName','pathogenCount','totalCount'));
            }
        }

    }  //End of Individual Isolate SIR Data Report Calculation 


	public function GenerateSymptomWiseAntibiogram(Request $request)
	{
		$end_date = date("Y-m-d");
		$start_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')-1));
		if ($request->from_test_date != null) {
			$start_date = $request->from_test_date;
		}
		if ($request->to_test_date != null) {
			$end_date = $request->to_test_date;
		}
		
		$specimen_category = SpecimenCategories::find($request->specimenCategory);
		$specimenList = Specimen::where('specimen_category_id', $request->specimenCategory)->get();
		$specimenListIDs = array();
		foreach($specimenList as $specimen) {
			$specimenListIDs[] = $specimen->specimen_id;
		}

		$sgliSamples=Sglisample::whereIn('specimen_id', $specimenListIDs)
			->whereBetween('test_date',[$start_date, $end_date])
			->with('sglisampletest')
			->get();
			//->with('sglisampletest');

		//$getData=$getData->get();

		//dd($sgliSamples);
		
		// Get the selected specimen category name
		$selected_specimen_category_name  = $specimen_category->specimen_category_name;
		// Get the antibiotics list
		$antibiotics  = Antibiotic::pluck("antibiotic_name", "antibiotic_id")->sortby("antibiotic_name");
		// Get the test sensitivities list
		$test_sensitivities  = Testsensitivitie::pluck("test_sensitivity_type","test_sensitivity_id");
		$Pathogens = Pathogen::pluck('pathogen_name','pathogen_id');
		
		$ultimate_array = array();
		$pathogen_wise_counts = array();
		$total_isolates = 0;
		
		foreach($sgliSamples as $sgliSample) {
			$sgliSampleTests = $sgliSample->sglisampletest;
			$pathogen_id = $sgliSample->pathogen_id;
			$pathogen = Pathogen::where('pathogen_id', $pathogen_id)->get();
			
			foreach($sgliSampleTests as $sgliSampleTest) {
				$antibiotic_id = $sgliSampleTest->antibiotic_id;
				
				if (array_key_exists($antibiotic_id, $ultimate_array) === false) {
					$ultimate_array[$antibiotic_id] = array();
				}
				
				if (array_key_exists($pathogen_id, $pathogen_wise_counts) === false) {
					$pathogen_wise_counts[$pathogen_id] = 0;
				}
				
				if (array_key_exists($pathogen_id, $ultimate_array[$antibiotic_id]) === false) {
					$ultimate_array[$antibiotic_id][$pathogen_id] = array();
				}
				
				if (array_key_exists('s', $ultimate_array[$antibiotic_id][$pathogen_id]) === false) {
					$ultimate_array[$antibiotic_id][$pathogen_id]['s'] = 0;
				}
				
				/* if (array_key_exists('i', $ultimate_array[$antibiotic_id][$specimen_category_id]) === false) {
					$ultimate_array[$antibiotic_id][$specimen_category_id]['i'] = 0;
				}
				
				if (array_key_exists('r', $ultimate_array[$antibiotic_id][$specimen_category_id]) === false) {
					$ultimate_array[$antibiotic_id][$specimen_category_id]['r'] = 0;
				} */
				
				if (array_key_exists('t', $ultimate_array[$antibiotic_id][$pathogen_id]) === false) {
					$ultimate_array[$antibiotic_id][$pathogen_id]['t'] = 0;
				}
				
				if ($sgliSampleTest->test_sensitivity_id == 1) {
					$ultimate_array[$antibiotic_id][$pathogen_id]['s']++;
				}/*  else if ($sgliSampleTest->test_sensitivity_id == 2) {
					$ultimate_array[$antibiotic_id][$specimen_category_id]['i']++;
				} else if ($sgliSampleTest->test_sensitivity_id == 3) {
					$ultimate_array[$antibiotic_id][$specimen_category_id]['r']++;
				} */
				
				/* $testSensitivityCountS++;
					$testSensitivityCountI++;
					$testSensitivityCountR++; */
				
				$pathogen_wise_counts[$pathogen_id]++;
				
				$ultimate_array[$antibiotic_id][$pathogen_id]['t']++;
				$total_isolates++;
				
				
				/* if (array_key_exists('t', $ultimate_array[$specimen_category_id]) !== false) {
					$ultimate_array[$specimen_category_id]['t']++;
				} else {
					$ultimate_array[$specimen_category_id]['t'] = 0;
				} */
			}
			/* $total = $testSensitivityCountR + $testSensitivityCountS + $testSensitivityCountI;
			dump($total); */
		}
		
		
		
		arsort($pathogen_wise_counts);
		
		foreach($ultimate_array as $key=>$subArray) {
			ksort($subArray);
			$ultimate_array[$key] = $subArray;
		}
		ksort($ultimate_array);
		
		
		//dd($ultimate_array);
		
		Session::flash('message', 'Culture Sensitivity Pattern : Result for Antibiotic Sensitivity of ' . $selected_specimen_category_name . ' between ' . $start_date . ' and ' . $end_date);
         
		return view('report/SpecimenWiseReport',compact('total_isolates','antibiotics','test_sensitivities','Pathogens', 'pathogen_wise_counts','ultimate_array'));
	}
	public function GeneratePathogenWiseAntibiogram(Request $request) 
	{
		$end_date = date("Y-m-d");
		$start_date = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')-1));
		if ($request->from_test_date != null) {
			$start_date = $request->from_test_date;
		}
		if ($request->to_test_date != null) {
			$end_date = $request->to_test_date;
		}
		
		$selected_pathogen = $request->pathogen;
		// Get the selected pathogen name
		$selected_pathogen_name  = DB::table('pathogen')->where('pathogen_id',$selected_pathogen)->get()[0]->pathogen_name;
		// Get the antibiotics list
		$antibiotics  = Antibiotic::pluck("antibiotic_name", "antibiotic_id")->sortby("antibiotic_name");
		// Get the test sensitivities list
		$test_sensitivities  = Testsensitivitie::pluck("test_sensitivity_type","test_sensitivity_id");
		$SpecimenCategories = SpecimenCategories::pluck('specimen_category_name','specimen_category_id');
		$Specimens = Specimen::get();
		
		$sgliSamples = Sglisample::where('pathogen_id', $selected_pathogen)
			->whereBetween('test_date',[$start_date, $end_date])
			->with('sglisampletest')
			->get();
			
		//dump($sgliSamples);
			
		$ultimate_array = array();
		$spec_cat_wise_counts = array();
		$total_isolates = 0;
		
		foreach($sgliSamples as $sgliSample) {
			$sgliSampleTests = $sgliSample->sglisampletest;
			$specimen_id = $sgliSample->specimen_id;
			$specimen = Specimen::where('specimen_id', $specimen_id)->get();
			$specimen_category_id = $specimen[0]->specimen_category_id;
			if ($specimen_category_id == 14) {	// Uncategorized
				continue;
			}
			
			/* $testSensitivityCountS = $testSensitivityCountI = $testSensitivityCountR = 0; */
			
			foreach($sgliSampleTests as $sgliSampleTest) {
				$antibiotic_id = $sgliSampleTest->antibiotic_id;
				
				if (array_key_exists($antibiotic_id, $ultimate_array) === false) {
					$ultimate_array[$antibiotic_id] = array();
				}
				
				if (array_key_exists($specimen_category_id, $spec_cat_wise_counts) === false) {
					$spec_cat_wise_counts[$specimen_category_id] = 0;
				}
				
				if (array_key_exists($specimen_category_id, $ultimate_array[$antibiotic_id]) === false) {
					$ultimate_array[$antibiotic_id][$specimen_category_id] = array();
				}
				
				if (array_key_exists('s', $ultimate_array[$antibiotic_id][$specimen_category_id]) === false) {
					$ultimate_array[$antibiotic_id][$specimen_category_id]['s'] = 0;
				}
				
				/* if (array_key_exists('i', $ultimate_array[$antibiotic_id][$specimen_category_id]) === false) {
					$ultimate_array[$antibiotic_id][$specimen_category_id]['i'] = 0;
				}
				
				if (array_key_exists('r', $ultimate_array[$antibiotic_id][$specimen_category_id]) === false) {
					$ultimate_array[$antibiotic_id][$specimen_category_id]['r'] = 0;
				} */
				
				if (array_key_exists('t', $ultimate_array[$antibiotic_id][$specimen_category_id]) === false) {
					$ultimate_array[$antibiotic_id][$specimen_category_id]['t'] = 0;
				}
				
				if ($sgliSampleTest->test_sensitivity_id == 1) {
					$ultimate_array[$antibiotic_id][$specimen_category_id]['s']++;
				}/*  else if ($sgliSampleTest->test_sensitivity_id == 2) {
					$ultimate_array[$antibiotic_id][$specimen_category_id]['i']++;
				} else if ($sgliSampleTest->test_sensitivity_id == 3) {
					$ultimate_array[$antibiotic_id][$specimen_category_id]['r']++;
				} */
				
				/* $testSensitivityCountS++;
					$testSensitivityCountI++;
					$testSensitivityCountR++; */
				
				$spec_cat_wise_counts[$specimen_category_id]++;
				
				$ultimate_array[$antibiotic_id][$specimen_category_id]['t']++;
				$total_isolates++;
				
				
				/* if (array_key_exists('t', $ultimate_array[$specimen_category_id]) !== false) {
					$ultimate_array[$specimen_category_id]['t']++;
				} else {
					$ultimate_array[$specimen_category_id]['t'] = 0;
				} */
			}
			/* $total = $testSensitivityCountR + $testSensitivityCountS + $testSensitivityCountI;
			dump($total); */
		}
		
		
		
		arsort($spec_cat_wise_counts);
		
		foreach($ultimate_array as $key=>$subArray) {
			ksort($subArray);
			$ultimate_array[$key] = $subArray;
		}
		ksort($ultimate_array);
		
		
		//dd($ultimate_array);
		
		Session::flash('message', 'Culture Sensitivity Pattern : Result for Antibiotic Sensitivity of ' . $selected_pathogen_name . ' between ' . $start_date . ' and ' . $end_date);
         
		return view('report/PathogenWiseReport',compact('total_isolates','antibiotics','test_sensitivities','SpecimenCategories', 'spec_cat_wise_counts', 'Specimens','ultimate_array'));
	}
	
	
	//Individual Isolate SIR Data Report based on pathogen
	
	public function IndIsirReportPathogensCalculation(Request $request)
    { 
        $selected_pathogen = $request->pathogen;
		
		$start_date = $end_date = date("Y-m-d");
		
		if ($request->from_test_date != null) {
			$start_date = $request->from_test_date;
		}
		if ($request->to_test_date != null) {
			$end_date = $request->to_test_date;
		}

		// TO DO - with below code
		// SPECIMEN CATEGORY WISE GROUPING AND SUMMING
		
		/* $isolate_count_wise_samples = DB::table('sglisamples')
			->select(DB::raw('specimen_id, count(*) as isolate_count'))
			->where('pathogen_id', $selected_pathogen)
			->whereBetween('test_date',[$start_date, $end_date])
			->groupBy('specimen_id')
			->orderByRaw('isolate_count desc')
			->get(); */
		
		// Get the selected pathogen name
		$selected_pathogen_row  = DB::table('pathogen')->where('pathogen_id',$selected_pathogen)->get();
		
		// Get the antibiotics list
		$antibiotics  = Antibiotic::pluck("antibiotic_name", "antibiotic_id")->sortby("antibiotic_name");
		
		// Get the test sensitivities list
		$test_sensitivities  = Testsensitivitie::pluck("test_sensitivity_type","test_sensitivity_id")->sortby("test_sensitivity_type");
		
		
		$sgliSamples = DB::table('sglisamples')
			->where('pathogen_id', $selected_pathogen)
			->whereBetween('test_date',[$start_date, $end_date])
			->pluck('sample_id');
			
		//dd($sgliSamples);
		
		$sgliSampleTestsTotal = DB::table('sglisampletests')
			->select(DB::raw('antibiotic_id, count(*) as isolate_count'))
			->whereIn('sample_id',$sgliSamples->all())
			->groupBy('antibiotic_id',)
			->orderByRaw('isolate_count desc')
			->get();
		
		$sgliSampleTestsS = DB::table('sglisampletests')
			->select(DB::raw('antibiotic_id, count(*) as isolate_count'))
			->whereIn('sample_id',$sgliSamples->all())
			->where('test_sensitivity_id', 1)
			->groupBy('antibiotic_id',)
			->orderByRaw('isolate_count desc')
			->get();
			
		$sgliSamplesSpecimens = DB::table('sglisamples')
			->whereIn('sample_id',$sgliSamples->all())
			->pluck('specimen_id');
			
		$specimenCategoryIDs = DB::table('specimens')
			->whereIn('specimen_id',$sgliSamplesSpecimens->all())
			->pluck('specimen_category_id');
			
		$specimenCategories = DB::table('specimen_categories')
			->whereIn('specimen_category_id',$specimenCategoryIDs->all())
			->pluck('specimen_category_name','specimen_category_id');
			
		//$specimenCategoryWiseSpecimens = 
		
		Session::flash('message', 'Culture Sensitivity Pattern Testing for Single Isolate Data : Result for Antibiotic Sensitivity of ' . $selected_pathogen_row[0]->pathogen_name);
         
		return view('report/PathogenWiseReport',compact('antibiotics','test_sensitivities','sgliSamples','sgliSampleTestsTotal','sgliSampleTestsS','sgliSamplesSpecimens','specimenCategoryIDs','specimenCategories'));
		
		//dd($sgliSampleTests);
			
		// ->select('sglisampletests.antibiotic_id', 'antibiotics.antibiotic_name','testsensitivities.test_sensitivity_type')
		// ->join('antibiotics','sglisampletests.antibiotic_id','=','antibiotics.antibiotic_id')
		// ->join('testsensitivities','sglisampletests.test_sensitivity_id','=','testsensitivities.test_sensitivity_id')
		
		
		/* Sglisample::where('pathogen_id', $selected_pathogen)
						->whereBetween('test_date',[$start_date, $end_date]); */
		//$sgliSamples = $sgliSamples->get();
		
		//dd($isolate_count_wise_samples);
    } 

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



