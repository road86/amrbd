@extends('layouts.amrlayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

          <h3 style="text-align: center; color:#5b92e5">Select Report for Individual and Summarize Isolata Sample and Test Data</h3>
          <hr style="border: 5px solid green"> 
      
          <br> 

        <a class="btn btn-primary" href="{{ url('/') }}/report/indisirreportcreate"><h3>Show Report on Individual Isolate Data (S/I/R) - Specimen wise</h3></a>

        <br><br>
		
		<a class="btn btn-primary" href="{{ url('/') }}/report/indisirpathogenreport"><h3>Show Report on Individual Isolate Data (S/I/R) - Pathogen wise</h3></a>

        <br><br>
        <a class="btn btn-primary" href="{{ url('/') }}/report/indizdisreportcreate"><h3>Show report on Individual Isolate Data (Zone Diameter Interpretative Standard (mm)</h3></a>


         <br><br>
        <a class="btn btn-primary" href="{{ url('/') }}/report/view"><h3>Show report on SUMMARIZED Isolate Data (Number)</h3></a>

         <br><br>
        <a class="btn btn-primary" href="{{ url('/') }}/report/view"><h3>Show Report on SUMMARY of Isolate Data (%)</h3></a>

        </div>
    </div>
</div>
@endsection
