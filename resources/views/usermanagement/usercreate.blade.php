@extends('layouts.amrlayout')

@section('content')
<div class="content-heading">
   <div><small data-localize="dashboard.WELCOME"></small></div><!-- START Language list-->
</div>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
       <div class="card">
            <div class="card-header">Create User</div>
              <div class="card-body">

                @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
                @endif

                    <form action="{{ url('/') }}/usermanagement/usersstore" method="POST">
                      {{ csrf_field() }}

                        <div class="form-group">
                          <label for="name">Name:</label>
                          <input type="text" class="form-control" autocomplete="off" id="name" name="name" onfocus="this.value=''" value="Type user name here" required>
                        </div>
 
                        <div class="form-group">
                          <label for="email">Email:</label>
                          <input type="email" class="form-control" autocomplete="off" id="email" name="email" onfocus="this.value=''" value="Type email address name here" required>
                        </div>
 
                        <div class="form-group">
                          <label for="password">Password:</label>
                          <input type="password" class="form-control" autocomplete="off" id="password" name="password" required>
                        </div>
						
						<div class="form-group">
							<label for="">Institution Name</label>
							<select name="institution" class="form-control" required>
							  <option selected disabled value=""> Select Institution </option>
							  @foreach($institutions as $row=>$val)
								  <option value="{{$val->institution_id}}"> {{$val->institution_name}} </option>
							  @endforeach
							</select>
						</div>

                        <div class="form-group">
                          <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
              </div>
        </div>
    </div>
  </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  
  $(document).ready(function() {
    $('#tableview').DataTable();
  });

  $(document).ready(function() {
    $('.alert').fadeout(3000);
  });

</script>
