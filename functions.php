<?php
	include_once("./controllers/user_controller.php");
	include_once("./model/user.php");
	include_once("./model/file_upload.php");


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
						header("Location: perfil.php?success=0");// se registro el usuario con exito;
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
					header("Location: perfil.php?success=1");//Inicio de sesión con éxito.
					header("Location: perfil.php?u=".$user -> username);//Inicio de sesión con éxito.
				}
				else{
					header("Location: login.html?success=2");//Usuario, email o contraseña incorrectos
				}
			}
			else{
				header("Location: login.html?success=1");//No se pudo iniciar sesión
			}
			break;
		case 'sa'://registrar usuario;
			$file_name = (isset($_FILES["file"]["name"]))? $_FILES["file"]["name"] : "Uknown";
			$description = (isset($_POST["description"]))? $_POST["description"] : "Uknown";
			session_start();
			$username = $_SESSION["username_shayourfiles"];


			$ext = pathinfo($file_name, PATHINFO_EXTENSION);
			$file_new_name = uniqid().".".$ext;
			$file_name_tmp = $_FILES["file"]["tmp_name"];

			$user_controller = new user_controller();
			$file_upload = new file_upload(0, $username, $description, $file_new_name);

			

			if($file_name_tmp != ""){
				$success = $user_controller -> upload_user_file($file_new_name, $file_name_tmp);
				if($success){
					$success = $user_controller -> save_upload($file_upload);
					if($success){
						header("Location: perfil.php?u=".$username);//Inicio de sesión con éxito.
					}
					else{
						header("Location: misArchivos.php?success=2");
					}	
				}
				else{
					header("Location: misArchivos.php?success=1");
				}
			}
			else{
				header("Location: misArchivos.php?success=1");
			}

			
			break;
		default:
			# code...
			break;
	}
?>