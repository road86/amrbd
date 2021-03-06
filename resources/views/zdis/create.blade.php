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
                <div class="card-header">Zone Diameter Interpretative Criteria (ZDIS) Form</div>

                <div class="card-body">

                    <form action="{{ url('/') }}/zdis/store" method="POST">
                      {{ csrf_field() }}
                      <div class="form-group">


                        <td>
                          <label for=""><h4>Pathogen Name</h4></label>
                          <select name="pathogen" class="form-control" required>
                            <option selected disabled value=""> Select Pathogen</option>
                              @foreach($pathogen as $row=>$val)
                                <option value="{{$val->pathogen_id}}"> {{$val->pathogen_name}} </option>
                              @endforeach
                          </select>
                        </td>

                        <td>
                          <label for=""><h4>Antibiotic Name</h4></label>
                          <select name="antibiotic" class="form-control" required>
                            <option selected disabled value=""> Select Antibiotic</option>
                              @foreach($antibiotic as $row=>$val)
                                <option value="{{$val->antibiotic_id}}"> {{$val->antibiotic_name}} </option>
                              @endforeach
                            </select>
                        </td>

                        <td>
                          <label for="sensitive_mm">Sensitive (mm)</label>
                          <input type="number" class="form-control"  name="sensitives" required>
                        </td>

                        <td>
                          <label for="intermediate_mm">Intermediate (mm)</label>
                          <input type="text" class="form-control"  name="intermediate">
                        </td>

                        <td>
                          <label for="resistance_mm">Resistance (mm)</label>
                          <input type="number" class="form-control"  name="resistance" required>
                        </td>

                        <td>
                          <label for="esbl_mm">ESBL (mm)</label>
                          <input type="number" class="form-control"  name="esbl">
                        </td>

                      
                      </div>

                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
