@extends('layouts.amrlayout')

@section('content')
<div class="content-heading">
   <div>Dashboard<small data-localize="dashboard.WELCOME"></small></div><!-- START Language list-->
   <div class="ml-auto">
      <div class="btn-group"><button class="btn btn-secondary dropdown-toggle dropdown-toggle-nocaret" type="button" data-toggle="dropdown">English</button>
         <div class="dropdown-menu dropdown-menu-right-forced animated fadeInUpShort" role="menu"><a class="dropdown-item" href="#" data-set-lang="en">English</a><a class="dropdown-item" href="#" data-set-lang="es">Spanish</a></div>
      </div>
   </div><!-- END Language list-->
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Update User</div>
                <div class="card-body">
					@if(Session::has('message'))
					  <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
					@endif
                    <form action="{{ url('/') }}/usermanagement/updateuser" method="POST">
                      {{ csrf_field() }}
					  
					  <div class="form-group">
                          <label for="name">Name:</label>
                          <input type="text" class="form-control" autocomplete="off" id="name" name="name" value="{{$user->name}}" required>
                        </div>
 
                        <div class="form-group">
                          <label for="email">Email:</label>
                          <input type="email" class="form-control" autocomplete="off" id="email" name="email" value="{{$user->email}}" required>
                        </div>
 
                        <div class="form-group">
                          <label for="password">Password:</label>
                          <input type="password" class="form-control" autocomplete="off" id="password" name="password" value="">
                        </div>
						
						<div class="form-group">
							<label for="">Institution Name</label>
							<select name="institution" class="form-control" required>
							  <option selected disabled value=""> Select Institution </option>
							  @foreach($institutions as $row=>$val)
								  <option value="{{$val->institution_id}}" {{ ( $val->institution_id == $user->institution_id) ? 'selected' : '' }}> {{$val->institution_name}} </option>
							  @endforeach
							</select>
						</div>

                        <div class="form-group">
							<input type="hidden" class="form-control"  value="{{$user->id}}" name="user_id">
							<button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
