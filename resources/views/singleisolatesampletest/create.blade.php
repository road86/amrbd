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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Fill the Individual Isolate Sample Test Data</h4></div>

                <div class="card-body">
                  @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
                  @endif

        <form action="{{ url('/') }}/singleisolatesampletest/store" method="POST">
           {{ csrf_field() }}
                
      <input type="hidden" name="sample_id" value="{{$sampleDetails->sample_id}}">
           <input type="hidden" name="pathogen_id" value="{{$sampleDetails->pathogen_id}}">
                        
        <table id=tableview width="100%">
            <thead>
              <tr>
                <th scope="col">Antibiotic Name</th>
                <th scope="col">Test Result</th>
               </tr>
            </thead>
           
            <tbody>
             @foreach($antibiotic as $row=>$val)
                <tr>
                     <td id="antibiotic_name_{{$val->antibiotic_id}}"><label><input class="antibiotic_name antibiotic_name_{{$val->antibiotic_id}}" type="checkbox" value="{{$val->antibiotic_id}}" name="antibiotics[]"> <b>{{$val->antibiotic_name}}</b></label>
                     </td>
                     <td id="antibiotic_checkbox_{{$val->antibiotic_id}}">
                       @foreach($testsensitivity as $row=>$valts)
                                     
                  <label><input class="checkbox_result checkRequir{{$val->antibiotic_id}}" antibiotic_id="{{$val->antibiotic_id}}"  type="radio" value="{{$valts->test_sensitivity_id}}" name="testsensitivity[{{$val->antibiotic_id}}]" disabled> {{$valts->test_sensitivity_type}}</label> 
                      @endforeach
                     </td>
                  </tr>
                  @endforeach
              </tbody>
          
          

                    <tr>
                      <td>
                      </td>
                      <td style="text-align: right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </td>
                    </tr>
                    </table>
                  </table>

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
        $('.checkRequir'+antibiotic_id).attr("required", false );   
        $('.antibiotic_name_'+antibiotic_id).attr("required", false );
        $('.checkRequir'+antibiotic_id).attr("disabled", true );
        
      }
      
      if($(this).prop("checked") == true) {
        $('.checkRequir'+antibiotic_id).attr("required", true );
        $('.checkRequir'+antibiotic_id).attr("disabled", false );
      }
    });

    $(".checkbox_result").click(function() {
      var antibiotic_id = $(this).attr('antibiotic_id');
      $('.antibiotic_name_'+antibiotic_id).attr("required", true );
      //console.log(antibiotic_id);
    });

  });

</script>

@endsection
