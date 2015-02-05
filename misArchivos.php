<?php
	include_once("./controllers/user_controller.php");
	include_once("./model/user.php");

	$username = (isset($_GET["u"]))? $_GET["u"]: "Unknown";
	if($username != "Unknown"){
		$username = addslashes($username);
		$user_controller = new user_controller();
		$user = $user_controller -> get_user_by_username($username);
		if(is_null($user)){
			header("Location: error_user.html");
		}
	}
	else{
		header("Location: error_user.html");
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Plantilla</title>
	<link href="css/style.css" rel='stylesheet' type='text/css' />
</head>
<body>
	<div class="wrapper">
			<div class="container">
				<div class="menu">
					<img class="user" src="images/user.png" alt="">
					<a class="user" href='#'><span>fulanitopp</span></a>
				<ul>
				   <li ><a href='#'><span>Inicio</span></a></li>
				   <li class='active'><a href='#'><span>Mis archivos</span></a></li>
				</ul>
				</div>
				<div class="content">	
					<div class="archive">
						<form action="functions.php" method="post" enctype="multipart/form-data">
							<label>Comentario (120 caract)</label><br>
      						<textarea name="description" rows="2" cols="63"></textarea><br><br>
							<label class="fileContainer">
							    Subir archivo
							    <input name="file" type="file"/>
							</label>
							<input type="hidden" value="sa" name="operation">
      						<input type="submit" value="Guardar">						
      					</form>
					</div>
					<?php 
						/*foreach ($archivos as $archivo) {
							echo '<div class="archive">
									<p class="label">Nombre de usuario</p>
									<p class="label">Archivo</p>
									<p class="label">Comentario</p>
									<p class="comment">bla bla bla</p>
									<form action="#">
										<button class= "download">Descargar</button>
									</form>
								</div>';
						}*/
					?>
										
				</div>
		</div>
	</div>
</body>
</html>
