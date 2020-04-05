<?php
session_start();

// zona restringida a usuaris autenticats
if (!isset($_SESSION["usuari"])) {
    echo "<div id='error'><h3>Zona restringida a usuaris autenticats.</h3></div>";
    echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
    exit();
}

$id = filter_input(INPUT_POST,"id");

include_once("db_utils.php");
$connexio = obte_connexio();
$consulta = "SELECT * FROM tasques WHERE id = '".$id."'";

if (!$resultat = mysqli_query($connexio, $consulta)) {
    echo "<div id='error'><h3>Error en consultar la tasca amb Id $id </h3></div>";
    echo "<a id='tornar' href='usuari.php'>Tornar</a><br><br><br>";
    exit();
}
$fila = mysqli_fetch_array($resultat);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>modificarTasca</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header>
            <h1 id="titol_aplicacio">TODO List</h1>
            <span id="usuari"><?php echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>'; ?></span>
            <a id="tornar" href="usuari.php">Tornar</a><br><br><br>
        </header>
        <h2>Formulari de Modificació de Tasques :<?= $fila['admin']?></h2>
        <form name="modifica" method="POST" action="modificarTasca.php"><br><br>
            <input type="hidden" name="id" id="id" value="<?php echo $fila['id']?>"><br><br>
            <label for="nomtasca">Nom Tasca:</label>
            <input type="text" name="nomtasca" id="nomtasca" value="<?php echo $fila['nom']?>"><br><br>
            <label for="descripcio">Descripció:</label>
            <input type="text" name="descripcio" id="descripcio" value="<?php echo $fila['descripcio']?>"><br><br>
            <input type="submit" value="Guardar"><br>
        </form>
    </body>
</html>