<?php
	if(isset($_GET["f"])){
		$file_name = $_GET["f"];
		if(is_file("./user_files/".$file_name)){
			$ext = pathinfo("./user_files/".$file_name, PATHINFO_EXTENSION);
			header("Content-disposition: attachment; filename=".$file_name);
			header("Content-type: application/".$ext);
			readfile("./user_files/".$file_name);
		}
		else{
			echo "Archivo no encontrado";

		}
		
	}
	
?>