<?php 

	include "../Modelo/consultas.php";

	function pintaCategorias($defecto) {
		// Completar...	
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
			$listaArray = getProductos($orden);
			//echo $listaArray;
			echo "<table border = 1>
					<tr>
						<th><a href='articulos.php?orden=ProductID'>ID</a></th>
						<th><a href='articulos.php?orden=Name'>Nombre</a></th>
						<th><a href='articulos.php?orden=Cost'>Coste</a></th>
						<th><a href='articulos.php?orden=Price'>Precio</a></th>
						<th><a href='articulos.php?orden=CategoryID'>Categoría</a></th>
						<th>Acción</th>
					</tr>";
			//echo $listaArray;

			
			if (mysqli_num_rows($listaArray) > 0){
				while($fila = mysqli_fetch_assoc($listaArray)){
					echo "<tr>";
					echo "<td>". $fila['ProductID'] . "</td>";
					echo "<td>". $fila['Name'] . "</td>";
					echo "<td>". $fila['Cost'] . "</td>";
					echo "<td>". $fila['Price'] . "</td>";
					echo "<td>". $fila['CategoryID'] . "</td>";
					//echo "<td>". $fila['Acción'] . "</td>";
					echo "</tr>";
					}
				}
				echo "</table>";
			}
				
	}

?>

