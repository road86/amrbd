@extends('layouts.amrlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
				@if(Session::has('message'))
					<p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
				@endif
                <div class="card-header">
                    <h3 style="text-align: center;color:#5b92e5">Upload a zip archive with RTF files having data in [S|I|R] outcome</h3>
                    <hr style="border: 5px solid green;border-radius: 5px"> 
                </div>

                <div class="card-body">
					
					<form action="{{ url('/') }}/isolatedatatype/uploadZipFile" method="POST" enctype="multipart/form-data">  

                 <!--  <form action="{{ url('/') }}/singleisolatesample/createpostconfirmation" method="POST"> -->

                    
                    {{ csrf_field() }}

               <table id="tableview" align="center">
                    <tr>
                        <td width="100%">
                          <label><h4 style="color:green">Upload file</h4></label>
                          <input type="file" class="form-control" name="zip_file" required>
                        </td>
                      </tr>
                      <tr>
                        <td style="text-align: right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </td>
                      </tr>
                    </table>
                      
                   </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    
  });
</script>
@endsection
