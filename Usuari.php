<?php
session_start();

$captcha = filter_input(INPUT_POST,"captcha");
$usuari  = filter_input(INPUT_POST,"usuari");
$pass    = filter_input(INPUT_POST,"contrasenya");

if (!isset($_SESSION['usuari'])) {
    if ($captcha != $_SESSION['captcha']['code']) {
        echo "<div id='error'><h3>Captcha Incorrecte.</h3></div>";
        echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
        exit();
    }

    include("db_utils.php");
    $connexio = obte_connexio();

    $consulta = "SELECT * FROM usuaris WHERE nom='$usuari' AND contrasenya = '". md5($pass)."'";

	$resultat = mysqli_query($connexio, $consulta);

	// L'error aquí apareix si la consulta no està ben feta, si està ben feta retorna un resultat.
	if (!$resultat){
        echo "<div id='error'><h3>Usuari Incorrecte (error en SQL)</h3></div>";
        echo "Detalls de l'Error: ". mysqli_error($connexio) . "<br>";
        echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
	    exit();
	}

    $fila = mysqli_fetch_array($resultat);
    // Aqui mirem si tenim resultat. Si l'usuari no es correcte retorna FALSE.
    if (!$fila) {
        echo "<div id='error'><h3>Usuari Incorrecte.</h3></div>";
        echo "<a id='tornar' href='index.php'>Tornar</a><br><br><br>";
        exit();
    } else {
        $_SESSION['admin'] = $fila['admin'];
        $_SESSION['usuari'] = $fila['nom'];
    }
}

function menuAdmin() {
    echo '<h2>Menu administrador</h2>';
    echo '<a href="altaUsuari.php">Afegir Usuaris</a><br/>';
    echo '<a href="consultarUsuaris.php">Consultar Usuaris</a><br/>';
    menuUser();
}

function menuUser() {
    echo '<h2>Menu usuari</h2>';
    echo '<a href="consultaTasques.php">Consultar les meves tasques</a><br/>';
    echo '<a href="altaTasques.php">Crear tasca</a><br/>';
    echo '<a href="Sortir.php">Sortir</a><br/>';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>EAC 2</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header>
            <h1 id="titol_aplicacio">TODO List</h1>
            <span id="usuari"><?php echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>';?></span>
            <a id="tornar" href="Usuari.php">Tornar</a><br><br><br>
        </header>
        <?php
        if ($_SESSION['admin'] == 1) {
		    menuAdmin();
        } elseif (isset ($_SESSION['usuari'])) {
		    menuUser();
        } else {
            echo "No t'has autenticat";
        }
        ?>
    </body>
</html>