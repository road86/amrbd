@extends('layouts.amrlayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3 style="text-align: center;color:#5b92e5">Generate Report for Individual Isolate [S|I|R] Data</h3>
                   <hr style="border: 5px solid green;border-radius: 5px"> 
                 </div>

                <div class="card-body">
                     <form action="{{ url('/') }}/report/indisirreportcalculation" method="POST">
                    {{ csrf_field() }}
                  

                  <table id=tableview width="100%" align="center">
                    <tr>
                      <td width="34%">   
                        <label for=""><h4>Institution Name</h4></label>
                          <select name="institution" class="form-control">
                            <option selected disabled value=""> Select Institution</option>
                            @foreach($institution as $row=>$val)
                             <option value="{{$val->institution_id}}">{{$val->institution_name}} </option>
                            @endforeach
                          </select>
                      </td>
                  
                      <td width="33%"> 
                          <label for=""><h4>Species Name</h4></label>
                          <select name="species" class="form-control species">
                              <option selected disabled value=""> Select Species</option>
                                @foreach($species as $row=>$val)
                              <option value="{{$val->species_id}}"> {{$val->species_name}} </option>
                                @endforeach
                          </select>
                      </td>

                      <td width="33%">
                          <label for=""><h4>Breed Name</h4></label>
                          <select name="breed" class="form-control breed">
                            <option selected disabled> Select Breed</option>
                          </select>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <label for=""><h4>Specimen</h4></label>
                          <select name="specimen" class="form-control">
                            <option selected disabled value=""> Select Specimen</option>
                               @foreach($specimen as $row=>$val)
                                <option value="{{$val->specimen_id}}"> {{$val->specimen_name}} </option>
                                @endforeach
                          </select>
                      </td>
                      
                      <td>
                        <label for=""><h4>Sampling Location Name</h4></label>
                          <select name="samplinglocation" class="form-control">
                            <option selected disabled value=""> Select Sampling Location Name</option>
                              @foreach($samplinglocation as $row=>$val)
                                <option value="{{$val->specimen_location_id}}"> {{$val->specimen_location_name}} </option>
                              @endforeach
                          </select>
                      </td>
                    
                      <td>
                          <label for=""><h4>Test Method Name</h4></label>
                          <select name="testmethod" class="form-control">
                            <option selected disabled value=""> Select Test Type</option>
                              @foreach($testmethod as $row=>$val)
                                <option value="{{$val->test_method_id}}"> {{$val->test_method_name}} </option>
                              @endforeach
                          </select>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <label for="from_test_date"><h4>From Test Date</h4></label>
                          <input type="date" class="form-control" name="from_test_date">
                        </td>
                        <td>
                          <label for="to_test_date"><h4>To Test Date</h4></label>
                          <input type="date" class="form-control" name="to_test_date">
                        </td>
                        <td>
                          
                          <button type="submit" class="btn btn-primary" style="text-align: center">Submit</button>
                    
                      
                          <input type="reset" class="btn btn-danger" style="margin-left:10px;text-align: center" value="RESET">
                        </td>
                      <tr>
                  </table>                       
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
