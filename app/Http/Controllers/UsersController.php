<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Institutions;
use Session;
use PDF;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class UsersController extends Controller
{
    
	public function ManagementView(){

		return view('usermanagement.mgtview');  
	}

	public function UserView(){
		$user = User::with('institution')->get();
		
		//$user = User::get();
        return view('usermanagement.userview',compact('user'));
	}

	public function UserCreate(){
		$institutions = Institutions::get();
        return view('usermanagement.usercreate',compact('institutions'));
	}

    public function UserStore(Request $request){

	 		$this->validate($request, [
            							'name' => 'required',
           								'email' => 'required',
            							'password' => 'required',
										'institution' => 'required',
        							  ]);
	        
	        $user = Auth::user();
            $current_time = Carbon::now();

            $storeuser = User::create([
				'name' => $request->name,
				'email' => $request->email,
				'institution_id' => $request->institution,
				'password' => Hash::make($request->password),
				'created_by' => Auth::user()->id,
			]);
       

            if('$storeuser') {
               Session::flash('message', 'New User is Created!');
               return redirect('/usermanagement/usersview');
            }
    }
   
	public function EditUsersName($id)
	{
		$institutions = Institutions::get();
		//$user = User::find($id);
		$user = User::with('institution')->find($id);
  
		return view('usermanagement.edit',compact('user','institutions'));
	}
	
	public function UpdateUser(Request $request) 
	{
		/* var_dump($request);
		die(); */
		
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required',
			'institution' => 'required',
		]);
		
		$user = User::find($request->user_id);
		$user->name = $request->name;
		$user->email = $request->email;
		$user->institution_id = $request->institution;
	   
		if($user->save()) {
			Session::flash('message', 'User is Updated!');
			return redirect('/usermanagement/usersview');
		}
	   
		
	}

    public function export(){
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
