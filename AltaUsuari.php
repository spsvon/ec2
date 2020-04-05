<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>AltaUsuari</title>
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
        <form name="alta" method="POST" action="insertUsuari.php"> <br><br>
            <label for="usuari">Nom Usuari:</label>
            <input type="text" name="usuari" id="usuari"><br><br>
            <label for="nom">Nom i Cognoms:</label>
            <input type="text" name="nom" id="nom"><br><br>
            <label for="nif">NIF:</label>
            <input type="text" name="nif" id="nif"><br><br>
            <label for="contrasenya">Password:</label>
            <input type="password" name="contrasenya" id="contrasenya"><br><br>
            <label for="admin">Administrador:</label>
            <input type="checkbox" name="admin" id="admin" value="1"><br><br>
            <input type="submit" value="Inserir"><br>
        </form>
	</body>
</html>