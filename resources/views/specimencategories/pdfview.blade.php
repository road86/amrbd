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
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1.8cm;

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
                height: 1.8cm;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 1cm;
            }

            #pdftableview td, #pdftableview th {

              border:1px solid black;
              padding: 10px;
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
              height: 5px;
              color: #4CAF50;
              background-color: #4CAF50;
              border: none;
             }

             table{
                    width: 100%;
                    border-collapse: collapse;
              }

            .pagenum:before {
                    content: counter(page);
              }
</style>

<html>
    
    <head>
         <title>List of Specimen</title>
    </head>
    
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
          <h2 style="margin-bottom: 5px">List of Specimen on Culture Sensitivity Testing Application</h2>
          <hr>
        </header>

        <footer>
          <hr>
          <!--  Copyright &copy; <?php echo date("Y");?> 

               <div class="default-bottom-right-margin-box margin-box" style="position:running(top-bottom-right);text-align: right;"> -->

              <div style="text-align:center; color:black;"> Page:
                <span class="pagenum"> </span> 
              </div>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <table class="table" width="100%">
              <tr>
              <th scope="col"><?php echo '<p align="left">'."Date : " . date("m-d-Y") ?></th> 
               <th scope="col"><?php echo '<p align="right">'. "Pdf exported by : " . $user->email ?></th> 
            </table>
            <hr>

            <table class="table" id="pdftableview" width="100%">
             <thead>
              <tr>
                <th scope="col" style="width: 60px; text-align: center">SL #</th>
                <th scope="col">Specimen Name</th>  
              </tr>
             </thead>
            
            <tbody>
              @php $sl=0; @endphp
              @foreach($specimen as $row=>$data)
              <tr>
                <td style="text-align: center"><b>{{++$sl}}</b></td>
                <td><b>{{$data->specimen_name}}<b></td> 
              </tr>
              @endforeach
            </tbody>         
          </table>
           <br>
           <h3 style="margin-bottom:5px; text-align:center;">End of File</h3>
           <hr>
        </main>
    </body>
</html>