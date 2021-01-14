@extends('layouts.amrlayout')

@section('content')
    
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
          <h3 style="text-align: center; color:#5b92e5">Select ISOLATE Type To INSERT Data</h3>
          <hr style="border: 5px solid green"> 
      
          <br><br>
          <a class="btn btn-primary" href="{{ url('/') }}/isolatedatatype/isolatetypeindividualview"> <h3 style="text-align: center">INDIVIDUAL Isolate Data</h3></a>

          <br><br>
          <a class="btn btn-primary" href="{{ url('/') }}/isolatedatatype/isolatetypesummarizeview"><h3 style="text-align: center">SUMMARIZED Isolate Data</h3></a>
		  @if(auth()->user()->hasRole('admin') || auth()->user()->institution_id == 10)
		  <br><br>
          <a class="btn btn-primary" href="{{ url('/') }}/isolatedatatype/isolatetypefileuploadview"><h3 style="text-align: center">Upload Zip file</h3></a>
		  @endif
          @if(auth()->user()->hasRole('admin') || auth('web')->user()->institution_id == 9)
		  <br><br>
          <a class="btn btn-primary" href="{{ url('/') }}/isolatedatatype/isolatetypecsvuploadview"><h3 style="text-align: center">Upload CSV file</h3></a>
		  @endif
      </div>
          
    </div>
</div>
@endsection
