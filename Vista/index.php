<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
</head>
<body>

	<?php
	
		include "../Modelo/consultas.php"

	?>

	<form action="index.php" method="post">
		Usuario: <input type="text" name="usuario" id="">
		<br>
		Correo: <input type="text" name="correo" id="">
		<br>
		<button type="submit" name="ingresar">Iniciar sesión</button>
	</form>

	<?php
		if(isset($_POST["ingresar"])){
			$usuario = $_POST["usuario"];
			$correo = $_POST["correo"];
			$tipo = tipoUsuario($usuario, $correo);
			setcookie("tipo", $tipo, time()+84600);
			switch($tipo) {
				case "Super":
					echo "Hola $usuario. Pulsa <a href='usuarios.php'>Aquí</a> para entrar al panel de usuarios";
					break;
				case "Autorizado":
					echo "Hola $usuario. Pulsa <a href='articulos.php'>Aquí</a> para entrar al panel de articulos.";
					break;
				case "Resgistrado": 
					echo "Hola $usuario. No tienes los permisos para ingresar.";
					break;
				default:
					echo "No tenemos registro del usuario ingresado";
			}
		}
	?>


	
	
</body>
</html>