<?php
	include_once("./controllers/user_controller.php");
	include_once("./model/user.php");

	$operation = $_POST["operation"];

	switch ($operation) {
		case 'ru':
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
						header("Location: registro.html?success=0");
					}
					else{
						header("Location: registro.html?success=1");
					}
				}
				
			}
			else{
				header("Location: registro.html?success=1");
			}
			break;
		
		default:
			# code...
			break;
	}
?>