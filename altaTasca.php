<?php
session_start();

// zona restringida a usuaris autenticats
if (!isset($_SESSION["usuari"])) {
    echo "<div id='error'><h3>Zona restringida a usuaris autenticats.</h3></div>";
    echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
    exit();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>AltaTasca</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header>
            <h1 id="titol_aplicacio">TODO List</h1>
            <span id="usuari"><?php echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>';?></span>
            <a id="tornar" href="usuari.php">Tornar</a><br><br><br>
        </header>
        <h2>Formulari d'Alta de Tasques</h2>
        <form name="alta" method="POST" action="insertTasca.php"> <br><br>
            <input type="hidden" name="nif" id="nif" value="<?php echo $_SESSION['nif']?>">
            <label for="nomtasca">Nom Tasca:</label>
            <input type="text" name="nomtasca" id="nomtasca"><br><br>
            <label for="descripcio">Descripció:</label>
            <input type="text" name="descripcio" id="descripcio"><br><br>
            <input type="submit" value="Guardar"><br>
        </form>
    </body>
</html>