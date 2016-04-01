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

$lungime = $_POST['Lungime'];
$latime = $_POST['Latime'];
$inaltime = $_POST['Inaltime'];
$greutate = $_POST['Greutate'];
$greutateMaximaPermisa = $_POST['GreutateMaximaPermisa'];
$portbagaj = $_POST['Portbagaj'];
$rezervor = $_POST['Rezervor'];


$query = "INSERT INTO caroserie VALUES
('','$lungime','$latime','$inaltime','$greutate','$greutateMaximaPermisa','$portbagaj','$rezervor')";

if(!mysql_query($query)) {
    die('Error: ' . mysql_error());
}

echo 'Adaugare reusita!';
echo "<div class='my_content_container'>
    <a href='http://localhost/PhpProject1/caroserie.php'>Inapoi la tabela Caroserie sa vedem schimbarile</a>
</div>"
/*
mysql_query($query);  
mysql_close(); */
?>
