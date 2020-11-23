<style type="text/css">
  th, td{
    border:1px solid black;
    padding: 10px;
  }
  table{
    width: 100%;
    border-collapse: collapse;
  }
</style>
<html>
    <head>
        <title>Antibiotic</title>
    </head>
    <body>
    <div class="container">
      <div class="col-md-12">
      <div style="text-align: center;margin-bottom: 10px;">
        <h2 style="margin-bottom: 5px;">List of Antibiotic on Culture Sensitivity Testing of AMR Application</h2>
        <h4>Antibiotic Name</h4>
        <hr>
      </div> 
        <table class="table" id="tableview">
           <thead>
              <tr>
                <th scope="col" style="width: 10px;">SL</th>
                <th scope="col">Antibiotic Name</th>
                
              </tr>
            </thead>
            
            <tbody>
              @php $sl=0; @endphp
              @foreach($antibiotic as $row=>$data)
              <tr>
                <td>{{++$sl}}</td>
                <td>{{$data->antibiotic_name}}</td> 
              </tr>
              @endforeach
            </tbody>

          </table>
       </div>
    </div>
    </body>
</html>