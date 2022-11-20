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
			//Almacenará en una cookie el tipo de usuario que ha intentado registrarse.
			setcookie("tipo", $tipo, time()+84600);
			switch($tipo) {
				//En caso de ser superadmin, mostrará su nombre y mostrará un enlace para acceder a usuarios.php
				case "Super":
					echo "Hola $usuario. Pulsa <a href='usuarios.php'>Aquí</a> para entrar al panel de usuarios";
					break;
				//En caso de ser un usuario autorizado, mostrará su nombre y mostrará un enlace para acceder a articulos.php
				case "Autorizado":
					echo "Hola $usuario. Pulsa <a href='articulos.php'>Aquí</a> para entrar al panel de articulos.";
					break;
				//En caso de ser un usuario registrado, pero no autorizado, mostrará su nombre e indicará que no tiene permisos para acceder.
				case "Resgistrado": 
					echo "Hola $usuario. Estas registrado pero no tienes los permisos para ingresar.";
					break;
				//En caso de que sea un usuario no registrado o se introduzcan unos datos incorrectos, indicará que el usuario no está registrado.
				default:
					echo "No tenemos registro del usuario ingresado";
			}
		}
	?>


	
	
</body>
</html>