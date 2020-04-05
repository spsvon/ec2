<?php
session_start();

$nif = $_SESSION['nif'];

// zona restringida a usuaris autenticats
if (!isset($_SESSION["usuari"])) {
    echo "<div id='error'><h3>Zona restringida a usuaris autenticats.</h3></div>";
    echo "<a id='tornar' href='simple-php-captcha-master/index.php'>Tornar</a><br><br><br>";
    exit();
}

include_once("db_utils.php");
$connexio = obte_connexio();

$consulta = "SELECT * FROM tasques WHERE nifPropietari = '$nif'";
$resultat = mysqli_query($connexio, $consulta);

if(!$resultat)
{
    echo "<div id='error'><h3>No hi han tasques (error en SQL)</h3></div>";
    echo "Detalls de l'Error: ". mysqli_error($connexio) . "<br>";
    echo "<a id='tornar' href='usuari.php'>Tornar</a><br><br><br>";
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>consultarTasques</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header>
            <h1 id="titol_aplicacio">TODO List</h1>
            <span id="usuari"><?php echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>';?></span>
            <a id="tornar" href="usuari.php">Tornar</a><br><br><br>
            <div id="message"><?php if (isset($message)) echo $message; ?></div><br>
        </header>
        <table>
            <title> Llista de Tasques: </title>
            <thead>
            <tr>
                <th>Nom</th>
                <th>Descripcio</th>
                <th>NIF Propietari</th>
                <th>complert %</th>
                <th>Completar</th>
                <th>Modifica</th>
                <th>Borrar</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if( mysqli_num_rows($resultat) > 0){
                while($fila = mysqli_fetch_array($resultat)) {
                    echo "<tr>";
                        echo "<td>".$fila['nom']."</td>";
                        echo "<td>".$fila['descripcio']."</td>";
                        echo "<td>".$fila['nifPropietari']."</td>";
                        echo "<td>".$fila['complert']."%</td>";
                        echo "<td>
                                <form name='completar' action='completarTasca.php' method='POST'>								
                                    <input type='hidden' name='id' value='".$fila['id']."'>
                                    <input type='number' min='0' max='100' name='complert' value='".$fila['complert']."'>
                                    <input type='submit' value='Completar'>
                                </form>
                              </td>";
                        echo "<td>
                                <form name='modifica' action='modificaTasca.php' method='POST'>
                                    <input type='hidden' name='id' value='".$fila['id']."'>
                                    <input type='submit' value='Modifica'>
                                </form>
                              </td>";
                        echo "<td>
                                <form name='delete' action='borraTasca.php' method='POST'>
                                    <input type='hidden' name='id' value='".$fila['id']."'>
                                    <input type='submit' value='Borrar'>
                                </form>
                              </td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </body>
</html>