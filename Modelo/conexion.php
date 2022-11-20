<?php 

	function crearConexion() {
		// Cambiar en el caso en que se monte la base de datos en otro lugar
		$host = "localhost";
		$user = "root";
		$pass = "";
		$baseDatos = "pac3_daw";

		return $conexion = new mysqli($host, $user, $pass, $baseDatos);
	}


	function cerrarConexion($conexion) {
		return $conexion = mysqli_close($conexion);
	}

?>