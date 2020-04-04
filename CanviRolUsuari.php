<?php
include "conexion.php";


$consulta = "SELECT administrador FROM usuari WHERE usuari = '" . $_POST['usuari'] . "'";
$resultado = $mysqli->query($consulta);
$datos = $resultado->fetch_assoc();
$nouestat = !$datos['administrador'];
$consulta = "UPDATE usuaris SET administrador = $nouestat WHERE usuari = '" . $_POST['usuari'] . "'";
$mysqli->query($consulta);

// NO ESTA PERMITIDO	header("Location: consultarUsuaris.php");//





?>

