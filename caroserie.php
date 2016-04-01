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
        $updateQuery = "UPDATE  caroserie SET IDCaroserie='".$_POST['idcaroserie']."',Lungime='".$_POST["lungime"]."',Latime='".$_POST["latime"]."',Inaltime='".$_POST["inaltime"]."',Greutate='".$_POST["greutate"]."',GreutateMaximaPermisa='".$_POST["greutatemaxima"]."',Portbagaj='".$_POST["portbagaj"]."',Rezervor='".$_POST["rezervor"]."'
                        WHERE IDCaroserie='".$_POST['hidden']."'";
        $conn->query($updateQuery);
    }
    
    if(isset($_POST['delete'])) {
        $idCaroserie = $_POST['id'];
        $deleteQuery = "DELETE FROM caroserie WHERE IDCaroserie = '$idCaroserie'";
        $conn->query($deleteQuery);
    }
        
    $sql = "SELECT * FROM caroserie";
    $result = $conn->query($sql);

     echo "<table class='table table-bordered table-hover' >
         <tr>
         <th>IDCaroserie</th>
         <th>Lungime [m]</th>
         <th>Latime [m]</th>
         <th>Inaltime [m]</th>
         <th>Greutate [kg]</th>
         <th>Greutate maxima permisa [kg]</th>
         <th>Portbagaj [L]</th>
         <th>Rezervor [L]</th>
         </tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<form action=\"caroserie.php\" method=\"POST\">";
            echo "<tr>";
            echo "<td>" . "<input type=\"number\" name=\"idcaroserie\" value='" . $row['IDCaroserie'] . "' /></td>";
            echo "<td>" . "<input type=\"number\" name=\"lungime\" value='" . $row['Lungime'] . "'/> </td>" ;
            echo "<td>" . "<input type=\"number\" name=\"latime\" value='" . $row['Latime'] . "'/> </td>" ;
            echo "<td>" . "<input type=\"number\" name=\"inaltime\" value='" . $row['Inaltime'] . "'/> </td>" ;
            echo "<td>" . "<input type=\"number\" name=\"greutate\" value='" . $row['Greutate'] . "'/> </td>" ;
            echo "<td>" . "<input type=\"number\" name=\"greutatemaxima\" value='" . $row['GreutateMaximaPermisa'] . "'/> </td>" ;
            echo "<td>" . "<input type=\"number\" name=\"portbagaj\" value='" . $row['Portbagaj'] . "'/> </td>" ;
            echo "<td>" . "<input type=\"number\" name=\"rezervor\" value='" . $row['Rezervor'] . "'/> </td>" ;
            echo "<input type=\"hidden\" name=\"hidden\" value=" . $row['IDCaroserie'] . " />" ;
            echo "<td>" . "<input type=\"submit\" class=\"btn btn-info\" name=\"update\" value=\"UPDATE\" /></td></form>";
            echo "</tr>"; 
        }   

        echo "</table>"; 
        $conn->close();
    ?>
    
    <div class ="row">
        <div class="wrapper">
            <button id="insertButton" class="btn btn-success" >INSERT</button>
                <form method="post" action="caroserie.php">
                    <div>
                        <h3>Delete Form</h3>
                        <label for="id" class="ui-hidden-accessible">IDCaroserie:</label>
                        <input type="number" name="id" id="deleteid" placeholder="ID">
                        <input type="submit"  class="btn btn-danger" data-inline="true" name="delete" value="DELETE">
                    </div>
                </form>
            </div>

            <script type="text/javascript">
                document.getElementById("insertButton").onclick = function () {
                    location.href = "http://localhost/PhpProject1/caroserie-insert-form.php";
                };
            </script>
            
        </div>
    </div>
</body>
</html>

