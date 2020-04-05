<?php
session_start();
include "conexion.php";

$consulta = "SELECT nom,nomCognom,nif,admin FROM usuaris";
$resultat = mysqli_query($connexio, $consulta);

if(!$resultat)
{
	echo "No hi han usuaris";
	exit;
}
	
echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>';
echo '<a href="usuari.php">Tornar</a><br><br><br>';
if( mysqli_num_rows($resultat) > 0){
echo "<table>
	<title> Llista d'usuaris: </title>
	<thead>
		<tr>
		<th>Nom Usuari</th>
		<th>Nom i Cognom</th>
		<th>NIF</th>
		<th>Administrador?</th>
		<th>Canvi de Rol</th>
		<th>Modificar</th>
		<th>Modifica Password</th>
		<th>Eliminar</th>
		</tr>
	<t/head>
	<tbody>";

while($fila = mysqli_fetch_array($resultat))
	{
	
	echo "<tr>";
	echo "<td>".$fila['nom']."</td>";
	echo "<td>".$fila['nomCognom']."</td>";
	echo "<td>".$fila['nif']."</td>";
	echo "<td>".$fila['admin']."</td>";
	
	echo "<td>
	<form name='canvirol' action='canviRolUsuari.php' method='POST'>
	<input type='hidden' name='rol' value='.$fila['admin'].'>
	<input type='submit' value='Canvi Rol'>
	</form>
	</td>";
	
	echo "<td>
	<form name='modifica' action='modificarUsuari.php' method='POST'>
	<input type='hidden' name='modify' value=''>
	<input type='submit' value='Modifica'>
	</form>
	</td>";
	
	echo "<td>
	<form name='canvipass' action='canviPassword.php' method='POST'>
	<input type='hidden' name='noupass' value=''>
	<input type='submit' value='Nou password'>
	</form>
	</td>";
	
	echo "<td>
	<form name='delete' action='borraUsuari.php' method='POST'>
	<input type='hidden' name='borra' value=''>
	<input type='submit' value='Borrar'>
	</form>
	</td>";
	
	echo "</tr>";
	
}

echo "</tbody>";
echo "</table>";
}
?>
