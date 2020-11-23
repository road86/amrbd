<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\User;
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

		 $user = User::get();
         return view('usermanagement.userview',compact('user'));
	}

	public function UserCreate(){

         return view('usermanagement.usercreate');
	}

    public function UserStore(Request $request){

	 		$this->validate($request, [
            							'name' => 'required',
           								'email' => 'required',
            							'password' => 'required',
        							  ]);
	        
	        $user = Auth::user();
            $current_time = Carbon::now();


            $storeuser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_by' => Auth::user()->id,
        ]);
       

            if('$storeuser') {
               Session::flash('message', 'New User is Created!');
               return redirect('/usermanagement/usersview');
            }
    }
   

    public function export(){
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
