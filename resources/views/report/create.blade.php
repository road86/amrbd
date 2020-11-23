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
                <div class="card-header"><h4>Insert Single Isolate Sample Data</h4></div>

                <div class="card-body">

                  <form action="{{ url('/') }}/singleisolatesample/store" method="POST">
                    {{ csrf_field() }}

               <table id="tableview">
                    <tr>
                        <td>
                          <label for="test_date"><h4>Test Date</h4></label>
                          <input type="date" class="form-control" name="test_date" required>
                        </td>
                        <td>                
                          <label for=""><h4>Institution Name</h4></label>
                          <select name="institutions" class="form-control" required>
                            <option selected disabled value=""> Select Institutions</option>
                            @foreach($institutions as $row=>$val)
                             <option value="{{$val->institution_id}}">{{$val->institution_name}} </option>
                            @endforeach
                          </select>
                         </td>
                      </tr>

                      <tr>
                        <td> 
                          <label for=""><h4>Species Name</h4></label>
                          <select name="species" class="form-control species" required>
                              <option selected disabled value=""> Select Species</option>
                                @foreach($species as $row=>$val)
                              <option value="{{$val->species_id}}"> {{$val->species_name}} </option>
                                @endforeach
                          </select>
                        </td>
                        <td>
                          <label for=""><h4>Breed Name</h4></label>
                          <select name="breeds" class="form-control breed" required>
                            <option selected disabled> Select Breed</option>
                          </select>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <label for=""><h4>Location on the body(Specimen)</h4></label>
                          <select name="specimen" class="form-control" required>
                            <option selected disabled value=""> Select Specimen</option>
                               @foreach($specimen as $row=>$val)
                                <option value="{{$val->specimen_id}}"> {{$val->specimen_name}} </option>
                                @endforeach
                          </select>
                        </td>
                        <td>
                          <label for=""><h4>Sampling Location Name</h4></label>
                          <select name="specimencollectionlocation" class="form-control" required>
                            <option selected disabled value=""> Select Sampling Location Name</option>
                              @foreach($specimencollectionlocation as $row=>$val)
                                <option value="{{$val->specimen_location_id}}"> {{$val->specimen_location_name}} </option>
                              @endforeach
                          </select>
                        </td>
                      </tr>

                      <tr>
                      <td>
                          <label for=""><h4>Test Method Name</h4></label>
                          <select name="testmethods" class="form-control" required>
                            <option selected disabled value=""> Select Test Type</option>
                              @foreach($testmethod as $row=>$val)
                                <?php 
                                  if($val->test_method_id == 2) {
                                    $selected = 'selected="selected"';
                                  } else {
                                    $selected = '';
                                  }
                                ?>
                                <option value="{{$val->test_method_id}}" <?php echo $selected ?>> {{$val->test_method_name}} </option>
                              @endforeach
                          </select>
                        </td>

                        <td>
                          <label for=""><h4>Pathogen Name</h4></label>
                          <select name="pathogen" class="form-control" required>
                            <option selected disabled value=""> Select Pathogen</option>
                              @foreach($pathogen as $row=>$val)
                                <option value="{{$val->pathogen_id}}"> {{$val->pathogen_name}} </option>
                              @endforeach
                          </select>
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
