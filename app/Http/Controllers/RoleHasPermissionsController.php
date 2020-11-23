<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Role;
use App\Permission;
use App\Role_has_permission;
use Session;
use PDF;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class RoleHasPermissionsController extends Controller
{


    
	public function RoleHasPermissionView(){

		 $rolehaspermissions = Role_has_permission::get();

		 //dd($rolehaspermissions);
         return view('usermanagement.rolehaspermissionview',compact('rolehaspermissions'));
	}

	public function RoleHasPermissionCreate(){
	      
		      $permissions = Permission::get();
              $roles = Role::get();

             // dd($permissions);

        return view('usermanagement.rolehaspermissioncreate',compact('permissions','roles'));
	}

    public function RoleHasPermissionStore(Request $request){

	 		$this->validate($request, [
            							'permission' => 'required',
           								'role' => 'required',
        							  ]);
	        
	        $user = Auth::user();
          $current_time = Carbon::now();


            //SET sql_mode = '';

            $storerolehaspermission = DB::table('role_has_permissions')->insert(['permission_id' => $request->permission, 'role_id' => $request->role,'created_by' => $user->id,'created_at' => $current_time]);

            //, 'created_at' => $current_time

            if('$storerolehaspermission') {
               Session::flash('message', 'New Role and Permission Relation is Created!');

               return redirect('/usermanagement/role_has_permissionsview');
                    
            }
    }




}
