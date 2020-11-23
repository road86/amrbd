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
                <div class="card-header">Sampling Location Update Form</div>

                <div class="card-body">

                    <form action="{{ url('/') }}/specimencollectionlocation/update-samplinglocation-name" method="POST">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="specimen_location_name">Sampling Location Name</label>
                        <input type="text" class="form-control"  value="{{$samplinglocname->specimen_location_name}}" name="specimen_location_name">

                        <input type="hidden" class="form-control"  value="{{$samplinglocname->specimen_location_id}}" name="specimen_location_id">
                        
                      </div>

                      <button type="submit" class="btn btn-primary">Update</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
