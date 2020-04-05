<?php
session_start();

$nom = filter_input(INPUT_POST,"usuari");
$nomcog = filter_input(INPUT_POST,"nom");
$nif = filter_input(INPUT_POST,"nif");
//El nif original el passem per poder modificar el NIF, sino no seria possible degut a que l'emprem com a PK a la consulta de UPDATE
$nif_original = filter_input(INPUT_POST,"nif_original");
// Com que admin es un input de formulari tipus check, no s'envia per formulari si no està checked
// vist a https://stackoverflow.com/questions/27056958/php-filter-input-set-to-default-value-if-get-key-not-set
// vist a https://www.php.net/manual/es/filter.filters.validate.php
$admin = filter_input(INPUT_POST,"admin", FILTER_VALIDATE_BOOLEAN, array("options" => array("default" => '0')));

include_once("db_utils.php");

$connexio = obte_connexio();

$consulta = "UPDATE usuaris SET nom = '".$nom."', nif = '".$nif."', admin = ".$admin.", nomCognom = '".$nomcog."' WHERE nif='".$nif_original."'";

$resultat = mysqli_query($connexio, $consulta);

echo $consulta;
if (!$resultat) {
    $error =  "Error en modificar l'usuari";
    echo "<div id='error'><h3>Error en modificar l'usuari.</h3></div>";
    echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
    exit();
} else {
    $message =  "Usuari modificat correctament";
}
include_once("consultarUsuaris.php");

?>