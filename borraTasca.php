<?php
session_start();

// zona restringida a usuaris autenticats
if (!isset($_SESSION["usuari"])) {
    echo "<div id='error'><h3>Zona restringida a usuaris autenticats.</h3></div>";
    echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
    exit();
}

//ID es la clau primària de la taula, ens serveix per identificar el registre
$id  = filter_input(INPUT_POST,"id");

include_once("db_utils.php");

$connexio = obte_connexio();

$consulta = "DELETE FROM tasques WHERE id = '" . $id . "'";
$resultat = mysqli_query($connexio, $consulta);

if (!$resultat) {
    $error =  "Error en esborrar la tasca";
    //@todo posar a tot arreu i no cal fer exit
    echo mysqli_error($connexio);
    echo "<div id='error'><h3>Error en esborrar la tasca.</h3></div>";
    echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
    exit();
} else {
    $message =  "Tasca esborrada correctament";
}
include_once("consultaTasques.php");

?>