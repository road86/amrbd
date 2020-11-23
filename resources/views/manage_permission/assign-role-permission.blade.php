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

          <div class="row">
            <div class="col">
            	<form action="{{url('/')}}/permission/assign-permission-role" method="POST">
            		@csrf
				  <div class="row">
					<div class="col-lg-6 col-12">						
						<div class="form-group">
							<h5>Select Role <span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="role" id="select" required class="form-control">
									<option value="">Select Role</option>
									@foreach($role as $row=>$val)
									<option value="{{$val->id}}">{{$val->name}}</option>	
									@endforeach
								</select>
							</div>
						</div>
						
        			</div>
        		  </div>
        		   @include('manage_permission/permissionlist')
        		   @if(!auth('web')->user()->hasAnyPermission(['manage-assign-permission-create','manage-assign-permission-edit']))
        		    <div class="text-xs-right">
						<button type="submit" class="btn btn-info">Submit</button>
					</div>
					@endif
				</form>            	
            </div>
            <!-- /.col -->
          </div>

        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  
  $(document).ready(function() {
    $('#tableview').DataTable();
    $('#select').on("change",function(e){
		var id =  $(this).val();
		 $("[type='checkbox']").prop('checked', false);
			$.ajax({
				url: "{{ url('get-role-permission/') }}"+ '/'+ id,
				type: "GET",
				dataType: "html",
				success: function(data){
					$.each( JSON.parse(data), function( key, value ) {
						value = value.replace(/\s+/g, '-')
						console.log(value);
			            $("#"+value).prop('checked', true);
			          });
				}
			});
		});
  });

  $(document).ready(function() {
    $('.alert').fadeout(3000);
  });

</script>
@endsection



