@extends('layouts.amrlayout')
@section('content')

<div class="content-heading">
   <div>Dashboard<small data-localize="dashboard.WELCOME"></small></div><!-- START Language list-->
  
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <h4>Fill the Individual Isolate Sample Test Data (mm)</h4>

                  <button class="btn btn-primary zdis_table" data-toggle="modal" data-target="#zdisModal" data-backdrop="false">ZDIS Reference Table</button>

                </div>

                <div class="card-body">
                  @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
                  @endif

        <form action="{{ url('/') }}/singleisolatezdissampletest/store" method="POST">
           {{ csrf_field() }}
                
      <input type="hidden" name="sample_id" value="{{$sampleDetails->sample_id}}">
           <input type="hidden" name="pathogen_id" value="{{$sampleDetails->pathogen_id}}">
                        
        <table id=tableview width="100%">
            <thead>
              <tr>
                <th scope="col">Antibiotic Name</th>
                <th scope="col">Test Result in ZDIS (mm)</th>
               </tr>
            </thead>
           
            <tbody>
             @foreach($antibiotic as $row=>$val)
                <tr>
                     <td><label><input type="checkbox" class="antibiotic_name" value="{{$val->antibiotic_id}}" 
                      name="antibiotics[]" >{{$val->antibiotic_name}}</label> </td>
                    
                    <td> <label> <input type="number" id="val_{{$val->antibiotic_id}}" class="form-control" value="{{$val->zdis_mm}}"  name="zdis_mm[{{$val->antibiotic_id}}]" disabled> </label></td>

                 </tr>
              @endforeach
              </tbody>
          </table>
          <br><br>
          <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="zdisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 50px;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zone Diameter Interpretive Standards (ZDIS) Reference Table for Pathogens and Antimicrobial Agents</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- table from database -->

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
               
              </tr>
            </thead>
            <tbody>
              <?php $count = 1; ?>
              @foreach($zdispathogen as $data)
              <tr>
                <th scope="row">{{ $count }}</th>
                <td>{{ $data->pathogen->pathogen_name }}</td>
                <td>{{ $data->antibiotic->antibiotic_name }}</td>
                <td>>={{ $data->sensitive_mm }}</td>
                <td>{{ $data->intermediate_mm }}</td>
                <td><={{ $data->resistance_mm }}</td>
                <td>{{ $data->esbl_mm }}</td>
                <td>{{ $data->created_by }}</td>
                
              </tr>
              <?php $count++; ?>
              @endforeach
            </tbody>
          </table>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        $('#val_'+antibiotic_id).attr("disabled", true );
        
      }
      
      if($(this).prop("checked") == true) {
        $('#val_'+antibiotic_id).attr("disabled", false );
        $('#val_'+antibiotic_id).attr("required", true );
      }
    });

    // $(".checkbox_result").click(function() {
    //   var antibiotic_id = $(this).attr('antibiotic_id');
    //   $('.antibiotic_name_'+antibiotic_id).attr("required", true );
    //   //console.log(antibiotic_id);
    // });

  });

</script>


@endsection

