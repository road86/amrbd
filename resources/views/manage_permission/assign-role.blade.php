@extends('layouts.amrlayout')

@section('content')
<style type="text/css">
	fieldset {
    padding-bottom: 0px;
    border-bottom: 1px dashed #eee;
    margin-bottom: 0px;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

           @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
                @endif
          
          <h3 style="text-align: center; color:#5b92e5">Assign User Role</h3>
          <hr style="border: 5px solid green"> 
      
          <br>  

          <div class="row">
            <div class="col">
            	<form action="{{url('/')}}/permission/assign-role" method="POST">
            		@csrf
				  <div class="row">
					<div class="col-lg-6 col-12">						
						<div class="form-group">
							<h5>Select User <span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="user" id="select" required class="form-control">
									<option value="">Select User</option>
									@foreach($admin as $row=>$val)
									<option value="{{$val->id}}">{{$val->name}}</option>	
									@endforeach
								</select>
							</div>
						</div>
						
        			</div>
        			<div class="col-lg-6 col-12">
						<div class="col-12">         
					         <div class="box">
					            <div class="box-header with-border">
					              <h3 class="box-title">All Role  List</h3>
					            </div>
					            <!-- /.box-header -->
					            <div class="box-body">
					            	@if(!auth('web')->user()->hasAnyPermission(['user-role-view','user-role-create','user-role-edit']))
					            	<div class="form-group">
										<h5>Select Role <span class="text-danger">*</span></h5>
										<div class="controls">
											@foreach($role as $row=>$role)
												<fieldset>
													<input type="checkbox" name="role[]" id="{{$role->name}}" value="{{$role->name}}">
													<label for="{{$role->name}}">{{$role->name}}</label>
												</fieldset>								
											@endforeach
										</div>
									</div>
									@endif
									@if(!auth('web')->user()->hasAnyPermission(['user-role-create','user-role-edit']))
									<div class="text-xs-right">
										<button type="submit" class="btn btn-info">Save Setting</button>
									</div>
									@endif
					            </div>
					            <!-- /.box-body -->
					          </div>
					          <!-- /.box -->      
					        </div>  
        		  	</div>
        			</div>
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
		$('#select').on("change",function(e){
		var id =  $(this).val();
		 $("[type='checkbox']").prop('checked', false);
			$.ajax({
				url: "{{ url('get-user-role/') }}"+ '/'+ id,
				type: "GET",
				dataType: "html",
				success: function(data){
					$.each( JSON.parse(data), function( key, value ) {
						console.log(value);
			            $("#"+value).prop('checked', true);
			          });
				}
			});
		});	
	});
</script>
@endsection



