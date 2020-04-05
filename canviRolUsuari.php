<?php
session_start();

//NIF es la clau primària de la taula, ens serveix per identificar el registre
$nif  = filter_input(INPUT_POST,"nif");
$rol_actual  =   filter_input(INPUT_POST,"admin");

include_once("db_utils.php");

$connexio = obte_connexio();

$consulta = "UPDATE usuaris SET admin = !$rol_actual WHERE nif = '" . $nif . "'";
$resultat = mysqli_query($connexio, $consulta);

include_once("consultarUsuaris.php");

?>