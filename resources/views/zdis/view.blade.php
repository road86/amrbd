@extends('layouts.amrlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
          @endif

          <h3 style="text-align: center; color:#5b92e5">Zone Diameter Interpretative Standard (ZDIS) Reference Table</h3>
          <hr style="border: 5px solid green"> 
      
          <br> 

          <table class="table" width="100%">
            <tr>
              <th scope="col" width="77.8%"><a class="btn btn-primary" href="{{ url('/') }}/zdis/create">Add Zone Diameter Interpretative Standard (ZDIS) Reference Data</a></th> 
              <th scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/zdis/excel">Export Excel</a></th> 
              <th scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/zdis/pdf">Export PDF</a></a></th> 
            </tr>
          </table>
       

	         <table id="tableview">
            <thead>
              <tr>
                <th scope="col">ZDIS ID</th>
                <th scope="col">Pathogen Name</th>
                <th scope="col">Antibiotic Name</th>
                <th scope="col">Sensitive (mm)</th>
                <th scope="col">Intermediate (mm)</th>
                <th scope="col">Resistance (mm)</th>
                <th scope="col">ESBL</th>
                <th scope="col">Created By</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 1; ?>
              @foreach($zdispathogen as $data)
              <tr>
                <th scope="row">{{ $count }}</th>
                <td>{{ $data->pathogen->pathogen_name }}</td>
                <td>{{ $data->antibiotic->antibiotic_name }}</td>
                <td style="text-align: center"><b>>={{ $data->sensitive_mm }}</b></td>
                <td style="text-align: center"><b>{{ $data->intermediate_mm }}</b></td>
                <td style="text-align: center"><b><={{ $data->resistance_mm }}</b></td>
                <td style="text-align: center"><b>{{ $data->esbl_mm }}</b></td>
                <td style="text-align: center">{{ $data->created_by }}</td>
                <td style="text-align: center">
                  <a class="btn btn-success btn-sm" href="{{ url('/zdis/edit-zdis-values/'.$data->zdis_id)}}">EDIT</a>

                  <a class="btn btn-danger btn-sm" href="{{ url('/zdis/delete-zdis-id/'.$data->zdis_id)}}">DELETE</a> 
                </td> 
              </tr>
              <?php $count++; ?>
              @endforeach
            </tbody>
          </table>
          <br><br>
<a class="btn btn-primary" href="{{ url('/') }}/zdis/create">Add Zone Diameter Interpretative Criteria (ZDIS) Data</a>
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
