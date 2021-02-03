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
                <div class="card-header">Specimen Form</div>

                <div class="card-body">

                    <form action="{{ url('/') }}/specimen/store" method="POST">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="specimen_name">Specimen Name</label>
                        <input type="text" class="form-control" required  name="specimen_name">
                      </div>
					  <div class="form-group">
                        <label for="specimen_category">Specimen category</label>
						<select name="specimen_category" class="form-control" required>
						  <option selected disabled value=""> Select Specimen Category </option>
						  @foreach($specimen_categories as $row=>$val)
							  <option value="{{$val->specimen_category_id}}"> {{$val->specimen_category_name}} </option>
						  @endforeach
						</select>
                      </div>

                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
