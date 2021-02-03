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
 @if(count($testCount)>0)
  <table id= "tableview" align="center">
    <?php //echo 'Total Number of Isolate Tested: ' ?>

            <thead>
              <tr>
                <th scope="col" width="20">Antibiotic</th>
                @foreach($testCount as $countRow=>$countVal)
                  <th scope="col" width="20">{{$pathogenName[$countRow]}}</th>                
				@endforeach
              </tr>
            </thead>
            @php $count = 0; @endphp
             <tbody>
              <tr>
                <td><b>Poportion of Isolets</b></td>
                @foreach($pathogenCount as $prow=>$pal)
                  <td style="text-align: center"><b>{{number_format(($pal/$totalCount)*100,2)}}%</b></td>
                @endforeach
				<td style="text-align: center"><b>{{number_format($totalCount)}}</b></td>
              </tr>
               @foreach($antibioticName as $aVal=>$aName)
              <tr>               
                  <td><b>{{$aName}}</b></td>
                  @foreach($sensitivity as $row=>$val)
                    @if(array_key_exists($aVal,$val))
                      @php      
                      $total =0;                 
                        $s = $val[$aVal][1];
                        $i = $val[$aVal][2];
                        $r = $val[$aVal][3];
                        $total = $s + $i +$r; 
                        $count = $count + $total;

                        $sen = number_format((($val[$aVal][1])*100)/$total,0);
                      @endphp
                      <td 
                        @if($sen>=90)
                          style="background-color:red;color:white;text-align: center";
                        @elseif($sen>=75 && $sen<=89)
                          style="background-color:green;color:white;text-align: center";
                        @elseif($sen>=50 && $sen<=74)
                          style="background-color:yellow;text-align: center";
                        @elseif($sen>0 && $sen<=49)
                          style="background-color:mediumblue;color:white;text-align: center";
                          @elseif($sen==0)
                          style="background-color:white;color:black;text-align: center";
                        @endif
                      >

                          {{number_format((($val[$aVal][1])*100)/$total,2)}}% 


                      </td>
                      @else
                      <td style="text-align: center;">---</td>
                      @endif
                    @endforeach
                          
              </tr>
               @endforeach   
               {{-- $count --}}
            </tbody> 
         </table>
         @else
            <h3 style="color: white; background-color: red; padding: 12px; text-align: center;">No Data Found</h3>
         @endif
        </div>
    </div>
</div>
@endsection
