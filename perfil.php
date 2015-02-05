<?php
include_once("controllers/user_controller.php");
include_once("controllers/gral_controller.php");
include_once("./model/user.php");

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
    $friends = array();
    $ctrlGral = new gral_controller();
    $friends = $ctrlGral -> getUsersFriends($idUser);

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
					<br>
					<a class="user" href='#'><span><?php echo $user -> username?></span></a>
					<ul>
					   <li class='active'><a href='#'><span>Inicio</span></a></li>
					   <li><a href='misArchivos.php?u=<?php echo $user -> username;?>'><span>Mis archivos</span></a></li>
					   <li><a href='amigos.php?u=<?php echo $user -> username;?>'><span>Amigos</span></a></li>
					</ul>
				</div>
				<div class="content">	
					<div class="archive">
						 <form  method="post" action="functions.php">
 							<label>Nombre:</label> <input type="text" name="name" value="<?php echo $user -> name;?>"><br>
  							<label>Usuario:</label> <input type="text" name="username" value="<?php echo $user -> username;?>"><br>
  							<label>E-mail:</label> <input type="text" name="email" value="<?php  echo $user -> email;?>"><br>
  							<input type="hidden" name="operation" value="ai">
							<input type="submit" value="Editar info">
						</form> 
					</div>
					<?php 
						if($user -> username == $_SESSION["username_shayourfiles"]){
					?>	
					<div class="friendsBox">
						 <form id="form_update" method="post"  action="functions.php">
						 	<h1>Cambiar contraseña</h1><br>
						 	<label>Contraseña actual:</label> <input type="password" name="actualPass"><br>
  							<label>Nueva contraseña:</label> <input type="password" name="newPass"><br>
  							<label>Confirmar contraseña:</label> <input type="password" name="confPass"><br>

  							<input type="hidden" name="operation" value="ac">

							<input type="submit" value="Guardar">
						</form> 
					</div>
					<?php 
						}
					?>	
					<div class="friendsBox">
						 	<h1>Amigos</h1><br>
						 	<?php foreach ($friends as $friend) {
						 		echo '<p>'.$friend -> username.'</p><br>';
						 	}?>
 							
					</div>		
		</div>
	</div>
</body>
</html>
