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
                <div class="card-header"><h3>Institution Form</h3></div>

                <div class="card-body">

                    <form action="{{ url('/') }}/institution/store" method="POST">
                      {{ csrf_field() }}
                      <div class="form-group">
                        
                      <table id="tableview" width="60%">
                        <thead>
                          <tr>
                            <th scope="row"><h4>Insert Institution Name</h4></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <th scope="row"><input type="text" autocomplete="off" class="form-control"  name="institution_name" onfocus="this.value=''" value="Type Institute Name Here" required></th>
                          </tr>
                        </tbody> 
                      </table>
               
                       <!-- <label for="institution_name">Insert Institution Name</label>
                        <input type="text" class="form-control"  name="institution_name" required> -->

                      </div>

                      <button type="submit" class="btn btn-primary"><h4>Submit</h4></button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
