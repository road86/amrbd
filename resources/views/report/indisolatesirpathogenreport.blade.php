@extends('layouts.amrlayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h3 style="text-align: center;color:#5b92e5">Generate Report for Individual Isolate [S|I|R] Data by pathogen</h3>
                   <hr style="border: 5px solid green;border-radius: 5px"> 
                 </div>

                <div class="card-body">
                     <form action="{{ url('/') }}/report/indisirreportpathogenscreate" method="POST">
                    {{ csrf_field() }}
                  

                  <table id=tableview width="100%" align="center">
                    
                      <tr>
                        <td>
                          <label for="from_test_date"><h4>From Test Date</h4></label>
                          <input type="date" class="form-control" name="from_test_date">
                        </td>
                        <td>
                          <label for="to_test_date"><h4>To Test Date</h4></label>
                          <input type="date" class="form-control" name="to_test_date">
                        </td>
                        
                      <tr>
					  <tr>
						  <td> 
							  <label for=""><h4>Pathogen</h4></label>
							  <select name="pathogen" class="form-control" required>
								<option selected disabled value=""> Select a pathogen</option>
								   @foreach($pathogens as $row=>$val)
									<option value="{{$val->pathogen_id}}"> {{$val->pathogen_name}} </option>
									@endforeach
							  </select>
						  </td>
						  <td>
							  
							  <button type="submit" class="btn btn-primary" style="text-align: center">Submit</button>
						
						  
							  <input type="reset" class="btn btn-danger" style="margin-left:10px;text-align: center" value="RESET">
							</td>
						</tr>
                  </table>                       
                  </form>
                </div>    
              </div>
      </div>
 </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    /* $(".species").change(function(){
      var species = $(this).val();
        $.ajax({
          url: "{{url('get-breed-by-species/')}}"+'/'+species,
          dataType:"html",
          type:"GET",
          success: function(result){
            $(".breed").empty();
            $(".breed").append(result);
        }});
    }); */
  });
</script>
@endsection
