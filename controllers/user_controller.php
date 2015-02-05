<?php
	/**
	* 
	*/
	include_once("./model/user.php");
	include_once("./database/connection.php");

	class user_controller 
	{
		
		function user_controller()
		{
			
		}

		function register_user($user){
			$db_connection = new connection();
			$query = "INSERT INTO users (username, email, name, password) VALUES ('".$user -> username."','".$user -> email."','".$user -> name."','".md5($user -> password)."')";
			$id_user = $db_connection -> insert_query($query);
			if($id_user > 0){
				return true;
			}	
			return false;
		}

		function username_taken($user){
			$db_connection = new connection();
			$query = "SELECT * FROM users WHERE username = '".$user -> username."'";
			$result = $db_connection -> execute_query($query);
			if(mysqli_num_rows($result) > 0){
				return true;
			}	
			return false;
		}

		function get_user_by_username($username){
			$db_connection = new connection();
			$query = "SELECT * FROM users WHERE (username = '".$username."' OR email = '".$username."')";
			$result = $db_connection -> execute_query($query);
			if(mysqli_num_rows($result) > 0){
				if(!isset($_SESSION)) 
			    { 
			        session_start(); 
			    } 
				while($row = mysqli_fetch_array($result)){
					$user = new user($row["id_user"],$row["username"], $row["email"], $row["name"], "");
				}
				return $user;
			}	
			return NULL;
		}

		function upload_user_file($file_name, $tmp_file_name){
			if(is_file($tmp_file_name) == 1){
				 return move_uploaded_file($tmp_file_name, "./user_files/".$file_name);
			}
			return false;
		}

		function save_upload($file_upload){
			$db_connection = new connection();
			$query = "INSERT INTO file_uploads (username, description, file_name) VALUES ('".$file_upload -> username."', '".$file_upload -> description."', '".$file_upload -> file_name."')";
			$id_upload = $db_connection -> insert_query($query);
			if($id_upload > 0){
				return true;
			}	
			return false;
		}

		function iniciar_sesion($user){
			$db_connection = new connection();
			$query = "SELECT * FROM users WHERE (username = '".$user -> username."' OR email = '".$user -> email."')  AND password  = '".md5($user -> password)."'";
			$result = $db_connection -> execute_query($query);
			if(mysqli_num_rows($result) > 0){
				if(!isset($_SESSION)) 
			    { 
			        session_start(); 
			    } 
				while($row = mysqli_fetch_array($result)){
					$_SESSION["id_user_shareyourfiles"] = $row["id_user"];
					$_SESSION["username_shayourfiles"] = $row["username"];
					$_SESSION["name_shareyourfiles"] = $row["name"];
					$_SESSION["email_shareyourfiles"] = $row["email"];
				}
				return true;
			}	
			return false;
		}
	

	}
?>