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
                <div class="card-header">Breed Form</div>

                <div class="card-body">

                    <form action="{{ url('/') }}/breed/store" method="POST">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="">Spacies Name</label>
                        <select name="spacies" class="form-control" required>
                          <option selected disabled value=""> Select Spacies</option>
                          @foreach($species as $row=>$val)
                              <option value="{{$val->species_id}}"> {{$val->species_name}} </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="breed_name">Breed Name</label>
                        <input type="text" class="form-control"  name="breed_name" required>
                      </div>

                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
