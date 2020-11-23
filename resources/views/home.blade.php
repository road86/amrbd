@extends('layouts.amrlayout')

@section('content')
<div class="row">
               <div class="col-xl-3 col-md-6">
                  <!-- START card-->
                  <div class="card flex-row align-items-center align-items-stretch border-0">
                     <div class="col-4 d-flex align-items-center bg-primary-dark justify-content-center rounded-left"><em class="icon-chemistry fa-3x"></em></div>
                     <div class="col-8 py-3 bg-primary rounded-right">
                        <div class="h2 mt-0">{{$antibiotic}}</div>
                        <div class="text-uppercase">Total Antibiotic</div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-md-6">
                  <!-- START card-->
                  <div class="card flex-row align-items-center align-items-stretch border-0">
                     <div class="col-4 d-flex align-items-center bg-purple-dark justify-content-center rounded-left"><em class="fas fa-flask fa-3x"></em></div>
                     <div class="col-8 py-3 bg-purple rounded-right">
                        <div class="h2 mt-0">{{$pathogen}}</div>
                        <div class="text-uppercase">Total Pathogen</div>
                     </div>
                  </div>
               </div>
               
               <div class="col-xl-3 col-lg-6 col-md-12">
                  <!-- START card-->
                  <div class="card flex-row align-items-center align-items-stretch border-0">
                     <div class="col-4 d-flex align-items-center bg-green-dark justify-content-center rounded-left"><em class="fas fa-list-alt fa-3x"></em></div>
                     <div class="col-8 py-3 bg-green rounded-right">
                        <div class="h2 mt-0">{{$speciman}}</div>
                        <div class="text-uppercase">Total Specimen</div>
                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-lg-6 col-md-12">
                  <!-- START card-->
                  <div class="card flex-row align-items-center align-items-stretch border-0">
                     <div class="col-4 d-flex align-items-center bg-green-dark justify-content-center rounded-left"><em class="fas fa-bars fa-3x"></em></div>
                     <div class="col-8 py-3 bg-green rounded-right">
                        <div class="h2 mt-0">{{$breed}}</div>
                        <div class="text-uppercase">Total Breed</div>
                     </div>
                  </div>
               </div>
            </div>
@endsection
