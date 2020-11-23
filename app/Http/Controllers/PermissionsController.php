<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\User;
use Spatie\Permission\Models\Permission;
use Session;
use PDF;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    
	public function PermissionsView(){

		 $permissions = Permission::get();
         return view('usermanagement.permissionview',compact('permissions'));
	}

	public function PermissionsCreate(){

         return view('usermanagement.permissioncreate');
	}

    public function PermissionsStore(Request $request){

	 		$this->validate($request, [
            							'name' => 'required',
           								'guard_name' => 'required',
        							  ]);
	        
	        $user = Auth::user();
            $current_time = Carbon::now();
            $storepermission = Permission::create(['name' => $request->name,'created_by' => $user->id]); 

            if($storepermission) {
               Session::flash('message', 'New User Permission is Created!');

               return redirect('/usermanagement/permissionsview');
                    
            }
    }




}
