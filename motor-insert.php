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

$tipMotor = $_POST['TipMotor'];
$nrCilindri = $_POST['NrCilindri'];
$putere = $_POST['Putere'];
$consumMixt = $_POST['ConsumMixt'];
$emisiiCO2 = $_POST['EmisiiCO2'];
$volum = $_POST['Volum'];
$tipCutieViteze = $_POST['TipCutieViteze'];


$query = "INSERT INTO motor VALUES
('','$tipMotor','$nrCilindri','$putere','$consumMixt','$emisiiCO2','$volum','$tipCutieViteze')";

if(!mysql_query($query)) {
    die('Error: ' . mysql_error());
}

echo 'Adaugare reusita!';
echo "<div class='my_content_container'>
    <a href='http://localhost/PhpProject1/motor.php'>Inapoi la tabela Motor sa vedem schimbarile</a>
</div>"
/*
mysql_query($query);  
mysql_close(); */
?>
