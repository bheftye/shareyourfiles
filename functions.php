<?php
	include_once("./controllers/user_controller.php");
	include_once("./model/user.php");

	$operation = $_POST["operation"];

	switch ($operation) {
		case 'ru'://registrar usuario;
			$name = (isset($_POST["name"]))? $_POST["name"] : "Uknown";
			$username = (isset($_POST["username"]))? $_POST["username"] : "Uknown";
			$email = (isset($_POST["email"]))? $_POST["email"] : "Uknown";
			$password = (isset($_POST["password_a"]))? $_POST["password_a"] : "Uknown";

			if($username != "Uknown"){
				$user_controller = new user_controller();
				$user = new user(0, $username, $email, $name, $password);

				$success = $user_controller -> username_taken($user);
				if(!$success){
					$success = $user_controller -> register_user($user);
					if($success){
						header("Location: login.html?success=0");// se registro el usuario con exito;
					}
					else{
						header("Location: registro.html?success=1");//no se registro el usuario;
					}
				}
				else{
					header("Location: registro.html?success=2");// ya existe el nombre de usuario;
				}
				
			}
			else{
				header("Location: registro.html?success=1");
			}
			break;
		case 'is': //inicia sesión
			session_start();
			$username = (isset($_POST["username"]))? $_POST["username"] : "Uknown";
			$password = (isset($_POST["password"]))? $_POST["password"] : "Uknown";

			if($username != "Uknown"){	
				$user_controller = new user_controller();
				$user = new user(0, $username, $username, "", $password);

				$success = $user_controller -> iniciar_sesion($user);

				if($success){
					header("Location: home.php?success=1");//Inicio de sesión con éxito.
				}
				else{
					header("Location: login.html?success=2");//Usuario, email o contraseña incorrectos
				}
			}
			else{
				header("Location: login.html?success=1");//No se pudo iniciar sesión
			}
			break;
		default:
			# code...
			break;
	}
?>