@extends('layouts.amrlayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                  <div class="card-header"> 
                    <h3 style="text-align: center;color:#5b92e5">Insert Summarized Isolate Percentage Sample Data</h3>
                    <hr style="border: 5px solid green;border-radius: 5px"> 
                  </div>

                  <div class="card-body">

                  <form action="{{ url('/') }}/summarizeipersample/store" method="POST">
                    {{ csrf_field() }}

                    <table id="tableview" align="center">
                      <tr>
                        <td width="40%">
                          <label for="test_date_from"><h4 style="color:green">Test Date From</h4></label>
                          <input type="date" class="form-control" name="test_date_from" required>
                        </td>
                        <td width="40%">
                          <label for="test_date_to"><h4 style="color:green">Test Date To</h4></label>
                          <input type="date" class="form-control" name="test_date_to" required>
                        </td>
                      </tr>

                      <tr>
                       <td>
                          <label for=""><h4 style="color:green">Institution Name</h4></label>
                          <select name="institution" class="form-control" required>
                            <option selected disabled value=""> Select Institution</option>
                            @foreach($institution as $row=>$val)
                             <option value="{{$val->institution_id}}">{{$val->institution_name}} </option>
                            @endforeach
                          </select>
                        </td>
                        <td> 
                          <label for=""><h4 style="color:green">Species Name</h4></label>
                          <select name="species" class="form-control species" required>
                              <option selected disabled value=""> Select Species</option>
                                @foreach($species as $row=>$val)
                              <option value="{{$val->species_id}}"> {{$val->species_name}} </option>
                                @endforeach
                          </select>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <label for=""><h4 style="color:green">Location on the body(Specimen)</h4></label>
                          <select name="specimen" class="form-control" required>
                            <option selected disabled value=""> Select Specimen</option>
                               @foreach($specimen as $row=>$val)
                                <option value="{{$val->specimen_id}}"> {{$val->specimen_name}} </option>
                                @endforeach
                          </select>
                        </td>
                        <td>
                          <label for=""><h4 style="color:green">Pathogen Name</h4></label>
                          <select name="pathogen" class="form-control" required>
                            <option selected disabled value=""> Select Pathogen</option>
                              @foreach($pathogen as $row=>$val)
                                <option value="{{$val->pathogen_id}}"> {{$val->pathogen_name}} </option>
                              @endforeach
                          </select>
                        </td>  
                      </tr>  
                        
                      <tr>
                         <td>
                          <label for="No_of_isolate_tested"><h4 style="color:green">Enter numbers of Isolate Tested</h4></label>
                          <input type="number" class="form-control"  name="number_of_isolate_tested" required>
                        </td>
                        <td>
                          <label for="sensitivity_pattern_type"><h4 style="color:green">Select Sensitivity Pattern Type</h4>
                           <input type="radio"  id="resistance" name="sensitivity_pattern"   value="Resistance" checked> Resistance &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                         <input type="radio"  id="sensitive" name="sensitivity_pattern"   value="sensitive"> Sensitive </label>
                        </td>
                      </tr>
    
                    </table>
                      <br><br>
                      <button type="submit" class="btn btn-primary">Next</button>
                   </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $(".species").change(function(){
      var species = $(this).val();
        $.ajax({
          url: "{{url('get-breed-by-species/')}}"+'/'+species,
          dataType:"html",
          type:"GET",
          success: function(result){
            $(".breed").empty();
            $(".breed").append(result);
        }});
    });
  });
</script>
@endsection
