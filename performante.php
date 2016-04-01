<html>
<head>
  <title>Proiect Baze de Date</title>
  <link rel="stylesheet" media="all" href="css/bootstrap.min.css"> 
  <link rel="stylesheet" media="all" href="css/custom.css">
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "masini";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    if(isset($_POST['update'])) {
        $updateQuery = "UPDATE  performante SET IDPerformanta='".$_POST['idperformanta']."',Acceleratie100='".$_POST["acceleratie100"]."',VitezaMaxima='".$_POST["vitezamaxima"]."',Acceleratie160='".$_POST["acceleratie160"]."'
                        WHERE IDPerformanta ='".$_POST['hidden']."'";
        $conn->query($updateQuery);
    }
   
    if(isset($_POST['delete'])) {
        $idPerformanta = $_POST['id'];
        $deleteQuery = "DELETE FROM performante WHERE IDPerformanta = '$idPerformanta'";
        $conn->query($deleteQuery);
    }
        
    $sql = "SELECT * FROM performante";
    $result = $conn->query($sql);


    echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>IDPerformanta</th>
         <th>Acceleratie 0-100km/h [s]</th>
         <th>Viteza maxima [km/h]</th>
         <th>Acceleratie 0-160km/h [s]</th>
         </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<form action=\"performante.php\" method=\"POST\">";
            echo "<tr>";
            echo "<td>" . "<input type=\"number\" name=\"idperformanta\" value='" . $row['IDPerformanta'] . "' /></td>";
            echo "<td>" . "<input type=\"number\" name=\"acceleratie100\" value='" . $row['Acceleratie100'] . "' /></td>";
            echo "<td>" . "<input type=\"number\" name=\"vitezamaxima\" value='" . $row['VitezaMaxima'] . "' /></td>";
            echo "<td>" . "<input type=\"number\" name=\"acceleratie160\" value='" . $row['Acceleratie160'] . "' /></td>";
            echo "<input type=\"hidden\" name=\"hidden\" value=" . $row['IDPerformanta'] . " />" ;
            echo "<td>" . "<input type=\"submit\" class=\"btn btn-info\" name=\"update\" value=\"UPDATE\" /></td></form>";
            echo "</tr>"; 
        }
       
        echo "</table>"; 
        $conn->close();
    ?>
    
    <div class ="row">
        <div class="wrapper">
            <button id="insertButton" class="btn btn-success" >INSERT</button>
                <form method="post" action="performante.php">
                    <div>
                        <h3>Delete Form</h3>
                        <label for="id" class="ui-hidden-accessible">IDPerformante:</label>
                        <input type="number" name="id" id="deleteid" placeholder="ID">
                        <input type="submit" data-inline="true" class="btn btn-danger" name="delete" value="DELETE">
                    </div>
                </form>
            </div>
            
            <script type="text/javascript">
                document.getElementById("insertButton").onclick = function () {
                    location.href = "http://localhost/PhpProject1/performante-insert-form.php";
                };
            </script>
            
        </div>
    </div>
</body>
</html>

