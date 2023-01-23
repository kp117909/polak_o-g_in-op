<?php
$host = "51.77.56.204";
$db_user = "koza";
$db_pass = "54FzludzenieoptyczenGTEWRg4";
$db_name = "pizzeria";

$db = new PDO('mysql:host=51.77.56.204;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$polaczenie = @new mysqli($host, $db_user, $db_pass, $db_name);
$polaczenie2 = @new mysqli($host, $db_user, $db_pass, $db_name);
?>

