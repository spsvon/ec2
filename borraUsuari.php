<?php
session_start();

//NIF es la clau primària de la taula, ens serveix per identificar el registre
$nif  = filter_input(INPUT_POST,"nif");

include_once("db_utils.php");

$connexio = obte_connexio();

$consulta = "DELETE FROM usuaris WHERE nif = '" . $nif . "'";
$resultat = mysqli_query($connexio, $consulta);

if (!$resultat) {
    $error =  "Error en esborrar l'usuari";
    //@todo posar a tot arreu i no cal fer exit
    echo mysqli_error($connexio);
    echo "<div id='error'><h3>Error en modificar l'usuari.</h3></div>";
    echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
    exit();
} else {
    $message =  "Usuari esborrat correctament";
}
include_once("consultarUsuaris.php");

?>

