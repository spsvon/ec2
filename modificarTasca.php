<?php
session_start();

// zona restringida a usuaris autenticats
if (!isset($_SESSION["usuari"])) {
    echo "<div id='error'><h3>Zona restringida a usuaris autenticats.</h3></div>";
    echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
    exit();
}

$nomtasca = filter_input(INPUT_POST,"nomtasca");
$descripcio = filter_input(INPUT_POST,"descripcio");
$id = filter_input(INPUT_POST,"id");

include_once("db_utils.php");

$connexio = obte_connexio();

$consulta = "UPDATE tasques SET nom = '$nomtasca', descripcio = '$descripcio' WHERE id = $id";

$resultat = mysqli_query($connexio, $consulta);

if (!$resultat) {
    $error =  "Error en modificar la tasca";
    echo "<div id='error'><h3>Error en modificar la tasca.</h3></div>";
    echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
    exit();
} else {
    $message =  "Tasca modificada correctament";
}
include_once("consultaTasques.php");

?>