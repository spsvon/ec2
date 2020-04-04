<?php
session_start();

$captcha = filter_input(INPUT_POST,"captcha");
$usuari = filter_input(INPUT_POST,"usuari");
$pass = filter_input(INPUT_POST,"contrasenya");
  
if (! isset($_SESSION['usuari'])) {
    if ($captcha != $_SESSION['captcha']['code']) {
        echo '<h3>Captcha Incorrecte.</h3>';
        exit();
    }

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
    $consulta = "select * from usuaris where nom='$usuari' and contrasenya = '". md5($pass)."'";

	$r=mysqli_query($connexio, $consulta);
	if (! $r){
	echo "usuari incorrecte";
	exit();
	}
    $resultat = mysqli_fetch_array($r);

    if ($resultat && $usuari == $resultat['nom'] && $usuari) {
	$_SESSION['user'] = $resultat['admin'];
	$_SESSION['usuari'] = $resultat['nom'];
    } else {
        echo '<h1>Usuari Incorrecte</h1>';
        exit();
    }
}

function menuAdmin() {

    echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>';
    echo '<h2>Menu administrador</h2>';
    echo '<a href="altaUsuari.php">Afegir Usuaris</a><br/>';
    echo '<a href="consultarUsuaris.php">Consultar Usuaris</a><br/>';
    echo '<h2>Menu usuari</h2>';
    echo '<a href="consultaTasques.php">Consultar les meves tasques</a><br/>';
    echo '<a href="altaTasques.php">Crear tasca</a><br/>';
    echo '<a href="sortir.php">Sortir</a><br/>';
}

function menuUser() {

    echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>';
    echo '<h2>Menu usuari</h2>';
    echo '<a href="consultaTasques.php">Consultar les meves tasques</a><br/>';
    echo '<a href="altaTasques.php">Crear tasca</a><br/>';
    echo '<a href="sortir.php">Sortir</a><br/>';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>EAC 2</title>
        <meta charset="utf-8"/>
    </head>
    <body>
        <?php

        if ($_SESSION['user'] == 1) {
		menuAdmin();
        } elseif (isset ($_SESSION['user'])) {
		menuUser();
        } else {
            echo "No t'has autenticat";
        }
        ?>
    </body>
</html>

