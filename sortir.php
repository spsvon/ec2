<?php
session_start();
include("db_utils.php");
$connexio = obte_connexio();
mysqli_close($connexio);
$usuari_sessio = $_SESSION['usuari'];
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sortir</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <header>
        <h1 id="titol_aplicacio">TODO List</h1>
        <a id="tornar" href="index.php">Tornar</a><br><br><br>
    </header>
    <body>
    Fins una altra <strong><?php echo $usuari_sessio?></strong>!!!
    </body>
</html>

