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
        $updateQuery = "UPDATE  extraoptiuni SET IDExtraOptiune='".$_POST['idoptiune']."',NumeOptiune='".$_POST["numeoptiune"]."',Categorie='".$_POST["categorie"]."'
                        WHERE IDExtraOptiune='".$_POST['hidden']."'";
        $conn->query($updateQuery);
    }
    
    if(isset($_POST['delete'])) {
        $idExtraOptiune = $_POST['id'];
        $deleteQuery = "DELETE FROM extraoptiuni WHERE IDExtraOptiune = '$idExtraOptiune'";
        $conn->query($deleteQuery);
    }
        
    $sql = "SELECT * FROM extraoptiuni";
    $result = $conn->query($sql);
    
    echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>IDExtraOptiune</th>
         <th>Nume Optiune</th>
         <th>Categorie</th>
         </tr>";
    
        while($row = $result->fetch_assoc()) {
            echo "<form action=\"extraoptiuni.php\" method=\"POST\">";
            echo "<tr>";
            echo "<td>" . "<input type=\"number\" name=\"idoptiune\" value='" . $row['IDExtraOptiune'] . "' /></td>";
            echo "<td>" . "<input type=\"text\" name=\"numeoptiune\" value='" . $row['NumeOptiune'] . "' /></td>";
            echo "<td>" . "<input type=\"text\" name=\"categorie\" value='" . $row['Categorie'] . "' /></td>";
            echo "<input type=\"hidden\" name=\"hidden\" value=" . $row['IDExtraOptiune'] . " />" ;
            echo "<td>" . "<input type=\"submit\" class=\"btn btn-info\" name=\"update\" value=\"UPDATE\" /></td></form>";
            echo "</tr>"; 
        }
       
        echo "</table>"; 
        $conn->close();
    ?>
    
    <div class ="row">
        <div class="wrapper">
            <button id="insertButton" class="btn btn-success" >INSERT</button>
                <form method="post" action="extraoptiuni.php">
                    <div>
                        <h3>Delete Form</h3>
                        <label for="id" class="ui-hidden-accessible">IDExtraOptiune:</label>
                        <input type="number" name="id" id="deleteid" placeholder="ID">
                        <input type="submit" data-inline="true" class="btn btn-danger" name="delete" value="DELETE">
                    </div>
                </form>
            </div>
            
            <script type="text/javascript">
                document.getElementById("insertButton").onclick = function () {
                    location.href = "http://localhost/PhpProject1/extraoptiuni-insert-form.php";
                };
            </script>
            
        </div>
    </div>
</body>
</html>

