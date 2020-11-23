@extends('layouts.amrlayout')
@section('content')
    <!-- Main content -->
    <section class="content">     
     <!-- Basic Forms -->
      <div class="box box-solid bg-dark">
        <div class="box-header with-border">
          <h4 class="box-title">Manage Role & Permission</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col">
            	<form action="{{url('/')}}/permission/assign-permission" method="POST">
            		@csrf
				  <div class="row">
					<div class="col-lg-6 col-12">						
						<div class="form-group">
							<h5>Select User <span class="text-danger">*</span></h5>
							<div class="controls">
								<select name="user" id="select" required class="form-control">
									<option value="">Select User</option>
									@foreach($admin as $row=>$val)
									<option value="{{$val->admin_row_id}}">{{$val->admin_name}}</option>	
									@endforeach
								</select>
							</div>
						</div>
						
        			</div>
        		  </div>
        		  @include('backend/school_admin/manage_permission/permissionlist')

        		  @if(!auth('web')->user()->hasAnyPermission(['user-permission-create','user-permission-edit']))
        		  <div class="text-xs-right">
						<button type="submit" class="btn btn-info">Submit</button>
					</div>
				  @endif
				</form>            	
            </div>
          </div>
        </div>
      </div>
 </section>

<script type="text/javascript">
	$(document).ready(function() {
		$('#select').change(function(e){
		var id =  $(this).val();
		 $("[type='checkbox']").prop('checked', false);
			$.ajax({
				url: "{{ url('get-user-permission/') }}"+ '/'+ id,
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