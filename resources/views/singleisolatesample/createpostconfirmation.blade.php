@extends('layouts.amrlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                 <h3 style="text-align: center;color:#5b92e5">Review Single Isolate Sample Data [S|I|R]</h3>
                    <hr style="border: 5px solid green;border-radius: 5px"> 
                </div>

                <div class="card-body">
                  <form action="{{ url('/') }}/singleisolatesample/store" method="POST">

                    {{ csrf_field() }}

             

                  <table id="tableview" align="center">             
                    <tr>
                        <td width="50%">
                          <label for=""><h4 style="color:green">Test Date:</h4></label>
                          {{ $test_date}} 
                        </td>
                        
                        <td width="50%">                             
                          <label for=""><h4 style="color:green">Institution Name :</h4></label>
                          
                          {{$institutions}}
                        </td>
                      </tr>

                      <tr>
                        <td> 
                          <label for=""><h4 style="color:green">Species Name : </h4></label>
                               {{ $species }}
                        </td>
                        <td>
                          <label for=""><h4 style="color:green">Breed Name :</h4></label>
                          {{ $breeds }}
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <label for=""><h4 style="color:green">Specimen Name : </h4></label>
                          {{ $specimen}}
                        </td>
                        <td>
                          <label for=""><h4 style="color:green">Sampling Location Name : </h4></label>
                          {{ $specimencollectionlocation }}
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <label for=""><h4 style="color:green">Test Method Name: </h4></label>
                         {{ $testmethods }}
                        </td>
                        <td>
                          <label for=""><h4 style="color:green">Pathogen Name :</h4></label>
                         {{ $pathogen}}
                        </td>
                      </tr> 
                      
                      <tr>
                        <td style="text-align: right">
                          <button type="submit" class="btn btn-primary">Next</button>
                        </td>
                      </tr>
              
                    </table>
                      
                   </form>
            </div>
        </div>
    </div>
</div>
@endsection