<?php
	/**
	* 
	*/
	class file_upload
	{

		var $id_upload;
		var $username;
		var $description;
		var $file_name;
		
		function file_upload($id_upload, $username, $description, $file_name)
		{
			$this -> id_upload = $id_upload;
			$this -> username = $username;
			$this -> description = $description;
			$this -> file_name = $file_name;
		}
	}
?>