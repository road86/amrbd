@extends('layouts.amrlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

           @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
                @endif
          
          <h3 style="text-align: center; color:#5b92e5">List of User Roles</h3>
          <hr style="border: 5px solid green"> 
      
          <br>  

          <table class="table" width="100%">
            <tr>
              <th scope="col" width="77.8%"><a class="btn btn-primary" href="{{ url('/') }}/usermanagement/rolescreate">Create New Use Role</a></th> 
              <th scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/usermanagement/excel">Export Excel</a></th> 
              <th scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/usermanagement/pdf">Export PDF</a></th> 
            </tr>
          </table>
       
          <table class="table" id="tableview">
            <thead>
              <tr>
                <th scope="col">SL #</th>
                <th scope="col">Role Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
              <tbody>
				@php $i=0; @endphp
				@foreach($role as $row=>$val)
					<tr>
						<td>{{++$i}}</td>
						<td>{{$val->name}}</td>
						<td>
							@if(!auth('web')->user()->hasAnyPermission(['manage-role-edit']))
								<button type="button" roleid="{{$val->id}}" rolename="{{$val->name}}" class="btn btn-warning btn-xs editRole" ><i class="fa fa-edit"></i> Edit</button>
							@endif
							@if(!auth('web')->user()->hasAnyPermission(['manage-role-delete']))
								<button type="button" roleid="{{$val->id}}" data-toggle="modal" data-target="#modal-center" class="btn btn-danger btn-xs deleteRole"><i class="fa fa-trash"></i> Delete</button>
							@endif
						</td>					
					</tr>
				@endforeach		
			</tbody>
          </table>

        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  
  $(document).ready(function() {
    $('#tableview').DataTable();
  });

  $(document).ready(function() {
    $('.alert').fadeout(3000);
  });

</script>
@endsection



