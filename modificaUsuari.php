<?php
session_start();
echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>';
?>
<html>
	<body>
		<a href="usuari.php">Tornar</a><br><br><br>
	

	<form name="modifica" method="POST" action="modificarUsuari.php"> <br><br>
	Nom Usuari:<input type="text" name="usuari"><br><br>
	Nom i Cognoms:<input type="text" name="nom"><br><br>
	NIF:<input type="text" name="nif"><br><br>
	Administrador:<input type="checkbox" name="admin" value="1"><br><br>
	<a href="modificarUsuari.php"><input type="button" value="Modificar"></a><br>
	</form>
	
	</body>
</html>	

