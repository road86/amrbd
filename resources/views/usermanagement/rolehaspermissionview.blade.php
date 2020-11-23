@extends('layouts.amrlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

           @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
                @endif
          
          <h3 style="text-align: center; color:#5b92e5">List of Role has Permission Users</h3>
          <hr style="border: 5px solid green"> 
      
          <br>  

          <table class="table" width="100%">
            <tr>
              <th scope="col" width="77.8%"><a class="btn btn-primary" href="{{ url('/') }}/usermanagement/role_has_permissionscreate">Create New Use Permission Type</a></th> 
              <th scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/usermanagement/excel">Export Excel</a></th> 
              <th scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/usermanagement/pdf">Export PDF</a></th> 
            </tr>
          </table>
       
          <table class="table" id="tableview">
            <thead>
              <tr>
                <th scope="col">SL #</th>
                <th scope="col">Permission Name</th>
                <th scope="col">Role Name</th>
                <th scope="col">Created By</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 1; ?>

              @foreach($rolehaspermissions as $data)
              <tr>
                <th scope="row">{{ $count }}</th>
                <td style="text-align: center">{{ $data->permission_id }}</td>
                <td style="text-align: center">{{ $data->role_id }}</td>
                <td style="text-align: center">{{ $data->created_by }}</td>
                
                <td style="text-align: center">
                  
                  <a class="btn btn-success btn-sm" href="{{ url('/usermanagement/edit-permission-role-info/'.$data->id) }}">EDIT</a>

                  <a class="btn btn-danger btn-sm" href="{{ url('/usermanagement/delete-permission-role-info/'.$data->id)}}">DELETE</a>

                </td> 
              </tr>
              <?php $count++; ?>
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
