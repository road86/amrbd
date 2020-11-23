@extends('layouts.amrlayout')

@section('content')
<div class="content-heading">
   <div><small data-localize="dashboard.WELCOME"></small></div><!-- START Language list-->
</div>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
       <div class="card">
            <div class="card-header">Cerate New Permission and Role Relation</div>
              <div class="card-body">

                    <form action="{{ url('/') }}/usermanagement/role_has_permissionsstore" method="POST">
                      {{ csrf_field() }}

                        <div class="form-group">
                          <table id="tableview" align="center">
                          <tr>
                          <td>
                          <label for=""><h4 style="color:green">Permission Name</h4></label>
                          <select name="permission" class="form-control" required>
                            <option selected disabled value=""> Select Permission</option>
                               @foreach($permissions as $row=>$val)
                                <option value="{{$val->id}}"> {{$val->name}} </option>
                                @endforeach
                          </select>
                        </td>
                        <td>
                         <label for=""><h4 style="color:green">Role Name</h4></label>
                          <select name="role" class="form-control" required>
                            <option selected disabled value=""> Select Role</option>
                              @foreach($roles as $row=>$val)
                                <option value="{{$val->id}}"> {{$val->name}} </option>
                              @endforeach
                          </select>
                        </td>
                      </tr>
                    </table>
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
