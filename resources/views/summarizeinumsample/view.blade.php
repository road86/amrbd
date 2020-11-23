@extends('layouts.amrlayout')

@section('content')
<div class="content-heading">
   <div><small data-localize="dashboard.WELCOME"></small></div><!-- START Language list-->
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          
          @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
          @endif

          <h3 style="text-align: center; color:#5b92e5">Summarize Isolate Sample Data (#)</h3>
          <hr style="border: 5px solid green">
          
          <table class="table" width="100%">
            <tr>
              <th scope="col" width="70%"><a class="btn btn-primary" href="{{ url('/') }}/summarizeinumsample/create"><h4>Insert Summarize Isolate Numeric Data</h4></a></th> 

              <th scope="col"><a class="btn btn-primary" href="{{ url('/') }}/summarizeinumsample/pdf"><h4>Export Pdf</h4></a></th> 

              <th scope="col"><a class="btn btn-primary" href="{{ url('/') }}/summarizeinumsample/export"><h4>Export  Excel</h4></a></h4></a></th> 
            </tr>
          </table>
        </div> 
 
          <table id="tableview">

            <thead>
              <tr>
                <th scope="col">Cluster Sample ID</th>
                <th scope="col">Testing Date From</th>
                <th scope="col">Testing Date To</th>
                <th scope="col">Institution Name</th>
                <th scope="col">Species Name</th>
                <th scope="col">Location on the body(Specimen)</th>
                <th scope="col">Pathogen Name</th>
           {{-- <th scope="col">Number of Isolate Tested</th>
                <th scope="col">Sensitivity Pattern</th>
           --}}
                <th scope="col">Created By</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
             <tbody>
              <?php $count = 1; ?>
              @foreach($summarizeinumsample as $data=>$val)
              <tr>
                <th scope="row">{{ $count }}</th>
                
                <td>{{ $val->test_date_from }}</td>
                <td>{{ $val->test_date_to }}</td>
                <td>{{ $val->institution->institution_name }}</td>
                <td>{{ $val->species->species_name }}</td>
                <td>{{ $val->Specimen->specimen_name}}</td>                 
                <td>{{ $val->pathogen->pathogen_name }}</td>

                {{-- <td>{{ $val->no_of_isolate_tested }}</td>
                <td>{{ $val->sensitivity_pattern }}</td>
                --}}
                
                <td>{{ $val->created_by }}</td>
                <td>
                  <a class="btn btn-danger btn-sm" href="{{ url('/summarizedinumsample/delete-sglisample-id/'.$val->sample_id)}}">DELETE</a>
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
