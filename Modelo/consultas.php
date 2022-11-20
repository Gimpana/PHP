<?php 

	include "conexion.php";
	

	//Recibe un $nombre de usuario (FullName) y un $correo electrónico de usuario (Email).
	function tipoUsuario($nombre, $correo){
		$conexion = crearConexion();
		//Comprobará si el usuario está registrado, y en caso de estarlo, qué permisos tiene.
		if (esSuperadmin($nombre, $correo)){
			return "Super";
		}else{
			//Consulta para seleccionar los datos del usuario que intenta ingresar y comprobar los permisos de usuario que tiene
			$implement = $conexion -> query("SELECT FullName, Email, Enabled FROM user WHERE FullName = '$nombre' and Email = '$correo' ");
			
			//Comprobando permisos
			if ($comp = mysqli_fetch_array($implement)){
				if ($comp["Enabled"] == 0){
					return "Resgistrado";
				}else if($comp["Enabled"] == 1){
					return "Autorizado";
				}
				else{
					return "No registrado";
				}
			}
		}
		cerrarConexion($conexion);
	}

	//Función para verificar si es un super usuario
	function esSuperadmin($nombre, $correo){
		$conexion = crearConexion();
		//Consulta para verificar que los datos introduce el usuario pertenece a un super usuario. buscamos que la información que recibimos coincida en ambas tablas.
		$implement =$conexion->query("SELECT user.UserID FROM user INNER JOIN setup ON user.UserID = setup.SuperAdmin WHERE user.FullName = '$nombre' and user.Email = '$correo' ");

		//Devuelve un valor booleano dependiendo de la comprobación
		if ($comp = mysqli_fetch_array($implement)){
			return true;
		}
		else{
			return false;
		}
	}

	//Devuelve el valor almacenado en la columna Autenticación de la tabla setup
	function getPermisos() {
		$conexion = crearConexion();
		$implement =$conexion->query("SELECT Autenticación FROM setup");
		$comp = mysqli_fetch_assoc($implement);
		cerrarConexion($conexion);

		return $comp["Autenticación"];
	}

	//Cambia el valor almacenado en la columna Autenticación de la tabla setup. Si vale 0 cambia a 1 y si vale 1 cambia a 0.
	function cambiarPermisos() {
		$conexion = crearConexion();
		$implement = $conexion->query("SELECT Autenticación FROM setup ");
		$comp = mysqli_fetch_array($implement);
		if($comp["Autenticación"] == 1){
			$implement2 = $conexion->query("UPDATE setup SET Autenticación = 0 ");
			return $implement2;
		}
		elseif($comp["Autenticación"] == 0){
			$implement2 = $conexion->query("UPDATE setup SET Autenticación = 1 ");
			return $implement2;
		}
		$conexion = crearConexion();
		
	}

	//Devuelve una tabla virtual con los datos (CategoryID, Name) de todas las categorias
	//almacenadas en category
	function getCategorias() {
		$conexion = crearConexion();
		$implement =$conexion->query(" SELECT CategoryID, Name FROM category ");
		cerrarConexion($conexion);
		return $implement;
	}

	//Devuelve una tabla virtual con los datos (CategoryID, Name, Enabled) de todos los usuarios
	//almacenadas en user
	function getListaUsuarios() {
		$conexion = crearConexion();
		$implement =$conexion->query(" SELECT FullName, Email, Enabled FROM user ");
		cerrarConexion($conexion);
		return $implement;
	}

	//Recibe un $ID que corresponde al identificador de un producto.
	function getProducto($ID) {
		$conexion = crearConexion();
		$implement = $conexion->query(" SELECT * FROM product WHERE ProductID = $ID");
		cerrarConexion($conexion);
		$comp = mysqli_fetch_array($implement);

		//Devuelve una tabla virtual con todos los datos que corresponden al producto cuyo identificador es $ID.
		return $comp;
	}

	//Recibe el $orden por el que deben ordenarse los productos.
	function getProductos($orden) {
		$conexion = crearConexion();
		/*
		Devuelve una tabla  virtual con el contenido de todos los productos de la base de datos, ordenados por el valor de $orden. 
		En esta tabla debe los siguientes valores por cada producto:
		De la tabla product: ProductID, Name, Cost, Price
		De la tabla category: Name.
		*/
		$implement = $conexion->query(" SELECT product.ProductID, product.Name, product.Cost, product.Price, product.CategoryID,
										category.Name as category FROM product INNER JOIN category WHERE 
										product.CategoryID = category.CategoryID ORDER BY $orden");
		cerrarConexion($conexion);
		return $implement;
	}

	//Recibe el $nombre, $coste, $precio e identificador de $categoría de un producto.
	function anadirProducto($nombre, $coste, $precio, $categoria) {
		$conexion = crearConexion();
		//Añade ese producto a la base de datos.
		$implement = $conexion->query("INSERT INTO product (Name, Cost, Price, CategoryID) VALUES ('$nombre', $coste, $precio, $categoria)");
		cerrarConexion($conexion);
		//Devuelve el resultado de la consulta realizada.
		return $implement;
	}

	//Recibe el $id entificador de un producto.
	function borrarProducto($id) {
		$conexion = crearConexion();
		//Elimina ese producto de la base de datos.
		$implement = $conexion->query("DELETE FROM product qhere ProductID = $id");
		cerrarConexion($conexion);

		return $implement;
		
	}

	//Recibe el $id entificación, $nombre, $coste, $precio e identificador de $categoría de un producto.
	function editarProducto($id, $nombre, $coste, $precio, $categoria) {
		$conexion = crearConexion();
		//Actualiza la información de ese producto en la base de datos.
		$implement = $conexion->query("UPDATE product SET Name = '$nombre', Cost = $coste, Price = $precio, CategoryID = $categoria WHERE ProductID = $id ");

		cerrarConexion($conexion);
		//Devuelve el resultado de la consulta realizada.
		return $implement;
	}

?>