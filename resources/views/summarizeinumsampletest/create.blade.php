@extends('layouts.amrlayout')
@section('content')
<div class="content-heading">
   <div>Dashboard<small data-localize="dashboard.WELCOME"></small></div><!-- START Language list-->
   <div class="ml-auto">
      <div class="btn-group"><button class="btn btn-secondary dropdown-toggle dropdown-toggle-nocaret" type="button" data-toggle="dropdown">English</button>
         <div class="dropdown-menu dropdown-menu-right-forced animated fadeInUpShort" role="menu"><a class="dropdown-item" href="#" data-set-lang="en">English</a><a class="dropdown-item" href="#" data-set-lang="es">Spanish</a></div>
      </div>
   </div><!-- END Language list-->
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>Fill the Summarize Isolate Numeric Test Data</h4></div>

                <div class="card-body">

        <form action="{{ url('/') }}/summarizeinumsampletest/store" method="POST">
           {{ csrf_field() }}
                
      <input type="hidden" name="sample_id" value="{{$sampleDetails->sample_id}}">
           <input type="hidden" name="pathogen_id" value="{{$sampleDetails->pathogen_id}}">
                        
        <table id=tableview width="100%">
            <thead>
              <tr>
                <th scope="col">Antibiotic Name</th>
                <th scope="col">Total Number of Samples(#)</th>
                <th scope="col">Test Result Reisistance (#)</th>
                <th scope="col">Test Result Intermediate (#)</th>
               </tr>
            </thead>
           
            <tbody>
             @foreach($antibiotic as $row=>$val)
                <tr>
                    
                      <td><label><input type="checkbox" value="{{$val->antibiotic_id}}" 
                      name="antibiotics[]"><b>{{$val->antibiotic_name}}</b></label> </td>

                      <td> <label> <input type="number" class="form-control" value="{{$val->total_num_of_samples}}"  name="total_num_of_samples[{{$val->antibiotic_id}}]"> </label></td>

                      <td> <label> <input type="number" class="form-control" value="{{$val->test_result_num_resistance}}"  name="test_result_num_resistance[{{$val->antibiotic_id}}]"> </label></td>

                      <td> <label> <input type="number" class="form-control" value="{{$val->test_result_num_intermediate}}"  name="test_result_num_intermediate[{{$val->antibiotic_id}}]"> </label></td>

                  </tr>
                  @endforeach
              </tbody>
          </table>
          <br><br>
          <button type="submit" class="btn btn-primary form_submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script>

  $(document ).ready(function() {
      
    $(".antibiotic_name").click(function() {
      var antibiotic_id = $(this).val();
      if($(this).prop("checked") == false) {
        $('#antibiotic_checkbox_'+antibiotic_id).find('input[type=radio]:checked').prop("checked", false );
        //console.log('unchecked');
      }
    });

    $(".checkbox_result").click(function() {
      var antibiotic_id = $(this).val();
      $('#antibiotic_name_'+antibiotic_id).find('input[type=checkbox]:checked').prop("checked", true);
      console.log($('#antibiotic_name_'+antibiotic_id).find('input[type=checkbox]:checked'));
    });

  });

</script>

@endsection
