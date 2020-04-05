<?php

function obte_connexio() {
    include("./credencials.php");
    $connexio = mysqli_connect($host, $user, $password, $database);
    if (!$connexio) {
        mostrar_error($connexio, "Error de connexio amb la Base de Dades");
        exit();
    } else {
        return $connexio;
    }
}

function mostrar_error($connexio, $missatge) {
    echo "<div id='error'>";
    echo "<b>$missatge</b><br>";
    echo "Detalls de l'Error: ". mysqli_error($connexio) . "<br>";
    echo "</div>";
}

function es_usuari_autenticat() {

}

function es_admin($usuari) {
    if (isset($_SESSION['admin'])) {
        if ($_SESSION['admin'] == "admin") {
           return true;
        }
    } else {
        $connexio = obte_connexio();
    }
}