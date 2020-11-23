<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Auth;
Use Alert;

class ManagePermissionController extends Controller
{
	private $viewFolderPath = 'manage_permission/';
	public function __construct()
    {                                        
       $this->middleware('auth');
    }

    public function role(){
        if(auth('web')->user()->hasAnyPermission(['User management']))
        {
        	$role = Role::get();
        	return view($this->viewFolderPath.'role', compact('role'));
        }
        else{
             return view('unauthorize');
        }
    }

    public function saveRole(Request $request){        
    	$this->validate($request,[
         'role'=>'required'
     	 ]);

     	 if ($request->roleid) {
            if(auth('web')->user()->hasAnyPermission(['User management'])){                
             $role = Role::where('id',$request->roleid)->update(['name' => $request->role ]);
             if ($role) {
                 Alert::toast('Role updated Successfully', 'success');
             }
             else{
                 Alert::error('Failed', 'Try again or contact with User');
             }
            }
            else{
             return view('unauthorize');
            }
     	}  
     	else{
            if(auth('web')->user()->hasAnyPermission(['User management'])){ 
                $role = Role::create(['guard_name' => 'web', 'name' => $request->role]);
                if ($role) {
                 Alert::toast('Role Added Successfully', 'success');
                 }
                 else{
                     Alert::error('Failed', 'Try again or contact with User');
                 }
            }
            else{
             return view('unauthorize');
            }
     	}  	
    	return redirect()->back();
    }

    public function deleteRole($id){
        if(auth('web')->user()->hasAnyPermission(['User management']))
        {
            $role = Role::findOrFail($id); $role->delete();
            if ($role) 
            {
             Alert::toast('Role Removed', 'success');
             }
            else{
                 Alert::error('Failed', 'Try again or contact with User');
             }
         }
        else{
            return view('unauthorize');
        }
        return redirect()->back();
    }

    public function permission(){
        if(auth('web')->user()->hasAnyPermission(['User management']))
        {
        	$pageName = "Manage Role & Permission";
            $breadcrumb = ['Manage Permission','Permission'];	
        	$permission = Permission::get();
        	return view($this->viewFolderPath.'permission', compact('permission','pageName','breadcrumb'));
        }
        else{
             return view('unauthorize');
        }
    }

    public function savePermission(Request $request){
    	$this->validate($request,[
         'permission'=>'required'
     	 ]);
    	if ($request->roleid) {
            if(auth('web')->user()->hasAnyPermission(['User management'])){   
     	     $role = Permission::where('id',$request->roleid)->update(['name' => $request->permission ]); 
             if ($role) {
                 Alert::toast('Permission updated Successfully', 'success');
             }
             else{
                 Alert::error('Failed', 'Try again or contact with User');
             }
            }
            else{
             return view('unauthorize');
            }
     	}  
     	else{
            if(auth('web')->user()->hasAnyPermission(['User management'])){   
    		  $role = Permission::create(['guard_name' => 'web', 'name' => $request->permission,'created_by'=>Auth::user()->id]); 
              if ($role) {
                 Alert::toast('Permission Added Successfully', 'success');
             }
             else{
                 Alert::error('Failed', 'Try again or contact with User');
             }
            }
            else{
             return view('unauthorize');
            }
     	} 
     	 return redirect()->back();
    }    

    public function userRole(){
        if(auth('web')->user()->hasAnyPermission(['User management'])){            
            $pageName = "Manage Role & Permission";
            $breadcrumb = ['Manage Permission','User Role'];
            $role = Role::get();
            $admin  = User::get();
            return view($this->viewFolderPath.'assign-role', compact('pageName','breadcrumb','role','admin'));
        }
        else{
             return view('unauthorize');
        }

    }

    public function selectUserRole($id){
    	$user = User::where('id',$id)->first();
    	return $user->getRoleNames();

    }

    public function saveUserRole(Request $request){
        if(auth('web')->user()->hasAnyPermission(['User management'])){  
        	$user = User::where('id',$request->user)->first();
        	$uRole=$user->syncRoles($request->role);
            if ($uRole) {
                 Alert::toast('Role Assigned Successfully', 'success');
             }
             else{
                 Alert::error('Failed', 'Try again or contact with User');
             }
        	return redirect()->back();
        }
        else{
             return view('unauthorize');
        }
    }

    // public function userPermission(){
    //     if(auth('web')->user()->hasAnyPermission(['user-permission-create','user-permission-view','user-permission-edit','user-permission-delete']))
    //     {
    //         $pageName = "Manage Role & Permission";
    //         $breadcrumb = ['Manage Permission','User Permission'];
    //         $role = Role::get();
    //         $admin  = User::get();
    //         return view($this->viewFolderPath.'assign-permission', compact('pageName','breadcrumb','role','admin '));
    //     }
    //     else{
    //         return view('unauthorize');
    //     }
    // }

    // public function saveUserPermission(Request $request){    	
    //     if(auth('web')->user()->hasAnyPermission(['user-permission-create','user-permission-edit'])){  
    //     	$user = User::where('User_row_id',$request->user)->first();
    //     	$uRole=$user->syncPermissions($request->permission);
    //         if ($uRole) {
    //              Alert::toast('Permission Added Successfully', 'success');
    //          }
    //          else{
    //              Alert::error('Failed', 'Try again or contact with User');
    //          }

    //     	return redirect()->back();
    //     }
    //     else{
    //          return view('unauthorize');
    //     }
    // }

    public function selectUserPermission($id){
    	$user = User::where('User_row_id',$id)->first();
    	$permission =  $user->getDirectPermissions();
    	$allPermissionName = array();
    	foreach ($permission as $key => $value) {
    		$allPermissionName[] = $value->name;
    	}
    	return $allPermissionName;
    }

    public function rolePermission(){
        if(auth('web')->user()->hasAnyPermission(['User management']))
        {
            $pageName = "Manage Role & Permission";
            $breadcrumb = ['Manage Permission','Assign Role to Permission'];
            $role = Role::get();
            $permission = Permission::get();
            return view($this->viewFolderPath.'assign-role-permission', compact('permission','pageName','breadcrumb','role'));
        }
        else{
            return view('unauthorize');
        }
    }

    public function selectRolePermission($id){    	
    	return Role::findById($id)->permissions()->pluck('name');
    }

    public function saveRolePermission(Request $request){
        if(auth('web')->user()->hasAnyPermission(['User management']))
        {
        	Permission::where('id',$request->role)->delete();
        	$role=Role::where('id',$request->role)->first();
        	$uRole=$role->syncPermissions($request->permission);
            if ($uRole) {
                 Alert::toast('Permission Added to Role', 'success');
             }
             else{
                 Alert::error('Failed', 'Try again or contact with User');
             }
        	return redirect()->back();
        }
        else{
            return view('unauthorize');
        }
    }
}
