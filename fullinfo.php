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
    define('DB_NAME', 'masini');
    define('DB_USER','root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');

    $link = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);

    if(!$link) {
        die('Baza de date nu poate fi selectata' . mysql_error());
    }

    $db_selected = mysql_select_db(DB_NAME, $link);

    if(!$db_selected) {
        die('Nu putem folosi' . DB_NAME . ':' . mysql_error());
    }
    
        $sql11 = "SELECT V.Nume,Mot.TipMotor,Mot.NrCilindri,Mot.Putere,Mot.ConsumMixt,Mot.Volum,Mot.TipCutieViteze,C.Lungime,C.Latime,C.Inaltime,C.Greutate,C.GreutateMaximaPermisa,C.Portbagaj,C.Rezervor,P.Acceleratie100,P.VitezaMaxima
                   FROM model M JOIN versiune V ON M.IDModel = V.IDModel 
                   JOIN motor Mot ON V.IDMotor = Mot.IDMotor 
                   JOIN caroserie C ON V.IDCaroserie = C.IDCaroserie
                   JOIN performante P ON V.IDPerformanta = P.IDPerformanta
                   WHERE V.Nume ='".$_POST['versiune']."'";
        
        $query11 = mysql_query($sql11) or die(mysql_error());
        $rs_query11 = mysql_fetch_assoc($query11);
        
        echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>Versiune</th>
         <th>Tip motor</th>
         <th>Nr cilindri</th>
         <th>Putere [cp]</th>
         <th>Consum mixt [L/100km]</th>
         <th>Volum [cm^3]</th>
         <th>Tip Cutie Viteze </th>
         <th>Lungimea caroseriei [m]</th>
         <th>Latimea caroseriei [m]</th>
         <th>Inaltimea caroseriei [m]</th>
         <th>Greutatea [kg]</th>
         <th>Greutatea maxima permisa[kg]</th>
         <th>Portbagaj [L]</th>
         <th>Rezervor [L]</th>
         <th>Acceleratie100 [s]</th>
         <th>Viteza maxima [km/h]</th>
         </tr>";
        
            echo "<tr>";
            echo "<td>" . $rs_query11['Nume'] . "</td>";
            echo "<td>" . $rs_query11['TipMotor'] . "</td>";
            echo "<td>" . $rs_query11['NrCilindri'] . "</td>";
            echo "<td>" . $rs_query11['Putere'] . "</td>";
            echo "<td>" . $rs_query11['ConsumMixt'] . "</td>";
            echo "<td>" . $rs_query11['Volum'] . "</td>";
            echo "<td>" . $rs_query11['TipCutieViteze'] . "</td>";
            echo "<td>" . $rs_query11['Lungime'] . "</td>";
            echo "<td>" . $rs_query11['Latime'] . "</td>";
            echo "<td>" . $rs_query11['Inaltime'] . "</td>";
            echo "<td>" . $rs_query11['Greutate'] . "</td>";
            echo "<td>" . $rs_query11['GreutateMaximaPermisa'] . "</td>";
            echo "<td>" . $rs_query11['Portbagaj'] . "</td>";
            echo "<td>" . $rs_query11['Rezervor'] . "</td>";
            echo "<td>" . $rs_query11['Acceleratie100'] . "</td>";
            echo "<td>" . $rs_query11['VitezaMaxima'] . "</td>";
            echo "</tr>"; 
        
        echo "</table>"; 
?>
        
  