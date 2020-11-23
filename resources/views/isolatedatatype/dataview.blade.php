@extends('layouts.amrlayout')

@section('content')
<div class="content-heading">
   <div><small data-localize="dashboard.WELCOME"></small></div><!-- START Language list-->
 </div>
    
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12"><h3 style="text-align: center">View Individual and Summarize Isolata Sample and Test Data</h3>

           <hr style="border: 5px solid green"> 

           <table id="tableview">

            <thead>
              <tr>
                <th scope="col">Data Type</th>
                <th scope="col">View Sample Data</th>
                <th scope="col">View Test Data</th>
              </tr>
            </thead>
             <tbody>
               <tr>
                <td style="text-align: center">01</td>
                <td><a class="btn btn-primary" href="{{url('/')}}/singleisolatesample/view" title="View Single Isolate (S/I/R) Sample Data"><h3>View Individual Isolate Sample Data [S|I|R]</h3></a></td>

                <td><a class="btn btn-primary" href="{{url('/')}}/singleisolatesampletest/view" title="Single Isolate (S/I/R) Test Data"><h3>View Individual Isolate Test Data [S|I|R]</h3></a></td>
               

               </tr>
                 <td style="text-align: center">02</td>
                <td><a class="btn btn-primary" href="{{url('/')}}/singleisolatezdissample/view" title="View Single Isolate (ZDIS) Sample Data"><h3>View Individual Isolate Sample Data [ZDIS]</h3></a></td>

                <td><a class="btn btn-primary" href="{{url('/')}}/singleisolatezdissampletest/view" title="Single Isolate (ZDIS) Test Data"><h3>View Individual Isolate Test Data [ZDIS]</h3></a></td>  
               </tr>

               </tr>
                 <td style="text-align: center">03</td>
                 <td><a class="btn btn-primary" href="{{url('/')}}/summarizeinumsample/view" title="View Summarize Single Isolate Numeric Sample Data"><h3>View Summarize Isolate Sample Data [   #   ]</h3></a></td>

                <td><a class="btn btn-primary" href="{{url('/')}}/summarizeinumsampletest/view" title="View Summarize Single Isolate Numeric Test Data"><h3>View Summarize Isolate Test Data [   #   ]</h3></a></td>  
               </tr>

               </tr>
                 <td style="text-align: center">04</td>
                 <td><a class="btn btn-primary" href="{{url('/')}}/summarizeipersample/view" title="View Summarize Isolate Percentage Sample Data"><h3>View Summarize Isolate Sample Data [  %  ]</h3></a></td>
                 
                <td><a class="btn btn-primary" href="{{url('/')}}/summarizeipersampletest/view" title="View Summarize Isolate Percentage Test Data"><h3>View Summarize Isolate Test Data [  %  ]</h3></a></td>   
               </tr>
            </tbody> 
         </table>

        </div>
    </div>
</div>
@endsection