<?php
	include_once("./controllers/user_controller.php");
	include_once("./model/user.php");
	include_once("./model/file_upload.php");

	$username = (isset($_GET["u"]))? $_GET["u"]: "Unknown";
	if($username != "Unknown"){
		$username = addslashes($username);
		$user_controller = new user_controller();
		$user = $user_controller -> get_user_by_username($username);
		$user_uploads = $user_controller -> list_user_uploads($username);
		if(is_null($user)){
			header("Location: login.html");
		}
	}
	else{
		header("Location: login.html");
	}
	if(!isset($_SESSION["id_user_shareyourfiles"])){
		header("Location: login.html");
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
					<img class="user" src="images/user.png" alt=""><br>
					<a class="user" href='perfil.php?u=<?php echo $user -> username?>'><span><?php echo $user -> username?></span></a>
				<ul>
				   <li ><a href='inicio.php?u=<?php echo $user -> username?>'><span>Inicio</span></a></li>
				   <li class='active'><a href='#'><span>Mis archivos</span></a></li>
				    <li><a href='amigos.php?u=<?php echo $user -> username;?>'><span>Amigos</span></a></li>

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
						foreach ($user_uploads as $user_upload) {
							echo '<div class="archive">
									<p class="label">'.$user_upload -> username.'</p>
									<p class="label">'.$user_upload -> file_name.'</p>
									<p class="label">Comentario</p>
									<p class="comment">'.$user_upload -> description.'</p>
									<a href="download.php?f='.$user_upload -> file_name.'"><button class= "download">Descargar</button></a>
								</div>';
						}
					?>
										
				</div>
		</div>
	</div>
</body>
</html>
