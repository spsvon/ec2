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
$nif = filter_input(INPUT_POST,"nif");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>insertTasca</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header>
            <h1 id="titol_aplicacio">TODO List</h1>
            <span id="usuari"><?php echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>';?></span>
            <a id="tornar" href="usuari.php">Tornar</a><br><br><br>
        </header>
        <h2>Formulari d'Alta de tasca</h2>
        <?php
            include("db_utils.php");
            $connexio = obte_connexio();

            $consulta = "INSERT INTO tasques (nom, descripcio, nifPropietari) VALUES ('$nomtasca', '$descripcio', '$nif')";

            if ($resultat = mysqli_query($connexio, $consulta)){
                echo "Tasca inserida correctament";
            } else {
                echo "No s'ha pogut inserir la tasca";
                echo "<br> Detalls de l'Error: ". mysqli_error($connexio) . "<br>";
            }
        ?>
    </body>
</html>