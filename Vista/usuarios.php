<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Usuarios</title>
</head>
<body>
	<?php 

		include "../Controlador/funciones.php";
		//Comprobará si el acceso a esta página se ha hecho por un usuario que tiene los permisos suficientes, comprobando la cookie creada en index.php.
		if(!isset($_COOKIE["tipo"]) or ($_COOKIE["tipo"] != "Super")){
			echo "No tienes permiso para estar aquí";
		}
		else{	
			if (isset($_GET["cambiar"])){
				cambiarPermisos();
			}
				echo "<p>Los permisos actuale están a ";
				echo getPermisos(). "</p>";
				echo '<form action="usuarios.php" method="GET">';
				//Tendrá un botón que, al pulsar sobre él, cambiará el valor de los permisos de la aplicación.
				echo '<p><input type="submit" value="Cambiar permisoso" name="cambiar"></p></form>';
				echo pintaTablaUsuarios();
				//Tendrá un enlace que permitirá volver a index.php.
				echo "<a href='/PHP_DESARROLLO/Vista/index.php'>Volver al inicio</a>";
		}
	?>

</body>
</html>