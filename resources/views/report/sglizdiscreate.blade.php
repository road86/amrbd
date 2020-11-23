@extends('layouts.amrlayout')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>Generate Report</h4></div>

                <div class="card-body">

                  <form action="{{ url('/') }}/report/zdisspecimenreport" method="POST">
                    {{ csrf_field() }}

               <table id=tableview>
                    <tr>
                        <td>
                          <label for="from_test_date"><h4>From Test Date</h4></label>
                          <input type="date" class="form-control" name="from_test_date" required>
                        </td>
                        <td>
                          <label for="to_test_date"><h4>To Test Date</h4></label>
                          <input type="date" class="form-control" name="to_test_date" required>
                        </td>
                        <td>
                          <label for=""><h4>Location on the body </h4></label>
                          <select name="specimen" class="form-control">
                            <option selected disabled> Select Specimen</option>
                               @foreach($specimen as $row=>$val)
                                <option value="{{$val->specimen_id}}"> {{$val->specimen_name}} </option>
                                @endforeach
                          </select>
                        </td>
                        <td>
                          <button type="submit" class="btn btn-primary">Submit</button>
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
