<?php
session_start();

include_once("db_utils.php");
$connexio = obte_connexio();

$consulta = "SELECT nom, nomCognom, nif, admin FROM usuaris";
$resultat = mysqli_query($connexio, $consulta);

if(!$resultat)
{
	echo "<div id='error'><h3>No hi han usuaris (error en SQL)</h3></div>";
	echo "Detalls de l'Error: ". mysqli_error($connexio) . "<br>";
	echo "<a id='tornar' href='usuari.php'>Tornar</a><br><br><br>";
	exit();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>consultarUsuaris</title>
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
			</thead>
			<tbody>
			<?php
				if( mysqli_num_rows($resultat) > 0){
					while($fila = mysqli_fetch_array($resultat)) {
						echo "<tr>";
							echo "<td>".$fila['nom']."</td>";
							echo "<td>".$fila['nomCognom']."</td>";
							echo "<td>".$fila['nif']."</td>";
							echo "<td>".$fila['admin']."</td>";
							echo "<td>
								<form name='canvirol' action='canviRolUsuari.php' method='POST'>								
									<input type='hidden' name='admin' value='".$fila['admin']."'>
									<input type='hidden' name='nif' value='".$fila['nif']."'>
									<input type='submit' value='Canvi Rol'>
								</form>
							</td>";
							echo "<td>
								<form name='modifica' action='modificaUsuari.php' method='POST'>
									<input type='hidden' name='nif' value='".$fila['nif']."'>
									<input type='submit' value='Modifica'>
								</form>
							</td>";
							echo "<td>
								<form name='canvipass' action='canviPassword.php' method='POST'>
									<input type='hidden' name='nif' value='".$fila['nif']."'>								
									<input type='password' name='noupassword' value=''>
									<input type='submit' value='Nou password'>
								</form>
							</td>";
							echo "<td>
								<form name='delete' action='borraUsuari.php' method='POST'>
									<input type='hidden' name='nif' value='".$fila['nif']."'>
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

