<?php 
	/**
	* 
	*/
	class connection
	{

		var $database_host = "localhost";
		var $database_name = "shareyourfiles";
		var $database_user = "root";
		var $database_user_password = "root";
		
		function connection()
		{
			
		}

		function execute_query($string_query){
			$link = mysqli_connect($this -> database_host, $this -> database_user, $this -> database_user_password, $this -> database_name) or die("Error " . mysqli_error($link)); 
			$result = mysqli_query($link, $string_query);
			return $result; // retorna la consulta
		}

		function insert_query($string_query){
			$link = mysqli_connect($this -> database_host, $this -> database_user, $this -> database_user_password, $this -> database_name) or die("Error " . mysqli_error($link)); 
			$result = mysqli_query($link, $string_query);
			if($result){
				return mysqli_insert_id($link); // retorna el id de la inserción que se haya realizado.
			}
			return 0;
		}

	}
?>