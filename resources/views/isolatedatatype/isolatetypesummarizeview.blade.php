@extends('layouts.amrlayout')

@section('content')
    
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
          <h3 style="text-align: center; color:#5b92e5">Select Summarize ISOLATE Type To INSERT Data</h3>
          <hr style="border: 5px solid green"> 
      
          <br><br>

          <a class="btn btn-primary" href="{{ url('/') }}/summarizeinumsample/create"> <h3 style="text-align: center">Summarize ISOLATE Numeric Data </h3></a>

          <br><br>
          
          <a class="btn btn-primary" href="{{ url('/') }}/summarizeipersample/create"><h3 style="text-align: center">Summarize ISOLATE Percentage Data</h3></a>
      </div>
          
    </div>
</div>
@endsection
