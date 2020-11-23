@extends('layouts.amrlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

           @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
                @endif
          
          <h3 style="text-align: center; color:#5b92e5">List of Permission Name</h3>
          <hr style="border: 5px solid green"> 
      
          <br>  

          <div class="col">
            	<form action="{{url('/')}}/permission/save-permission" method="POST">
            		@csrf
				  <div class="row">
				  	@if(!auth('web')->user()->hasAnyPermission(['manage-permission-create','manage-permission-edit']))
					<div class="col-lg-6 col-12">						
						<div class="form-group">
							<h5>Permission Name<span class="text-danger">*</span></h5>
							<div class="controls">
								<input type="text" name="permission" class="form-control roleName @error('permission') is-invalid @enderror" required data-validation-required-message="This field is required"> </div>
						</div>						
						<div class="text-xs-right">
							<button type="submit" class="btn btn-info">Submit</button>
						</div>
						
        			</div>
        			@endif
        		</div>
        	</form>
        </div>
       
          <table class="table" id="tableview">
            <thead>
											<tr>
												<th>SL</th>
												<th>Permission Name</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@php $i=0; @endphp
											@foreach($permission as $row=>$val)
												<tr>
													<td>{{++$i}}</td>
													<td>{{$val->name}}</td>
													<td>
														@if(!auth('web')->user()->hasAnyPermission(['manage-permission-edit']))
															<button type="button" roleid="{{$val->id}}" rolename="{{$val->name}}" class="btn btn-warning btn-xs editRole" ><i class="fa fa-edit"></i> Edit</button>
														@endif
														@if(!auth('web')->user()->hasAnyPermission(['manage-permission-delete']))
															<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
														@endif
													</td>					
												</tr>
											@endforeach		
										</tbody>
										<tfoot>
											<tr>
												<th>SL</th>
												<th>Permission Name</th>
												<th>Action</th>
											</tr>
										</tfoot>
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



