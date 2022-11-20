<?php 

	include "../Modelo/consultas.php";

	function pintaCategorias($defecto) {
		$categori = getCategorias();
		while($fila = mysqli_fetch_assoc($categori)){
			if($fila["CategoryID"] == $defecto){
				echo "<option value=". $fila["CategoryID"] ." selected>". $fila["Name"] ."</option>";
			}
			else{
				echo "<option value=". $fila["CategoryID"] .">". $fila["Name"] ."</option>";
			}
		}
	}
	

	function pintaTablaUsuarios(){
		if (getListaUsuarios()){
			$listaArray = getListaUsuarios();
			echo "<table border = 1>
					<tr>
						<th>FullName</th>
						<th>Email</th>
						<th>Enabled</th>
					</tr>";

			if (mysqli_num_rows($listaArray) > 0){
				while($fila = mysqli_fetch_assoc($listaArray)){
					echo "<tr>";
					echo "<td>". $fila['FullName'] . "</td>";
					echo "<td>". $fila['Email'] . "</td>";
					if ($fila['Enabled'] == 1){
						echo "<td class = 'rojo'>". $fila['Enabled'] . "</td>";
					}
					else{
						echo "<td>". $fila['Enabled'] . "</td>";
					}
					
					echo "</tr>";
					}
				}
			}
				echo "</table>";
		}	


		
	function pintaProductos($orden) {
		if ($orden){
			//Al pulsar sobre el título de cada columna (excepto Acciones), permitirá ordenar de menor a mayor el contenido de la tabla basándose en el parámetro que se ha pulsado.
			$listaArray = getProductos($orden);
			echo "<table border = 1>
					<tr>
						<th><a href='articulos.php?orden=ProductID'>ID</a></th>
						<th><a href='articulos.php?orden=Name'>Nombre</a></th>
						<th><a href='articulos.php?orden=Cost'>Coste</a></th>
						<th><a href='articulos.php?orden=Price'>Precio</a></th>
						<th><a href='articulos.php?orden=CategoryID'>Categoría</a></th>
						<th>Acción</th>
					</tr>";

			
			if (mysqli_num_rows($listaArray) > 0){
				$comp = getPermisos();
				while($fila = mysqli_fetch_assoc($listaArray)){
					$producto = $fila['ProductID'];
					$nombre = $fila['Name'];
					$coste = $fila['Cost'];
					$precio = $fila['Price'];
					$id = $fila['CategoryID'];
					echo "<tr>";
					echo "<td>". $producto . "</td>";
					echo "<td>". $nombre . "</td>";
					echo "<td>". $coste . "</td>";
					echo "<td>". $precio . "</td>";
					echo "<td>". $id . "</td>";
					echo "<td>";
					//Un enlace junto a cada producto que permite editarlo y lleva a formArticulo.php
					//Un enlace junto a cada producto que permite borrarlo y lleva a formArticulo.php.
					//En el caso de que estén los permisos de la aplicación activados, aparecerán también las siguientes opciones
					if ($comp != 0){
						echo " <a href='formArticulos.php?Editar=" .$fila['ProductID']."'>Editar</a> - <a href='formArticulos.php?Borrar=" . $fila['ProductID'] . "'>Borrar</a> ";
					}
					echo "</td>";
					echo "</tr>";
					}
				}
				echo "</table>";
				
			}
				
	}

?>

