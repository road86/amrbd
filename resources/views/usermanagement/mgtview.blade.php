@extends('layouts.amrlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          
         <h3 style="text-align: center; color:#5b92e5">User Management</h3>
          <hr style="border: 5px solid green"> 

       
   
        
        <a class="btn btn-primary" href="{{ url('/') }}/usermanagement/usersview"><h3>User</h3></a>

        <br><br>
        <a class="btn btn-primary" href="{{ url('/') }}/permission/manage-role"><h3>Role</h3></a>

        <br><br>
        <a class="btn btn-primary" href="{{ url('/') }}/permission/manage-permission"><h3>Permission</h3></a> 

        
        <a class="btn btn-primary" href="{{ url('/') }}/permission/assign-role-permission"><h3>Role has permission</h3></a>  

        <a class="btn btn-primary" href="{{ url('/') }}/permission/user-role"><h3>User Role</h3></a> 

        </div>
    </div>
</div>
@endsection
