@extends('layouts.amrlayout')

@section('content')
<div class="content-heading">
   <div><small data-localize="dashboard.WELCOME"></small></div><!-- START Language list-->
</div>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
       <div class="card">
            <div class="card-header">Cerate Permission</div>
              <div class="card-body">

                    <form action="{{ url('/') }}/usermanagement/permissionsstore" method="POST">
                      {{ csrf_field() }}

                        <div class="form-group">
                          <label for="name">Permission Name:</label>
                          <input type="text" class="form-control" autocomplete="off" id="name" name="name" onfocus="this.value=''" value="Type permission name here" required>
                        </div>
 
                        <div class="form-group">
                          <label for="guard_name">Permission Type:</label>
                          <input type="text" class="form-control" autocomplete="off" id="guard_name" name="guard_name" onfocus="this.value=''" value="Type permission here" required>
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
