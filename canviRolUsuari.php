<?php
session_start();

// només admin pot accedir
if (!$_SESSION["admin"]) {
    echo "<div id='error'><h3>Zona restringida a usuaris administradors.</h3></div>";
    echo "<a id='tornar' href='usuari.php'>Tornar</a><br><br><br>";
    exit();
}

//NIF es la clau primària de la taula, ens serveix per identificar el registre
$nif  = filter_input(INPUT_POST,"nif");
$rol_actual  =   filter_input(INPUT_POST,"admin");

include_once("db_utils.php");

$connexio = obte_connexio();

$consulta = "UPDATE usuaris SET admin = !$rol_actual WHERE nif = '" . $nif . "'";
$resultat = mysqli_query($connexio, $consulta);

include_once("consultarUsuaris.php");

?>