<?php
include "conexion.php";

$consulta = "SELECT nom,nomCognom,nif,admin FROM usuaris";
$resultat = $mysqli->query($consulta);

if(!$resultat)
{
	echo "No hi han usuaris";
	exit;
}	
echo 'Usuari: ' . $_SESSION['usuari'] . '<br/><br/>';
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

while($fila = $resultat->fetch_assoc())
{
	
	echo "<tr>".
	"<td>".$fila['usuari']."</td>".
	"<td>".$fila['nomcognom']."</td>".
	"<td>".$fila['nif']."</td>".
	"<td>".$fila['admin']."</td>".
	
	//botó canvi de rol
	"<td>
	<form action='canviRolUsuari.php' method='post'>
	<input type='hidden' name='usuari' value='.$fila['usuari'].'>
	<input type='submit' value='Canvi Rol'>
	</form>
	</td>".
	
	//botó modificar
	"<td>
	<form action='modificarUsuari.php' method='post'>
	<input type='hidden' name='usuari' value='.$fila['usuari'].'>
	<input type='submit' value='Modificar'>
	</form>
	</td>".
	
	//Modificar password
	"<td>
	<form action='canviPassword.php' method='post'>
	<input type='hidden' name='usuari' value='.$fila['usuari'].'>
	<input type='password' name='password'>
	<input type='submit' value='Nou password'>
	</form>
	</td>".
	
	//botó borrar
	"<td>
	<form action='borraUsuari.php' method='post'>
	<input type='hidden' name='usuari' value='.$fila['usuari'].'>
	<input type='submit' value='Borrar'>
	</form>
	</td>".
	
	"</tr>";
	
}

echo "</tbody></table>";

?>

