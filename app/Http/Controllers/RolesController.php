<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Role;
use Session;

use PDF;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    
	public function RolesView(){

		 $roles = Role::orderBy('name', 'asc')->get();
         return view('usermanagement.roleview',compact('roles'));
	}

	public function RolesCreate(){

         return view('usermanagement.rolecreate');
	}

    public function RolesStore(Request $request){

	 		$this->validate($request, [
            							'name' => 'required',
        							  ]);
	        
	        $user = Auth::user();
            $current_time = Carbon::now();


            $storerole = DB::table('roles')->insert(['name' => $request->name, 'guard_name' =>'web','created_by' => $user->id, 'created_at' => $current_time]);

            if($storerole) {
               Session::flash('message', 'New User Role is Created!');

               return redirect('/permission/manage-role');
                    
            }
    }




}
