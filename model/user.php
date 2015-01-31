<?php
	/**
	* 
	*/
	class user
	{

		var $id_user;
		var $username;
		var $email;
		var $name;
		var $password;
		
		function user($id_user, $username, $email, $name, $password)
		{
			$this -> id_user = $id_user;
			$this -> username = $username;
			$this -> email = $email;
			$this -> name = $name;
			$this -> password = $password;
		}
	}
?>