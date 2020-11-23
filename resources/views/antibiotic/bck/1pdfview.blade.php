<!-- <style type="text/css">
  th, td{
    border:1px solid black;
    padding: 10px;
  }
  table{
    width: 100%;
    border-collapse: collapse;
  }
</style> 



<link rel="stylesheet" href="{{url('/')}}/css/tableview.css">
<link rel="stylesheet" href="{{url('/')}}/css/tablestyleview.css">  

 <table class="table" id="tableview" width="100%">-->

<!--<style type="text/css"> -->

<style>
        #pdftableview td, #pdftableview th {
          border: 3px solid #ddd;
          padding: 8px;
          text-align: left;
        }

        #pdftableview tr:nth-child(even){background-color: #f2f2f2;}

        #pdftableview tr:hover {background-color: #ddd;}

        #pdftableview th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: center;
          background-color: #4CAF50;
          color: white;
        }

        #pdftableview hr { 
          height: 3px;
          color: #4CAF50;
          background-color: #4CAF50;
          border: none;
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
        <h2 style="margin-bottom: 5px;">List of Antibiotic on Culture Sensitivity Testing Application</h2>
     
        <hr>
      </div> 
 
      <table class="table" id="pdftableview" width="100%">
        <thead>
         <tr>
          <th scope="col"><?php echo '<p align="left">'."Date : " . date("m-d-Y") ?></th>
          <th scope="col"><?php echo '<p align="right">'. "Pdf created by : " . $user->email?></th>
         </tr>
        </thead>
      </table>
      <hr>
        <table class="table" id="pdftableview" width="100%">

           <thead>
              <tr>
                <th scope="col" style="width: 60px; text-align: center">SL #</th>
                <th scope="col">Antibiotic Name</th>
                
              </tr>
            </thead>
            
            <tbody>
              @php $sl=0; @endphp
              @foreach($antibiotic as $row=>$data)
              <tr>
                <td style="text-align: center"><b>{{++$sl}}</b></td>
                <td><b>{{$data->antibiotic_name}}<b></td> 
              </tr>
              @endforeach
            </tbody>         
          </table>
           <hr>
       </div>
     </div>
    </body>
</html>