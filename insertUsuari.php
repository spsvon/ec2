<?php
session_start();

$nom = filter_input(INPUT_POST,"usuari");
$nif = filter_input(INPUT_POST,"nif");
$pass = filter_input(INPUT_POST,"contrasenya");
$admin = filter_input(INPUT_POST,"admin");
$nomcog = filter_input(INPUT_POST,"nom");

// include ("conexion.php"); //
echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>';
echo '<a href="usuari.php">Tornar</a><br><br><br>';
    $host     = 'localhost';
    $user     = 'ioc';
    $password = 'ioc';
    $database = 'asx_mp09_eac2';
    $connexio = mysqli_connect($host, $user, $password);

    if (!$connexio) {
        echo '<h1>Error de connexio amb la Base de Dades</h1>';
        exit();
    }
    mysqli_select_db($connexio, $database);
    $consulta = "SELECT admin FROM usuaris WHERE admin='1' AND nom='$_SESSION['usuari']'";
    if ($resultat = mysqli_query($connexio, $consulta)){
    while ($r = mysqli_fetch_assoc($resultat)){
	printf ( "%s", $r['admin']);
	}
    }

// 	if ($resultat = mysqli_query($connexio, $consulta)){
// 	$result = mysqli_fetch_row($resultat);
	
		if (count($resultat) == 0){
		"INSERT INTO `usuaris` VALUES ('$nom','$nif',md5('$pass'),'$admin','$nomcog')";
			if (mysqli_query($consulta)){
			echo 'Usuari inserit correctament';
			}
			else {
			echo 'Les dades no han sigut grabades';
			}
		}
	}
	else {
            echo "No hi han permisos per fer aquesta alta";
        }
?>
