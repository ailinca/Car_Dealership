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
        $updateQuery = "UPDATE  model SET IDModel='".$_POST['idmodel']."',Nume='".$_POST["nume"]."'
                        WHERE IDModel='".$_POST['hidden']."'";
        $conn->query($updateQuery);
    }
   
    if(isset($_POST['delete'])) {
        $idModel = $_POST['id'];
        $deleteQuery = "DELETE FROM model WHERE IDModel = '$idModel'";
        $conn->query($deleteQuery);
    }

    
    $sql = "SELECT * FROM Model";
    $result = $conn->query($sql);
    
    echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>IDModel</th>
         <th>Model</th>
         </tr>";
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<form action=\"model.php\" method=\"POST\">";
        echo "<tr>";
        echo "<td>" . "<input type=\"number\" name=\"idmodel\" value='" . $row['IDModel'] . "' /></td>";
        echo "<td>" . "<input type=\"text\" name=\"nume\" value='" . $row['Nume'] . "'/> </td>" ;
        echo "<input type=\"hidden\" name=\"hidden\" value=" . $row['IDModel'] . " />" ;
        echo "<td>" . "<input type=\"submit\" class=\"btn btn-info\" name=\"update\" value=\"Update\" /></td></form>";
        echo "</tr>";
      
    }
    echo "</table>";

   $conn->close();
?>

    <div class ="row">
        <div class="wrapper">
            <button id="insertButton" class="btn btn-success" >INSERT</button>  
                <form method="post" action="model.php">
                    <div>
                        <h3>Delete Form</h3>
                        <label for="id" class="ui-hidden-accessible">IDModel:</label>
                        <input type="number" name="id" id="deleteid" placeholder="ID">
                        <input type="submit"  class="btn btn-danger" data-inline="true" name="delete" value="DELETE">
                    </div>
                </form>
            </div>

            <script type="text/javascript">
                document.getElementById("insertButton").onclick = function () {
                    location.href = "http://localhost/PhpProject1/model-insert-form.php";
                };
            </script>
            
        </div>
    </div>
</body>
</html>

