<?php

global $connexio;

$connexio = mysqli_connect("localhost", "ioc", "ioc", "asx_mp09_eac2");
	if (! $connexio){
	echo ('No es pot connectar ala la Base de Dades' . mysql_error());
	exit();
	}
?>
