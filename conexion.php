<?php

global $connexio;

$connexio = mysqli_connect("localhost", "ioc", "ioc", "asx_mp09_eac2");
	if (! $connexio){
	echo ('No es pot connectar a la Base de Dades' . mysql_error());
	exit();
	}
?>
