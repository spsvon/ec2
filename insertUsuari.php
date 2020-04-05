<?php
session_start();

$nom = filter_input(INPUT_POST,"usuari");
$nomcog = filter_input(INPUT_POST,"nom");
$nif = filter_input(INPUT_POST,"nif");
$pass = filter_input(INPUT_POST,"contrasenya");
// Com que admin es un input de formulari tipus check, no s'envia per formulari si no està checked
// vist a https://stackoverflow.com/questions/27056958/php-filter-input-set-to-default-value-if-get-key-not-set
// vist a https://www.php.net/manual/es/filter.filters.validate.php
$admin = filter_input(INPUT_POST,"admin", FILTER_VALIDATE_BOOLEAN, array("options" => array("default" => '0')));
?>
<!DOCTYPE html>
<html>
    <head>
        <title>insertUsuari</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
	<body>
        <header>
            <h1 id="titol_aplicacio">TODO List</h1>
            <span id="usuari"><?php echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>';?></span>
            <a id="tornar" href="Usuari.php">Tornar</a><br><br><br>
        </header>
        <h2>Formulari d'Alta</h2>
<?php
    include("db_utils.php");
    $connexio = obte_connexio();

    $consulta = "SELECT * FROM usuaris WHERE admin = 1 AND nom = '".$_SESSION['usuari']."'";
  
	if ($resultat = mysqli_query($connexio, $consulta)){
	    // Si en fer la consulta trobem que tenim 1 resultat, es que l'usuari és administrador
        if (mysqli_fetch_array($resultat) == 1){
            echo "Si no et admin / No hi han permisos per fer aquesta alta";
        } else {
            mysqli_free_result($resultat);
            $consulta_insert = "INSERT INTO usuaris VALUES ('$nom','$nif',md5('$pass'),$admin,'$nomcog')";
            if (mysqli_query($connexio, $consulta_insert)){
                echo "Usuari inserit correctament";
            } else {
                echo "Les dades no han sigut grabades";
                echo "<br> Detalls de l'Error: ". mysqli_error($connexio) . "<br>";
            }
        }
	}
	else {
            echo "No hi han permisos per fer aquesta alta";
            echo "<br> Detalls de l'Error: ". mysqli_error($connexio) . "<br>";
        }
?>
    </body>
</html>