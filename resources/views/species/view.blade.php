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

           <h3 style="text-align: center; color:#5b92e5">List of Species</h3>
          <hr style="border: 5px solid green"> 
      
          <br>  

          <table class="table" width="100%">
              <tr>
               <th scope="col" width="77.8%"><a class="btn btn-primary" href="{{ url('/') }}/species/create">Add New Species Name</a></th> 
               <th scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/species/excel">Export Excel</a></th> 
               <th scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/species/pdf">Export PDF</a></th> 
              </tr>
          </table>

           <table id="tableview">
            <thead>
              <tr>
                <th scope="col">SL #</th>
                <th scope="col">Species Name</th>
                <th scope="col">Created By</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 1; ?>
              @foreach($species as $data)
              <tr>
                <th scope="row">{{ $count }}</th>
                <td>{{ $data->species_name }}</td>
                <td style="text-align: center">{{ $data->created_by }}</td>
                <td style="text-align: center">
                  
                  <a class="btn btn-success btn-sm" href="{{ url('/species/edit-species-name/'.$data->species_id)}}">EDIT</a>                 
              
                  <form action="{{ url('/species/delete-species-id/'.$data->species_id) }}" method="POST">
                    <a class="btn btn-danger btn-sm" href="#">DELETE</a> 
                  </form> 
   
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
