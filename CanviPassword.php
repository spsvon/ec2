<?php
include "conexion.php";


$consulta = "UPDATE usuari SET  password = '". $_POST['password'] ."' WHERE usuari = '" . $_POST['usuari'] . "'";
$mysqli->query($consulta);

// NO ESTA PERMITIDO	header("Location: consultarUsuaris.php");//





?>

