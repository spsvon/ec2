<?php
session_start();

$nif = filter_input(INPUT_POST,"nif");

include_once("db_utils.php");
$connexio = obte_connexio();
$consulta = "SELECT * FROM usuaris WHERE nif = '".$nif."'";
echo $consulta;

if (!$resultat = mysqli_query($connexio, $consulta)) {
    echo "<div id='error'><h3>Error en consultar l'usuari amb NIF $nif </h3></div>";
    echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
    exit();
}
$fila = mysqli_fetch_array($resultat);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>modificarUsuari</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header>
            <h1 id="titol_aplicacio">TODO List</h1>
            <span id="usuari"><?php echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>'; ?></span>
            <a id="tornar" href="usuari.php">Tornar</a><br><br><br>
        </header>
        <h2>Formulari de Modificació d'Usuaris :<?= $fila['admin']?></h2>
        <form name="modifica" method="POST" action="modificarUsuari.php"><br><br>
            <input type="hidden" name="nif_original" id="nif_original" value="<?php echo $fila['nif']?>"><br><br>
            <label for="usuari">Nom Usuari:</label>
            <input type="text" name="usuari" id="usuari" value="<?php echo $fila['nom']?>"><br><br>
            <label for="nom">Nom i Cognoms:</label>
            <input type="text" name="nom" id="nom" value="<?php echo $fila['nomCognom']?>"><br><br>
            <label for="nif">NIF:</label>
            <input type="text" name="nif" id="nif" value="<?php echo $fila['nif']?>"><br><br>
            <label for="admin">Administrador:</label>
            <input type="checkbox" name="admin" id="admin" value="1" <?php if ($fila['admin'] == 1) echo "checked"?>><br><br>
            <input type="submit" value="Modificar"><br>
        </form>
    </body>
</html>