<?php
include_once("controllers/user_controller.php");
include_once("controllers/gral_controller.php");
include_once("./model/user.php");
include_once("./model/file_upload.php");

$username = "";
$idUser = "";
$name="";
session_start();
if(isset($_SESSION["id_user_shareyourfiles"])){
$username = $_SESSION["username_shayourfiles"];
$name = $_SESSION["name_shareyourfiles"];
$idUser = $_SESSION["id_user_shareyourfiles"];
$email = $_SESSION["email_shareyourfiles"];
 }
 else{
 	header("Location: login.html");
 }
    $friends = array();
    $ctrlGral = new gral_controller();
    $friends = $ctrlGral -> getUsersFriends($idUser);

	$username = (isset($_GET["u"]))? $_GET["u"]: "Unknown";
	if($username != "Unknown"){
		$username = addslashes($username);
		$user_controller = new user_controller();
		$user = $user_controller -> get_user_by_username($username);

		if(is_null($user)){
			header("Location: login.html");
		}
	}
	else{
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
					<img class="user" src="images/user.png" alt="">
					<br>
					<a class="user" href='perfil.php?u=<?php echo $user -> username?>'><span><?php echo $user -> username?></span></a>
					<ul>
					   <li class='active'><a href='#'><span>Inicio</span></a></li>
					   <li><a href='misArchivos.php?u=<?php echo $user -> username;?>'><span>Mis archivos</span></a></li>
					   <li><a href='amigos.php?u=<?php echo $user -> username;?>'><span>Amigos</span></a></li>
					</ul>
				</div>
				<div class="content">	

					<?php 
						if($user -> username == $_SESSION["username_shayourfiles"]){
					?>	
					<?php 
						}
					?>		
					<div class="friendsBox">
						 	<h1>Publicaciones Amigos</h1><br>
						 	<?php 
						 	$all_uploads = array();
						 	foreach ($friends as $friend) {
						 		$user_uploads = $user_controller -> list_user_uploads($friend -> username);
						 		foreach ($user_uploads as $upload) {
						 			array_push($all_uploads, $upload);
						 		}
						 	}
						 	shuffle($all_uploads);
					 		foreach ($all_uploads as $user_upload) {
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
