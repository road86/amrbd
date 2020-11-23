@extends('layouts.amrlayout')

@section('content')


<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

        @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
          @endif

          <h3 style="text-align: center; color:#5b92e5">List of Institutions</h3>
          <hr style="border: 5px solid green"> 
      
          <br>        

        <!--  <a class="btn btn-primary" href="{{ url('/') }}/institution/create">Add New Institution Name</a>
          <a class="btn btn-primary" href="{{ url('/') }}/institution/excel">Export Excel</a>
          <a class="btn btn-primary" href="{{ url('/') }}/institution/pdf">Export PDF</a> -->


          <table class="table" width="100%">
              <tr>
               <td scope="col" width="77.8%"><a class="btn btn-primary" href="{{ url('/') }}/institution/create">Add New Institution Name</a></td> 
                <!-- @can('institution-add') 
               <td scope="col" width="77.8%"><a class="btn btn-primary" href="{{ url('/') }}/institution/create">Add New Institution Name</a></td> 
               @endcan -->
               <td scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/institution/excel">Export Excel</a></td> 
               <td scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/institution/pdf">Export PDF</a></td> 
              </tr>
          </table>
       

	<table id="tableview">
            <thead>
              <tr>
                <th scope="col">SL #</th>
                <th scope="col">Institution Name</th>
                <th scope="col">Created By</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 1; ?>
              @foreach($institution as $data)
              <tr>
                <th scope="row">{{ $count }}</th>
                <td>{{ $data->institution_name }}</td>
                <td style="text-align: center">{{ $data->created_by }}</td>
                <td style="text-align: center">
              
                  <a class="btn btn-success btn-sm" href="{{ url('/institution/edit-institution-name/'.$data->institution_id)}}">EDIT</a>

                 
                  <a class="btn btn-danger btn-sm" href="{{ url('/institution/delete-institution-id/'.$data->institution_id)}}">DELETE</a> 
                  

                </td> 
              </tr>
              <?php $count++; ?>
              @endforeach
            </tbody>
          </table>
          <br><br>
<a class="btn btn-primary" href="{{ url('/') }}/institution/create">Add New Institution Name</a>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#tableview').DataTable();
  });

    $(document).ready(function(){
    $('.alert').fadeOut(3000);
  });
</script>

@endsection
