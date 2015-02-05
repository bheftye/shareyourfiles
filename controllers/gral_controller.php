<?php

	include_once("./model/user.php");
	include_once("./database/connection.php");

		class gral_controller 
	{
		function gral_controller(){

		}

		public function searchFriend($name){
			$db_connection = new connection();
			$query = "SELECT * FROM users WHERE name = ". $name;
			$user;
			$results = $db_connection -> execute_query($query);
			while ($row = mysqli_fetch_array($results)) {
				$user = $this-> createUser($row);
			}
			
			return $user;	
		}
		
		private function createUser($row){
				$db_id = $row["id_user"];
				$usuario = $row["username"];
				$email = $row["email"];
				$nombre = $row["name"];
				$contrasena = "";
				return $usuario = new user($db_id, $usuario, $email, $name, $contrasena);
		}		//$id_user, $username, $email, $name, $password


		private function fillFriend($row){
			$db_id = $row["id_user"];
			$usuario = $row["username"];
			$email = "";
			$nombre = $row["name"];
			$contrasena = "";
			return $usuario = new user($db_id, $usuario, $email, $name, $contrasena);
		}		//$id_user, $username, $email, $name, $password

		public function getUsersFriends($idUser){
			$db_connection = new connection();
			$query = "SELECT users.id_user, username, name from (select id_user from friends where id_friend = ".$idUser." union select id_friend from friends where id_user= ".$idUser.") AS friendsTb join users on friendsTb.id_user = users.id_user";
			$results = $db_connection -> execute_query($query);
			$friends = array();
			while($row = mysqli_fetch_array($results)){
				$friend = $this -> fillFriend($row);
				array_push($friends, $friend);
			}
			return $friends;
		}

		function addFriend(){

		}


	}

?>