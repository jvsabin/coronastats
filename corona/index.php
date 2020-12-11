<?php  
    include ('toDB.php');
    $query ="SELECT * FROM tbl_employee ORDER BY ID DESC";  
    $sql2 = "SELECT * FROM scrapedata";
    $sql= "SELECT * FROM scrapedata where country='Bangladesh'";
    //$result = mysqli_query($connect, $query);  
    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);

    /* datatable
       jQuery.floathead
    */

 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Covid 19 Live Update</title>  
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <meta charset="utf-8">
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
           

           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
           <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css" />  
           <script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
  
           <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> 
           <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script> 

           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          
      </head>  
      <body>  
          
           <div class="container">  
                <h3 align="center">Live Reported Test <br><?php echo  date("F j, Y, g:i a"); ?></h3>  
                <br />  
                <p> 
                     
                </p>
                <div class="row">
                <div class="col-sm-3" >
                    <h3><u>Bangladesh:</u></h3>
                         <?php
                              $rowBD = mysqli_fetch_array($result);
                              echo ('<h4>  Total Case: <font color="red"> ' .$rowBD["totalcase"].' </font> </h4>' );
                              echo ('<h4> Total Death: <font color="red">' .$rowBD["totaldeath"].'  </font></h4>' );
                              echo ('<h4> Death Percentage: <font color="red">' .$rowBD["deathperc"].'% </font> </h4>' );
                         ?>
               
                </div>
                <div class="col-sm-7" > </br>
                    <div id="piechart_3dqewr" style="width: 700px; height: 200px;"></div>
                </div>
                </div>
                </br>
               
                <div class="table-responsive">  
                     <table id="employee_data" class="table table-striped table-bordered">  
                          <thead>  
                              <tr>  
                              <th bgcolor=#f0f0ff>Country</th>
                              <th align="center" bgcolor=#f0f0ff>Total Case</th>
                              <th align="center" bgcolor=#f0f0ff>New Case</th>
                              <th align="center" bgcolor=#f0f0ff>Death(%)</th>
                              <th align="center" bgcolor=#f0f0ff>Recover(%)</th>
                              <th align="center" bgcolor=#f0f0ff>Critical</th>
                              <th align="center" bgcolor=#f0f0ff>New Death</th> 
                              </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_array($result2))  
                          {  
                               if($row["country"]=="World" || $row["country"]=="Total"){
                                   continue;
                               }
                               if($row["newcase"]=="0"){
                                   $row["newcase"]="";
                               }
                               if($row["deathperc"]=="0"){
                                   $row["deathperc"]="";
                               }
                               if($row["recoverperc"]=="0"){
                                   $row["recoverperc"]="";
                               }
                               if($row["critical"]=="0"){
                                   $row["critical"]="";
                               }
                               if($row["newcase"]==0 || $row["newcase"]=="0" ){
                                   $row["newdeath"]="";
                               }
                               echo '  
                               <tr>  
                                    <td >'.$row["country"].'</td>  
                                    <td align=right>'.$row["totalcase"].'</td>  
                                    <td align=right>'.$row["newcase"].'</td>  
                                    <td align=right>'.$row["deathperc"].'</td>  
                                    <td align=right>'.$row["recoverperc"].'</td>  
                                    <td align=right>'.$row["critical"].'</td>  
                                    <td align=right>'.$row["newdeath"].'</td>  
                               </tr>  
                               ';  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({
          paging: false,
          order: [[ 1, "desc" ]],
          fixedHeader: true,
          fixedHeader: {
               headerOffset: 0
          },
          info: false
         
     });  
 });  

 </script>  



<script type="text/javascript">
     <?php
          $rowBD = mysqli_fetch_array($result);
     ?>
     
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Number'],
          ['Recover',     33],
          ['Active',     114],
          ['Death',    17]
        ]);

        var options = {
          title: 'Bangladesh',
          colors: ['#453452', '#ec234e','#ffcc66' ],
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3dqewr'));
        chart.draw(data, options);
      }
    </script>




 <?php
$dir = 'log';

$file = date('Y-m-d').'.txt';
$ip = $_SERVER['REMOTE_ADDR'];
$filename = $dir.'/'.$file;
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$info = '
===========================
IP: '.$ip .'
Time: '.date('d/m/Y H:i:s a').'
Filename: '.basename($_SERVER['PHP_SELF']).'
URL: '.$url.'
';
file_put_contents($filename, $info, FILE_APPEND);
?>