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

	//Comprobará si el acceso a esta página se ha hecho por un usuario que tiene los permisos suficientes, comprobando la cookie creada en index.php.
	$comp = getPermisos();
	if($_COOKIE["tipo"] != "Autorizado"){
		echo "No tienes permiso para estar aquí";
	
	//En el caso de que estén los permisos de la aplicación activados, aparecerán también las siguientes opciones:
	//Un enlace para añadir un producto que lleva a formArticulo.php
	
	}elseif($comp != 0){
		echo "<a href='formArticulos.php?Anadir'>Añadir producto</a>";
		if(!isset($_GET["orden"])){
			$orden = "ProductID";
			//Mostrará una tabla con los datos de todos los productos almacenados con las siguientes columnas: ID, Nombre, Coste, Precio, Categoría y Acciones.
			pintaProductos($orden);
			//Tendrá un enlace que permitirá volver a index.php.
			echo "<a href='index.php'>Volver al indice</a>";
		}elseif($_GET["orden"]){
			$orden = $_GET["orden"];
			pintaProductos($orden);
			echo "<a href='index.php'>Volver al indice</a>";
		}
		
	}else{
		if(!isset($_GET["orden"])){
			$orden = "ProductID";
			//Mostrará una tabla con los datos de todos los productos almacenados con las siguientes columnas: ID, Nombre, Coste, Precio, Categoría y Acciones.
			pintaProductos($orden);
			//Tendrá un enlace que permitirá volver a index.php.
			echo "<a href='index.php'>Volver al indice</a>";
		}elseif($_GET["orden"]){
			$orden = $_GET["orden"];
			pintaProductos($orden);
			echo "<a href='index.php'>Volver al indice</a>";
		}
	}

	?>

</body>
</html>