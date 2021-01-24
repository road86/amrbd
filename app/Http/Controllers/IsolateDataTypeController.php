<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
use Auth;

class IsolateDataTypeController extends Controller
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
	
    public function view()
    {
		if(auth('web')->user()->hasAnyPermission(['Insert data']))  {
			return view('isolatedatatype.view');
		}
        else{
			return view('unauthorize');
        }
    }


   public function IsolateTypeView()
    {
		if(auth('web')->user()->hasAnyPermission(['Insert data']))  {
			return view('isolatedatatype.isolatetypeview');
		}
        else{
			return view('unauthorize');
        }
    }
	
	public function IsolateTypeFileUploadView()
    {
        if(auth('web')->user()->hasAnyPermission(['Insert data']))  {
			return view('isolatedatatype.isolatetypefileuploadview');
		}
        else{
			return view('unauthorize');
        }
    }
	
	public function IsolateTypeCSVUploadView()
    {
        if(auth('web')->user()->hasAnyPermission(['Insert data']))  {
			return view('isolatedatatype.isolatetypecsvuploadview');
		}
        else{
			return view('unauthorize');
        }
    }


 public function IsolateTypeIndividualView()
    {
        if(auth('web')->user()->hasAnyPermission(['Insert data']))  {
			return view('isolatedatatype.isolatetypeindividualview');
		}
        else{
			return view('unauthorize');
        }
    }


 public function IsolateTypeSummarizeView()
    {
        if(auth('web')->user()->hasAnyPermission(['Insert data']))  {
			return view('isolatedatatype.isolatetypesummarizeview');
		}
        else{
			return view('unauthorize');
        }
    }


	public function UploadZipFile(Request $request) {
		$validation = $request->validate([
			'zip_file' => 'bail|required|mimes:zip,rar'
		]);
		
		$file = $validation['zip_file'];
		$path = $file->store('chevron_zips');
		Session::flash('message', $path);
		/* 
		$validator = Validator::make($request->all(),[
			'zip_file' => 'bail|required|mimes:zip,rar'
        ], $messages = [
			'mimes' => 'Please select a zip or rar archive that has RTF files only'
		]);
		
		if(!$validator->errors()) {
			if($request->file('zip_file')) {
				$path = $request->file('zip_file')->store('chevron_zips');
				Session::flash('message', $path);
			} else {
				return back()
				->with('message','Sorry, the file could not be uploaded. Pleas try again.');
			}
		} else {
			Session::flash('message', 'Please select a zip or rar archive that has RTF files only');
		} */
		return redirect('/isolatedatatype/isolatetypefileuploadview');
	}
	
	public function UploadCSVFile(Request $request) {
		$validation = $request->validate([
			'csv_file' => 'bail|required|mimes:csv,xls'
		]);
		
		$file = $validation['csv_file'];
		$path = $file->store('epic_files');
		Session::flash('message', $path);
		/* 
		if(!$validator->errors()) {
			if($request->file('csv_file')) {
				$path = $request->file('csv_file')->store('epic_files');
				Session::flash('message', $path);
			} else {
				return back()
				->with('message','Sorry, the file could not be uploaded. Pleas try again.');
			}
		} else {
			Session::flash('message', 'Please select a csv or xls file only');
		} */
		return redirect('/isolatedatatype/isolatetypecsvuploadview');
	}


    public function DataView()
    {
        return view('isolatedatatype.dataview');
    }


}
