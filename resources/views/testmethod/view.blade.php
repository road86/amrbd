@extends('layouts.amrlayout')

@section('content')
<div class="content-heading">
   <div>Dashboard<small data-localize="dashboard.WELCOME"></small></div><!-- START Language list-->
</div>

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
          @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
          @endif

          <h3 style="text-align: center; color:#5b92e5">List of Test Methods</h3>
          <hr style="border: 5px solid green"> 
      
          <br> 
          
          <table class="table" width="100%">
            <tr>
              <th scope="col" width="77.8%"><a class="btn btn-primary" href="{{ url('/') }}/testmethod/create">Add New Test Method</a></a></th> 
              <th scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/testmethod/excel">Export Excel</a></th> 
              <th scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/testmethod/pdf">Export PDF</a></a></th> 
            </tr>
          </table>
       
          <table class="table" id="tableview">
            <thead>
              <tr>
                <th scope="col">Test Method ID</th>
                <th scope="col">Test Method Name</th>
                <th scope="col">Created By</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 1; ?>
              @foreach($testmethods as $data)
              <tr>
                <th scope="row">{{ $count }}</th>
                <td>{{ $data->test_method_name }}</td>
                <td style="text-align: center">{{ $data->created_by }}</td>
                <td style="text-align: center">
                  
                  {{--  Commented Edit button   
                  <a class="btn btn-success btn-sm" style="color: #fff;">Edit</a>
                  --}}
                 
                  <a class="btn btn-success btn-sm" href="{{ url('/testmethod/edit-test-method/'.$data->test_method_id)}}">EDIT</a>

            
                  <a class="btn btn-danger btn-sm" href="{{ url('/testmethod/delete-test-method/'.$data->test_method_id)}}">DELETE</a>
          

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

  $(document).ready(function(){
    $('.alert').fadeOut(3000);
  });

</script>
@endsection
