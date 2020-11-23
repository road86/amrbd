<style type="text/css">
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 1cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 1cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 1.5cm;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 1cm;
            }

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
        <!-- Define header and footer blocks before your content -->
        <header>
       <!--   <img src="{{url('/')}}/img/logo.png" width="100%" height="100%"/> -->
          <h2>List of Antibiotic on Culture Sensitivity Testing Application</h2>
        </header>

        <footer>
            Copyright &copy; <?php echo date("Y");?> 
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <table class="table" width="100%">
              <tr>
              <th scope="col"><?php echo '<p align="left">'."Date : " . date("m-d-Y") ?></th> 
               <th scope="col"><?php echo '<p align="right">'. "Pdf created by : " . $user->email ?></th> 
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
        </main>
    </body>
</html>