<?php
	include_once("./controllers/user_controller.php");
	include_once("./model/user.php");


	if(isset($_REQUEST["operation2"])){
		$operation2 = $_REQUEST["operation2"];
	switch($operation2){
		case 'cs'://cerrar sesión
			session_start();
			$_SESSION['id_user_shareyourfiles']= 0;
			$_SESSION["username_shayourfiles"] = "";
			$_SESSION["name_shareyourfiles"] = "";
			$_SESSION["email_shareyourfiles"] = "";
			session_destroy();
			header("Location:login.html");
		break;
		default:
		//code.....
		break;
	}
	}
		


	if(isset($_POST["operation"])){
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
					header("Location: perfil.php?success=1");//Inicio de sesión con éxito.
				}
				else{
					header("Location: login.html?success=2");//Usuario, email o contraseña incorrectos
				}
			}
			else{
				header("Location: login.html?success=1");//No se pudo iniciar sesión
			}
			break;
		
		
		case 'ai': //actualizar información
			session_start();
			$idUser= $_SESSION["id_user_shareyourfiles"];
			$name= (isset($_POST["name"]))? $_POST["name"] : "Uknown";
			$username= (isset($_POST["username"]))? $_POST["username"] : "Uknown";
			$email= (isset($_POST["email"]))? $_POST["email"] : "Uknown";
			$password= "";

			if (($name != "Uknown") && ($username != "Uknown") && ($email != "Uknown") && ($password != "Uknown")){
				$user_controller = new user_controller();
				$user = new user($idUser, $username, $email, $name, $password);

				$sucess = $user_controller -> update_user_info($user);
				if($sucess){
					header("Location: perfil.php?");
				}else{
					//header("Location: perfil.php?success=2");
					echo 'No se pudo actualizar la información';
				}
			}
			else{
				echo 'Campos vacíos';
			}

		break;
		
		case 'ac': //actualizar contraseña
			session_start();
			$idUser= $_SESSION["id_user_shareyourfiles"];
			$name= $_SESSION["name_shareyourfiles"];
			$username= $_SESSION["username_shayourfiles"];
			$email= $_SESSION["email_shareyourfiles"];
			$user_controller = new user_controller();
			$password= $user_controller -> get_password($idUser);

			$currentPass= (isset($_POST["actualPass"]))? $_POST["actualPass"] : "Uknown";
			$newPass= (isset($_POST["newPass"]))? $_POST["newPass"] : "Uknown";
			$confPass= (isset($_POST["confPass"]))? $_POST["confPass"] : "Uknown";
			
			if(md5($currentPass) == $password){
				if(($newPass != "Uknown") && ($confPass != "Uknown") &&($newPass == $confPass)){
					$user_controller = new user_controller();
					$user = new user($idUser, $username, $name, $email, $newPass);

					$success = $user_controller -> update_password($user);
					if($success){
					header("Location: perfil.php?");
				}else{
					//header("Location: perfil.php?success=2");
					echo 'No se pudo actualizar la información';
				}

				}else{
					echo 'Las contraseñas no son iguales';
				}
			}else{
				echo 'Su contraseña es incorrecta';
			}	
				

		break;
				



		default:
			# code...
			break;	

	}	
	}
	
?>