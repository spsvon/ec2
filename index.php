<?php
	session_start();
	set_include_path('/opt/lampp/lib/php');
	require_once("./simple-php-captcha-master/simple-php-captcha.php");
	$_SESSION['captcha'] = simple_php_captcha();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
	<body>
<?php
    echo "<img src=".$_SESSION['captcha']['image_src'].">";
	session_write_close();
?>
        <form name="logueo" method="POST" action="usuari.php"> <br><br>
            <label for="captcha">Captcha:</label>
            <input type="text" name="captcha" id="captcha"><br><br>
            <label for="usuari">Usuari:</label>
            <input type="text" name="usuari" id="usuari"><br><br>
            <label for="contrasenya">Contrasenya:</label>
            <input type="text" name="contrasenya" id="contrasenya"><br><br>
            <input type="submit" value="Entrar"><br>
        </form>
	</body>
</html>
