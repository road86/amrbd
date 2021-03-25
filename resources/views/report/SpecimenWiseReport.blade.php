@extends('layouts.amrlayout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <!--
          <table class="table" width="100%">
            <tr>
              <th scope="col" width="77.8%"></th> 
              <th scope="col"> </th> 
              <th scope="col"> <a class="btn btn-primary" href="{{ url('/') }}/pathogen/pdf">Export PDF</a></th> 
            </tr>
          </table> -->

          @if(Session::has('message'))
          <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
          @endif    
        

 <br>
 @if($total_isolates>0)
  <table id= "tableview" align="center">
            <thead>
				<tr>
					<td scope="col" style="text-align: center;">Isolates</td>
					<td width="120" style="text-align: center;" colspan="{{sizeOf($ultimate_array)}}">Proportions</td>
				</tr>
				<tr>
					<td scope="col" style="text-align: center; "><b>{{number_format($total_isolates)}}</b></td>
					@foreach($pathogen_wise_counts as $pathogen_id=>$count)
						<td scope="col" style="text-align: center; wrap-cell:no-wrap;">
							<b>{{number_format(($count/$total_isolates)*100,0)}}% <small><em>({{$count}})</em></small></b><br />
							{{$Pathogens[$pathogen_id]}}
						</td>
					@endforeach
					
				</tr>
				
            </thead>
            <tbody>
			  @foreach($ultimate_array as $antibiotic_id=>$pathogen_sub)
			  <tr>
				<td ><b>{{$antibiotics[$antibiotic_id]}}</b></td>
				@foreach($pathogen_wise_counts as $pathogen_id=>$count)
					@if(isset($pathogen_sub[$pathogen_id]))
						@php
							$values = $pathogen_sub[$pathogen_id];
							/* $spec_cat_total = $values["s"] + $values["i"] + $values["r"]; */
							$colorCond = ceil(number_format($values["s"]/$values["t"]*100,2));
						@endphp
						<td 
							@if($colorCond>=90)
							  style="background-color:#96eb34;color:black;text-align: center";
							@elseif($colorCond>=75 && $colorCond<=89)
							  style="background-color:#ebcd34;color:black;text-align: center";
							@elseif($colorCond>=50 && $colorCond<=74)
							  style="background-color:#eb9934;color:black;text-align: center";
							@elseif($colorCond>=0 && $colorCond<=49)
							  style="background-color:#eb4934;color:black;text-align: center";
							@elseif($colorCond==0)
							  style="background-color:#eb4934;color:black;text-align: center";
							@endif
						>
						{{$colorCond}}% <small><em>({{$values["t"]}})</em></small></td>
					@else
						<td style="text-align:center;">-</td>
					@endif
				@endforeach
				
				</tr>
			  @endforeach
               
			   {{-- @foreach($ultimate_array[$specimen_category_id] as $antibiotic_id=>$count_sub) --}}
						
					
					{{-- @endforeach --}}
            </tbody> 
         </table>
         @else
            <h3 style="color: white; background-color: red; padding: 12px; text-align: center;">No Data Found</h3>
         @endif
        </div>
    </div>
</div>
@endsection
