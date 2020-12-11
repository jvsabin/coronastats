<!DOCTYPE html>
<html>

<head>
    <title>Covid 19 Live Update</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            color: #4d4949;
            font-family: monospace;
            font-size: 25px;
            text-align: left;

            
        }

        th {
            background-color: #588c7e;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    
  
</head>

<body>
    <p> hi <?php echo  date("F j, Y, g:i a"); ?>
    </p>
    <table id="data">
        <thead>
            <tr>
                <th>Country</th>
                <th align="center">Total Case</th>
                <th align="center">New Case</th>
                <th align="center">Death(%)</th>
                <th align="center">Recover(%)</th>
                <th align="center">Critical</th>
                <th align="center">New Death</th>
                
            </tr>
        </thead>
        <?php
        include ('toDB.php');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql2 = "SELECT * FROM scrapedata";
		$sql= "SELECT * FROM scrapedata where country='Bangladesh'";
        $result = $conn->query($sql);
		$result2 = $conn->query($sql2);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td bgcolor=#d9ddff>" . $row["country"] . "</td><td align=center bgcolor=#d9ddff>" . $row["totalcase"] . "</td><td align=center bgcolor=#d9ddff> "
                    . $row["newcase"] . "</td><td align=center bgcolor=#d9ddff>" . $row["deathperc"] . "</td><td align=center bgcolor=#d9ddff>"
                    . $row["recoverperc"] . "</td><td align=center bgcolor=#d9ddff>" . $row["critical"] . "</td><td align=center bgcolor=#d9ddff>"
                    . $row["newdeath"] . "</td></tr>";
            }
            //echo "</table>";
        } else {
            echo "0 results";
        }
		if ($result2->num_rows > 0) {
            // output data of each row
            while ($row = $result2->fetch_assoc()) {
                echo "<tr><td >" . $row["country"] . "</td><td align=center>" . $row["totalcase"] . "</td><td align=center bgcolor=#ffd9d6> "
                    . $row["newcase"] . "</td><td align=center>" . $row["deathperc"] . "</td><td align=center>"
                    . $row["recoverperc"] . "</td><td align=center>" . $row["critical"] . "</td><td align=center>"
                    . $row["newdeath"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
        
        ?>
    </table>
    
</body>

</html>
<script type="text/javascript">
        $(document).ready(function() {
        $('#data').DataTable();
        } );
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