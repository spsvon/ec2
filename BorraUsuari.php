<?php
include "conexion.php";


$consulta = "DELETE FROM usuari WHERE usuari = '" . $_POST['usuari'] . "'";
$mysqli->query($consulta);

// NO ESTA PERMITIDO	header("Location: consultarUsuaris.php");//






?>

