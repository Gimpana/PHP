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

		if(!isset($_COOKIE["tipo"]) or ($_COOKIE["tipo"] != "Super")){
			echo "No tienes permiso para estar aquí";
		}
		else {
			if (isset($_GET["cambiar"])){
				cambiarPermisos();
			}
		}
		
	?>

	<p>
		Los permisos actuale están a 
		<span>
			<?php 
				
				echo getPermisos();

			; ?> 
		</span>
	</p>

	<form action="usuarios.php" method="GET">
		<p><input type="submit" value="Cambiar permisoso" name="cambiar"></p>
	</form>

	<?php
		pintaTablaUsuarios();


	?>
	
	<a href='/PHP_DESARROLLO/Vista/index.php'>Volver al inicio</a>

</body>
</html>