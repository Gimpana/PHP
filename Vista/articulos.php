<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
</head>
<body>

	<?php 

		include "../Controlador/funciones.php";
		

	?>

	<h1>Lista de artículos</h1>

	<?php 
	$comp = getPermisos();
	if ($comp == 1){
		echo "<a href='formArticulos.php?Anadir'>Añadir producto</a>";
	}

	$comp = getPermisos();
	if(!isset($_COOKIE["tipoUsuario"]) or ($_COOKIE["tipoUsuario"] != "Autorizado")){
		echo "No tienes permiso para estar aquí";
	}
	else{
		if(!isset($_GET["orden"])){
			$orden = "ProductID";
		}
		else{
			$orden = $_GET["orden"];
		}
		pintaProductos($orden);
	}
	?>
</body>
</html>