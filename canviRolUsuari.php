<?php
session_start();
include "conexion.php";

$consulta = "SELECT admin FROM usuari WHERE usuari = '" . $_POST['admin'] . "'";
$result = mysqli_query($consulta);
$datos = mysqli_fetch_assoc($result);
$nouestat = !$datos['admin'];
$consulta = "UPDATE `usuaris` SET `admin` = '1' WHERE `usuaris`.`nif` = '$nif'";

// UPDATE usuaris SET admin = $nouestat WHERE usuari = '" . $_POST['usuari'] . "'";
mysqli_query($consulta);

echo "<script>Location.href='consultarUsuaris.php'</script>";

?>

