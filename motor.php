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
        $updateQuery = "UPDATE  motor SET IDMotor='".$_POST['idmotor']."',TipMotor='".$_POST["tipmotor"]."',NrCilindri='".$_POST["nrcilindri"]."',Putere='".$_POST["putere"]."',ConsumMixt='".$_POST["consummixt"]."',Volum='".$_POST["volum"]."',TipCutieViteze='".$_POST["tipcutie"]."'
                        WHERE IDMotor ='".$_POST['hidden']."'";
        $conn->query($updateQuery);
    }
   
    if(isset($_POST['delete'])) {
        $idMotor = $_POST['id'];
        $deleteQuery = "DELETE FROM motor WHERE IDMotor = '$idMotor'";
        $conn->query($deleteQuery);
    }
        
    $sql = "SELECT * FROM motor";
    $result = $conn->query($sql);
    
    echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>IDMotor</th>
         <th>Tip motor</th>
         <th>Nr cilindri</th>
         <th>Putere [cp]</th>
         <th>Consum mixt [L/100km]</th>
         <th>Volum [cm^3]</th>
         <th>Tip cutie viteze [L]</th>
         
         </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<form action=\"motor.php\" method=\"POST\">";
            echo "<tr>";
            echo "<td>" . "<input type=\"number\" name=\"idmotor\" value='" . $row['IDMotor'] . "' /></td>";
            echo "<td>" . "<select name=\"tipmotor\" >";
                echo "<option";
                    if($row['TipMotor'] == 'benzina'){ echo " selected";}
                    echo " > benzina </option>";
                echo "<option";
                    if($row['TipMotor'] == 'diesel'){ echo " selected";}
                    echo " >diesel </option> </td>";
            echo "</select>";
            echo "<td>" . "<input type=\"number\" name=\"nrcilindri\" value='" . $row['NrCilindri'] . "' /></td>";
            echo "<td>" . "<input type=\"number\" name=\"putere\" value='" . $row['Putere'] . "' /></td>";
            echo "<td>" . "<input type=\"number\" name=\"consummixt\" value='" . $row['ConsumMixt'] . "' /></td>";
            echo "<td>" . "<input type=\"number\" name=\"volum\" value='" . $row['Volum'] . "' /></td>";
            echo "<td>" . "<select name=\"tipcutie\" >";
                echo "<option";
                    if($row['TipCutieViteze'] == 'manuala'){ echo " selected";}
                    echo " > manuala </option>";
                echo "<option";
                    if($row['TipCutieViteze'] == 'automata'){ echo " selected";}
                    echo " >automata </option> </td>";
            echo "</select>";
            echo "<input type=\"hidden\" name=\"hidden\" value=" . $row['IDMotor'] . " />" ;
            echo "<td>" . "<input type=\"submit\" class=\"btn btn-info\" name=\"update\" value=\"UPDATE\" /></td></form>";
            echo "</tr>"; 
        } 
       
        echo "</table>"; 
    ?>
    
    <div class ="row">
        <div class="wrapper">
            <button id="insertButton" class="btn btn-success" >INSERT</button>
         
                <form method="post" action="motor.php">
                    <div>
                        <h3>Delete Form</h3>
                        <label for="id" class="ui-hidden-accessible">IDMotor:</label>
                        <input type="number" name="id" id="deleteid" placeholder="ID">
                        <input type="submit" data-inline="true" class="btn btn-danger" name="delete" value="DELETE">
                    </div>
                </form>
            </div>
           
        </div>
            <script type="text/javascript">
                document.getElementById("insertButton").onclick = function () {
                    location.href = "http://localhost/PhpProject1/motor-insert-form.php";
                };
                
            </script>
            
        </div>
    </div>
</body>
</html>

