<!DOCTYPE html>
<html>

<head>
    <title>Covid 19 Update</title>
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
    

</head>

<body>
    <table >
        <tr>
            <th>Country</th>
            <th align="center">Total Case</th>
            <th align="center">New Case</th>
            <th align="center">Death(%)</th>
            <th align="center">Recover(%)</th>
            <th align="center">Critical</th>
            <th align="center">New Death</th>
            
        </tr>
        <?php
        include ('toDB.php');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql2 = "SELECT * FROM scrapedata ";
		$sql= "SELECT * FROM scrapedata where country='Bangladesh'";
        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td >" . $row["country"] . "</td><td align=center>" . $row["totalcase"] . "</td><td align=center bgcolor=#ffd9d6> "
                    . $row["newcase"] . "</td><td align=center>" . $row["deathperc"] . "</td><td align=center>"
                    . $row["recoverperc"] . "</td><td align=center>" . $row["critical"] . "</td><td align=center>"
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