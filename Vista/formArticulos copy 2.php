<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de artículos</title>
</head>
<body>

	<?php 

		include "../Controlador/funciones.php";
		//include "../Modelo/consultas.php";

		//Comprobará si el acceso a esta página se ha hecho por un usuario que tiene los permisos suficientes, comprobando la cookie creada en index.php.
		$comp = getPermisos();
		if(!isset($_COOKIE["tipo"]) or ($_COOKIE["tipo"] != "Autorizado")){
			echo "No tienes permiso para estar aquí";
		}
		else{
			//En el caso de venir al formulario para Editar, mostrará el formulario completo con los datos del producto que se va a editar y el botón de Editar. 
			//Al realizar las modificaciones y pulsar sobre el botón, se modificará el producto en la base de datos y mostrará un mensaje de que el producto se ha modificado.
			if(isset($_GET["Editar"])){
				$id = $_GET["Editar"];
				$producto = getProducto($id);
				$fila = mysqli_fetch_assoc($producto);
				$nombre = $fila['Name'];
				$coste = $fila['Cost'];
				$precio = $fila['Price'];
				$categori = $fila['CategoryID'];
				echo $id;

				echo '<form action="'. $_SERVER["PHP_SELF"] .'" method="POST">
				ID: <input type="text" name="ID" id="" value="' .$id. '" disabled><br>
				<label>Nombre:</label> <input type="text" name="Nombre" id="" value="'.$nombre.'" required><br>
				Coste: <input type="text" name="Coste" id="" value=' . $coste . ' required><br>
				Precio: <input type="text" name="Precio" id="Precio" value=' . $precio . ' required><br>
				<label>Categoría:</label><select name="Categoría"> ';

				echo pintaCategorias($categori);
				echo '</select><br>
				
				<input type="submit" name="Editar" value="Editar"><br>
				</form>';


				echo "<a href='/PHP_DESARROLLO/Vista/articulos.php'>Volver a la tabla Articulos</a>";
			}
			//En el caso de venir al formulario para Añadir, mostrará un formulario vacío y el botón de Añadir. Al completar todos los datos y pulsar sobre el botón, 
			//se añadirá el producto a la base de datos y mostrará un mensaje de que el producto se ha añadido.
			elseif(isset($_GET["Anadir"])){
				echo '<form action="'. $_SERVER["PHP_SELF"] .'" method="POST">
				ID: <input type="text" name="ID" id="" value="" disabled><br>
				Nombre: <input type="text" name="Nombre" id="" required><br>
				Coste: <input type="text" name="Coste" id="" required><br>
				Precio: <input type="text" name="Precio" id="" required><br>
				<label>Categoría:</label><select name="Categoría" required> ';

				echo pintaCategorias($categori);
				echo '</select><br>
				
				<input type="submit" name="Agregar" value="Agregar"><br>
				</form>';

				echo "<a href='/PHP_DESARROLLO/Vista/index.php'>Volver a la tabla Articulos</a>";
			}
			
			//En caso de venir al formulario para Borrar, mostrará el formulario completo con los datos del producto que se va a borrar y el botón de Borrar. 
			//Al pulsar sobre el botón, se eliminará el producto de la base de datos y mostrará un mensaje de que le producto se ha borrado.
			elseif(isset($_GET["Borrar"])){
				if(isset($_GET["Borrar"])){
					$id = $_GET["Borrar"];
					$producto = getProducto($id);
					$fila = mysqli_fetch_assoc($producto);
					$nombre = $fila['Name'];
					$coste = $fila['Cost'];
					$precio = $fila['Price'];
					$categori = $fila['CategoryID'];

				echo '<form action="'. $_SERVER["PHP_SELF"] .'" method="POST">
				ID: <input type="text" name="ID" id="" value=' . $id . '><br>
				Nombre: <input type="text" name="Nombre" id="" value="'.$nombre.'" required><br>
				Coste: <input type="text" name="Coste" id="" value=' . $coste . ' required><br>
				Precio: <input type="text" name="Precio" id="Precio" value=' . $precio . ' required><br>
				<label>Categoría:</label><select name="Categoría" required> ';
				
				echo pintaCategorias($categori);

				echo '</select><br>
				<input type="submit" name="Borrar" value="Borrar"><br>
				</form>';
				echo "<a href='/PHP_DESARROLLO/Vista/articulos.php'>Volver a la tabla Articulos</a>";
				}
			
			}
		}
		
		if(isset($_POST["Agregar"])){
			$Nombre = $_POST["Nombre"];
			$Coste = $_POST["Coste"];
			$Precio = $_POST["Precio"];
			$Categoría = $_POST["Categoría"];
			$resultado = anadirProducto($Nombre, $Coste, $Precio, $Categoría);
			if($resultado){
				echo '<form action="'. $_SERVER["PHP_SELF"] .'" method="POST">
				ID: <input type="text" name="ID" id="" value=""><br>
				Nombre: <input type="text" name="Nombre" id="" value=""><br>
				Coste: <input type="text" name="Coste" id="" value=""><br>
				Precio: <input type="text" name="Precio" id="Precio" value=""><br>
				<label>Categoría:</label><select name="Categoría"> ';
				
				echo pintaCategorias($categori);

				echo '</select><br>
				<input type="submit" name="Agregar" value="Agregar"><br>
				</form>';
				echo "<p>Producto Añadido</p>";
				echo "<a href='/PHP_DESARROLLO/Vista/articulos.php'>Volver a la tabla Articulos</a>";
				
			}
			else{
				echo '<form action="'. $_SERVER["PHP_SELF"] .'" method="POST">
				ID: <input type="text" name="ID" id="" value=""><br>
				Nombre: <input type="text" name="Nombre" id="" value=""><br>
				Coste: <input type="text" name="Coste" id="" value=""><br>
				Precio: <input type="text" name="Precio" id="Precio" value=""><br>
				<label>Categoría:</label><select name="Categoría"> ';
				
				echo pintaCategorias($categori);

				echo '</select><br>
				<input type="submit" name="Agregar" value="Agregar"><br>
				</form>';
				echo "<p>Productos no Añadidos</p>";
				echo "<a href='/PHP_DESARROLLO/Vista/articulos.php'>Volver a la tabla Articulos</a>";
			}

		}
		elseif(isset($_POST["Borrar"])){
			$id = $_POST["ID"];
			$producto = getProducto($id);
			$resultado = borrarProducto($id);
			if($resultado){
				echo '<form action="'. $_SERVER["PHP_SELF"] .'" method="POST">
				ID: <input type="text" name="ID" id="" value=""><br>
				Nombre: <input type="text" name="Nombre" id="" value=""><br>
				Coste: <input type="text" name="Coste" id="" value=""><br>
				Precio: <input type="text" name="Precio" id="Precio" value=""><br>
				<label>Categoría:</label><select name="Categoría"> ';
				
				echo pintaCategorias($categori);

				echo '</select><br>
				<input type="submit" name="Borrar" value="Borrar"><br>
				</form>';
				echo "<p>Productos Borrado</p>";
				echo "<a href='/PHP_DESARROLLO/Vista/articulos.php'>Volver a la tabla Articulos</a>";
			}
			else{
				echo '<form action="'. $_SERVER["PHP_SELF"] .'" method="POST">
				ID: <input type="text" name="ID" id="" value=""><br>
				Nombre: <input type="text" name="Nombre" id="" value=""><br>
				Coste: <input type="text" name="Coste" id="" value=""><br>
				Precio: <input type="text" name="Precio" id="Precio" value=""><br>
				<label>Categoría:</label><select name="Categoría"> ';
				
				echo pintaCategorias($categori);

				echo '</select><br>
				<input type="submit" name="Borrar" value="Borrar"><br>
				</form>';
				echo "<p>Productos no Borrado</p>";
				echo "<a href='/PHP_DESARROLLO/Vista/articulos.php'>Volver a la tabla Articulos</a>";
			}

		}

		elseif(!empty($_POST["Editar"])){
			$id = $_POST["ID"];
			$Nombre = $_POST["Nombre"];
			$Coste = $_POST["Coste"];
			$Precio = $_POST["Precio"];
			$Categoría = $_POST["Categoría"];
			$resultado = editarProducto( $id, $Nombre, $Coste, $Precio, $Categoría);
			if($resultado){
				echo '<form action="'. $_SERVER["PHP_SELF"] .'" method="POST">
				ID: <input type="text" name="ID" id="" value=""><br>
				Nombre: <input type="text" name="Nombre" id="" value=""><br>
				Coste: <input type="text" name="Coste" id="" value=""><br>
				Precio: <input type="text" name="Precio" id="Precio" value=""><br>
				<label>Categoría:</label><select name="Categoría"> ';
				
				echo pintaCategorias($categori);

				echo '</select><br>
				<input type="submit" name="Editar" value="Editar"><br>
				</form>';
				echo "<p>Producto Editado</p>";
				echo "<a href='/PHP_DESARROLLO/Vista/articulos.php'>Volver a la tabla Articulos</a>";
			}
			else{
				echo '<form action="'. $_SERVER["PHP_SELF"] .'" method="POST">
				ID: <input type="text" name="ID" id="" value=""><br>
				Nombre: <input type="text" name="Nombre" id="" value=""><br>
				Coste: <input type="text" name="Coste" id="" value=""><br>
				Precio: <input type="text" name="Precio" id="Precio" value=""><br>
				<label>Categoría:</label><select name="Categoría"> ';
				
				echo pintaCategorias($categori);

				echo '</select><br>
				<input type="submit" name="Editar" value="Editar"><br>
				</form>';
				echo "<p>Productos no Editado</p>";
				echo "<a href='/PHP_DESARROLLO/Vista/articulos.php'>Volver a la tabla Articulos</a>";
			}

		}
	
	?>
	

	
</body>
</html>