<?php
session_start();

// zona restringida a usuaris autenticats
if (!isset($_SESSION["usuari"])) {
    echo "<div id='error'><h3>Zona restringida a usuaris autenticats.</h3></div>";
    echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
    exit();
}

//id es la clau primària de la taula, ens serveix per identificar el registre
$id  = filter_input(INPUT_POST,"id");
$complert  = filter_input(INPUT_POST,"complert");

include_once("db_utils.php");

$connexio = obte_connexio();

$consulta = "UPDATE tasques SET complert = $complert WHERE id = '$id '";
$resultat = mysqli_query($connexio, $consulta);

include_once("consultaTasques.php");

?>