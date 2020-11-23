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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Antibiotic Name Update Form</div>

                <div class="card-body">

                    <form action="{{ url('/') }}/antibiotic/update-antibiotic-name" method="POST">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="antibiotic_name">Antibiotic Name</label>
                        <input type="text" class="form-control"  value="{{$antibioticname->antibiotic_name}}" name="antibiotic_name">

                        <input type="hidden" class="form-control"  value="{{$antibioticname->antibiotic_id}}" name="antibiotic_id">
                        
                      </div>

                      <button type="submit" class="btn btn-primary">Update</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
