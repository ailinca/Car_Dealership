<?php

	// CREAREA LEGATTURII CU BAZA DE DATE

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

    //ZONA DE CERERI FOLOSITE PE PAGINA PRINCIPALA ->explicatii in queries.sql

    $sql0 = "SELECT Nume FROM versiune";
    $query0 = mysql_query($sql0) or die(mysql_error());
    
        
    $sql1 = "SELECT M.Nume as Model, V.Nume as Versiune
             FROM versiune V JOIN model M ON V.IDModel = M.IDModel";
    $query1 = mysql_query($sql1) or die(mysql_error());
    $rs_query1 = mysql_fetch_assoc($query1);
    
    $sql2 = "SELECT V.Nume, C.Lungime, C.Latime, C.Inaltime, C.Greutate, C.GreutateMaximaPermisa, C.Portbagaj, C.Rezervor
             FROM versiune V JOIN caroserie C ON V.IDCaroserie = C.IDCaroserie";
    $query2 = mysql_query($sql2) or die(mysql_error());
    $rs_query2 = mysql_fetch_assoc($query2);
    
    $sql3 = "SELECT V.Nume, M.TipMotor, M.NrCilindri, M.Putere, M.ConsumMixt, M.Volum, M.TipCutieViteze
             FROM versiune V JOIN motor M ON V.IDMotor = M.IDMotor
             ORDER BY M.Putere DESC";
    $query3 = mysql_query($sql3) or die(mysql_error());
    $rs_query3 = mysql_fetch_assoc($query3);
    
    $sql4 = "SELECT V.Nume, C.Portbagaj
             FROM versiune V JOIN caroserie C ON V.IDCaroserie = C.IDCaroserie
             WHERE C.Portbagaj > 400";      
    $query4 = mysql_query($sql4) or die(mysql_error());
    $rs_query4 = mysql_fetch_assoc($query4);
    
    $sql5 = "SELECT Md.Nume as Model, V.Nume as Versiune, M.ConsumMixt
             FROM versiune V JOIN model Md ON V.IDModel = Md.IDModel 
             JOIN motor M ON V.IDMotor = M.IDMotor
             WHERE 4> (SELECT COUNT(*)
                       FROM motor
                       WHERE M.ConsumMixt > ConsumMixt)
             ORDER BY M.ConsumMixt";      
    $query5 = mysql_query($sql5) or die(mysql_error());
    $rs_query5 = mysql_fetch_assoc($query5);
    
    $sql6 = "SELECT Md.Nume as Model, V.Nume as Versiune, P.Acceleratie100, P.VitezaMaxima, P.Acceleratie160
             FROM versiune V JOIN model Md ON V.IDModel = Md.IDModel 
             JOIN performante P ON V.IDPerformanta = P.IDPerformanta";
    $query6 = mysql_query($sql6) or die(mysql_error());
    $rs_query6 = mysql_fetch_assoc($query6);
    
    $sql7 = "SELECT Md.Nume as Model, V.Nume as Versiune, P.Acceleratie100
             FROM versiune V JOIN model Md ON V.IDModel = Md.IDModel 
             JOIN performante P ON V.IDPerformanta = P.IDPerformanta
             WHERE P.Acceleratie100 = 
                        (SELECT MIN(P2.Acceleratie100)
                         FROM performante P2 JOIN versiune V2 ON V2.IDPerformanta = P2.IDPerformanta
                         JOIN model Md2 ON V2.IDModel = Md2.IDModel 
                         WHERE Md2.Nume = Md.Nume)
             GROUP BY Md.Nume";
    $query7 = mysql_query($sql7) or die(mysql_error());
    $rs_query7 = mysql_fetch_assoc($query7);
    
    $sql8 = "SELECT V.Nume
             FROM versiune V JOIN areextraoptiune A ON V.IDVersiune = A.IDVersiune
             WHERE A.IDExtraOptiune IN 
                    (SELECT IDExtraOptiune
                     FROM extraoptiuni
                     WHERE Categorie LIKE 'Comfort')";
    $query8 = mysql_query($sql8) or die(mysql_error());
    $rs_query8 = mysql_fetch_assoc($query8);
    
    $sql9 = "SELECT NumeOptiune
             FROM extraoptiuni
             WHERE Categorie Like 'Siguranta'";
    $query9 = mysql_query($sql9) or die(mysql_error());
    $rs_query9 = mysql_fetch_assoc($query9);
    
    $sql10 = "SELECT M.Nume as Model, V.Nume as Versiune, COUNT(A.IDExtraOptiune) as NrOptiuni
              FROM model M JOIN versiune V ON M.IDModel = V.IDModel 
              JOIN areextraoptiune A ON A.IDVersiune = V.IDVersiune
              GROUP BY V.Nume
              HAVING COUNT(A.IDExtraOptiune) = 
                    (SELECT MAX(S.NrOpt)
                     FROM 
                            (SELECT COUNT(IDExtraOptiune) as NrOpt
                             FROM areextraoptiune AR JOIN versiune VR ON AR.IDVersiune = VR.IDVersiune
                             GROUP BY VR.Nume) 
                     as S)";
    $query10 = mysql_query($sql10) or die(mysql_error());
    $rs_query10 = mysql_fetch_assoc($query10);
    
?>

	<!-- ZONA DE COD HTML -->

<!DOCTYPE html>
<html >
<head>
  <title>Proiect Baze de Date</title>
  <link rel="stylesheet" media="all" href="css/bootstrap.min.css">
  <link rel="stylesheet" media="all" href="css/custom.css">
</head>
<body>
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Home</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="#Modele">Modele</a></li>
            <li><a href="#Caroserii">Caroserii</a></li>
            <li><a href="#Motoare">Motoare</a></li>
            <li><a href="#Performante">Performante</a></li>
            <li><a href="#Extra Optiuni">Extra Optiuni</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>

  <hr/>

  <div class="container">
      <h1>PORSCHE</h1>
      <p>Probably the best cars in the world...</p> 
  </div>

  <hr/>

  <div class="container">
    <h1><a name="Modele">Modele</a></h1>
    <h3>Mai jos puteti gasi toate modelele noastre cu versiunile aferente</h3>
    
    <?php     // trebuie creat un tabel frumos in care sa afisam rezultatul cererii sql1
        echo "<table class='table table-bordered table-hover'> 
         <tr>
         <th>Model</th>
         <th>Versiune</th>
         </tr>";
        do {
            echo "<tr>";
            echo "<td>" . $rs_query1['Model'] . "</td>";
            echo "<td>" . $rs_query1['Versiune'] . "</td>";
            echo "</tr>"; 
        } while($rs_query1 = mysql_fetch_assoc($query1));  // cat timp exista rand in rezultatul cererii $query1, valorile atributelor sale se transmit catre $rs_query1
       
        echo "</table>"; 
    ?>
    <h3>Vrei sa vezi toate specificatiile tehnice pentru o versiune aleasa de tine? Completeaza mai jos cu versiunea dorita!</h3>
    <?php    
    
        echo "<form action=\"fullinfo.php\" method=\"post\">"; // formular de preluare dinamica a versiunii pentru care vrem sa facem cautarea
	echo "<select name=\"versiune\" >";   // directiva select ne permite sa afisam toate versiunile din BD
        while($rs_query0 = mysql_fetch_assoc($query0)) {   // iteram prin versiuni folosind o instructiune while
            echo "<option>" . $rs_query0['Nume'] . "</option>";
        }       
        echo "</select>";
	echo "<input type=\"Submit\" name=\"search\" value=\"Afiseaza\">";
        echo "</form>";

    ?>

    <h5> Pentru a adauga, sterge sau modifica continutul tabelei Model, da click aici </h5>
    <button id="modelButton" class="float-left submit-button btn btn-info" >Modifica</button> <!-- pentru a intra in meniul de comanda al tabelului Model am atasat un buton -->

    <script type="text/javascript">
        document.getElementById("modelButton").onclick = function () {
            location.href = "http://localhost/PhpProject1/model.php";  // butonului de "Modifica" i-am atasat o functie care redirecteaza utilizatorul (adminul) la pagina de INSERT, DELETE, UPDATE a tabelei
        };
    </script>
  </div>

  <hr/>

  <div class="container">
    <h1><a name="Caroserii">Caroserii</a></h1>
    <h3>Iata o lista cu toate caroseriile noastre </h3>
     <!-- am creat un tabel in care am afisat toate info din tabela Caroserii, asa cum este ea in Baza de date -->
    <?php     
        echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>Versiune</th>
         <th>Lungime [m]</th>
         <th>Latime [m]</th>
         <th>Inaltime [m]</th>
         <th>Greutate [kg]</th>
         <th>Greutate maxima permisa [kg]</th>
         <th>Portbagaj [L]</th>
         <th>Rezervor [L]</th>
         </tr>";
        do {
            echo "<tr>";
            echo "<td>" . $rs_query2['Nume'] . "</td>";
            echo "<td>" . $rs_query2['Lungime'] . "</td>";
            echo "<td>" . $rs_query2['Latime'] . "</td>";
            echo "<td>" . $rs_query2['Inaltime'] . "</td>";
            echo "<td>" . $rs_query2['Greutate'] . "</td>";
            echo "<td>" . $rs_query2['GreutateMaximaPermisa'] . "</td>";
            echo "<td>" . $rs_query2['Portbagaj'] . "</td>";
            echo "<td>" . $rs_query2['Rezervor'] . "</td>";
            
            echo "</tr>"; 
        } while($rs_query2 = mysql_fetch_assoc($query2));  
       
        echo "</table>"; 
    ?>
    
    <h3>Ai o familie numeroasa si ai nevoie de un portbagaj pe masura cand pleci in vacante? Iata masinile cu portbagaj mai mare de 400 Litri</h3>
    
    <?php     
        echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>Versiune</th>
         <th>Portbagaj [L]</th>
         </tr>";
        do {
            echo "<tr>";
            echo "<td>" . $rs_query4['Nume'] . "</td>";
            echo "<td>" . $rs_query4['Portbagaj'] . "</td>";
            echo "</tr>"; 
        } while($rs_query4 = mysql_fetch_assoc($query4));  
       
        echo "</table>"; 
    ?>

    <h5> Pentru a adauga, sterge sau modifica continutul tabelei Caroserie, da click aici </h5>
    <button id="caroserieButton" class="float-left submit-button btn btn-info" >Modifica</button>

    <script type="text/javascript">
        document.getElementById("caroserieButton").onclick = function () {
            location.href = "http://localhost/PhpProject1/caroserie.php";
        };
    </script>
  </div>

  <hr/>
	
   <div class="container">
    <h1><a name="Motoare">Motoare</a></h1>
    <h3>Stim ca iti plac motoarele asa ca uite o lista cu motoarele noastre ordonate descrescator dupa putere</h3>
    
    <?php     
        echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>Versiune</th>
         <th>Tip motor</th>
         <th>Nr cilindri</th>
         <th>Putere [cp]</th>
         <th>Consum mixt [L/100km]</th>
         <th>Volum [cm^3]</th>
         <th>Tip cutie viteze [L]</th>
         
         </tr>";
        do {
            echo "<tr>";
            echo "<td>" . $rs_query3['Nume'] . "</td>";
            echo "<td>" . $rs_query3['TipMotor'] . "</td>";
            echo "<td>" . $rs_query3['NrCilindri'] . "</td>";
            echo "<td>" . $rs_query3['Putere'] . "</td>";
            echo "<td>" . $rs_query3['ConsumMixt'] . "</td>";
            echo "<td>" . $rs_query3['Volum'] . "</td>";
            echo "<td>" . $rs_query3['TipCutieViteze'] . "</td>";
            echo "</tr>"; 
        } while($rs_query3 = mysql_fetch_assoc($query3));  
       
        echo "</table>"; 
    ?>
    
    <h3>Sunteti in cautarea unei masini cu consum redus? Iata topul celor mai mici consumuri mixte obtinute de modelele noastre </h3>
    
    <?php     
        echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>Model</th>
         <th>Versiune</th>
         <th>Consum Mixt [L/100km]</th>
         </tr>";
        do {
            echo "<tr>";
            echo "<td>" . $rs_query5['Model'] . "</td>";
            echo "<td>" . $rs_query5['Versiune'] . "</td>";
            echo "<td>" . $rs_query5['ConsumMixt'] . "</td>";
            echo "</tr>"; 
        } while($rs_query5 = mysql_fetch_assoc($query5));  
       
        echo "</table>"; 
    ?>
    

    <h5> Pentru a adauga, sterge sau modifica continutul tabelei Motor, da click aici </h5>
    <button id="motorButton" class="float-left submit-button btn btn-info" >Modifica</button>

    <script type="text/javascript">
        document.getElementById("motorButton").onclick = function () {
            location.href = "http://localhost/PhpProject1/motor.php";
        };
    </script>
  </div>

  <hr/>
  
   <div class="container">
    <h1><a name="Performante">Performante</a></h1>
    <h3>Aici la Porsche, performantele masinilor constituie o provocare. Iata de ce sunt in stare vehiculele noastre </h3>
    
    <?php     
        echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>Model</th>
         <th>Versiune</th>
         <th>Acceleratie 0-100km/h [s]</th>
         <th>Viteza maxima [km/h]</th>
         <th>Acceleratie 0-160km/h [s]</th>
         </tr>";
        do {
            echo "<tr>";
            echo "<td>" . $rs_query6['Model'] . "</td>";
            echo "<td>" . $rs_query6['Versiune'] . "</td>";
            echo "<td>" . $rs_query6['Acceleratie100'] . "</td>";
            echo "<td>" . $rs_query6['VitezaMaxima'] . "</td>";
            echo "<td>" . $rs_query6['Acceleratie160'] . "</td>";
            echo "</tr>"; 
        } while($rs_query6 = mysql_fetch_assoc($query6));  
       
        echo "</table>"; 
    ?>
    
    <h3>Doriti o masina rapida cu care sa va faceti praf prietenii cand plecati de la semafor? Iata o lista cu cele mai rapide versiuni ale fiecarui model </h3>
    
    <?php     
        echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>Model</th>
         <th>Versiune</th>
         <th>Acceleratie 0-100km/h [s]</th>
         </tr>";
        do {
            echo "<tr>";
            echo "<td>" . $rs_query7['Model'] . "</td>";
            echo "<td>" . $rs_query7['Versiune'] . "</td>";
            echo "<td>" . $rs_query7['Acceleratie100'] . "</td>";
            echo "</tr>"; 
        } while($rs_query7 = mysql_fetch_assoc($query7));  
       
        echo "</table>"; 
    ?>
    

    <h5> Pentru a adauga, sterge sau modifica continutul tabelei Performante, da click aici </h5>
    <button id="performanteButton" class="float-left submit-button btn btn-info" >Modifica</button>

    <script type="text/javascript">
        document.getElementById("performanteButton").onclick = function () {
            location.href = "http://localhost/PhpProject1/performante.php";
        };
    </script>
  </div>

  <hr/>

 
   <div class="container">
    <h1><a name="Extra Optiuni">Extra Optiuni</a></h1>
    <h3>Cand vine vorba de extra-optiuni, Porsche stie sa se faca remarcata. Iata o lista cu versiunile noastre care beneficiaza de extra-optiuni din categoria "Comfort"</h3>
    
    <?php     
        echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>Versiune</th>
         </tr>";
        do {
            echo "<tr>";         
            echo "<td>" . $rs_query8['Nume'] . "</td>";
            echo "</tr>"; 
        } while($rs_query8 = mysql_fetch_assoc($query8));  
       
        echo "</table>"; 
    ?>
    
    <h3>Esti curios sa vezi ce extra-optiuni in zona de 'Siguranta' oferim pentru modelele noastre mai exclusiviste? Arunca un ochi mai jos</h3>
    
    <?php     
        echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>Extraoptiune</th>
         </tr>";
        do {
            echo "<tr>";         
            echo "<td>" . $rs_query9['NumeOptiune'] . "</td>";
            echo "</tr>"; 
        } while($rs_query9 = mysql_fetch_assoc($query9));  
       
        echo "</table>"; 
    ?>
    
    <h3>Doriti o masina cu multe extra-optiuni disponibile pentru a va satisface toate nevoile la volan? Iata versiunile cu cele mai multe extra-optiuni </h3>
    
    <?php     
        echo "<table class='table table-bordered table-hover'>
         <tr>
         <th>Model</th>
         <th>Versiune</th>
         <th>Nr ExtraOptiuni disponibile</th>
         </tr>";
        do {
            echo "<tr>";         
            echo "<td>" . $rs_query10['Model'] . "</td>";
            echo "<td>" . $rs_query10['Versiune'] . "</td>";
            echo "<td>" . $rs_query10['NrOptiuni'] . "</td>";
            echo "</tr>"; 
        } while($rs_query10 = mysql_fetch_assoc($query10));  
       
        echo "</table>"; 
    ?>

    <h5> Pentru a adauga, sterge sau modifica continutul tabelei ExtraOptiuni, da click aici </h5>
    <button id="extraOptiuniButton" class="float-left submit-button btn btn-info" >Modifica</button>

    <script type="text/javascript">
        document.getElementById("extraOptiuniButton").onclick = function () {
            location.href = "http://localhost/PhpProject1/extraoptiuni.php";
        };
    </script>
  </div>

  <hr/>

  <div class="container">
    <footer class="footer">
      <p class="text-muted pull-left">Porsche &copy; 2015-2016</p>
      <p class="text-muted pull-right">Ilinca Andrei, 332AA</p>
    </footer>
  </div>

  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/angular.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>