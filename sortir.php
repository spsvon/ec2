<?php
session_start();
include ("conexion.php");
mysqli_close($connexio);
session_destroy();
echo "Fins una altra!!!";
?>
<html>
<body>

<a href="usuari.php">Tornar</a>

</body>
</html>
