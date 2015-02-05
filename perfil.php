<?php
  include_once("controllers/user_controller.php");
  include_once("controllers/gral_controller.php");
  include_once("./model/user.php");

  $username = "";
  $idUser = "";
  session_start();
  if(isset($_SESSION["id_user_shareyourfiles"])){
    $username = $_SESSION["username_shayourfiles"];
    $idUser = $_SESSION["id_user_shareyourfiles"];
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
				</ul>
				</div>
				<div class="content">	
					<div class="friendsBox">
						 <form action="#">
						 	<h1>Datos personales</h1><br>
 							<label>Nombre:</label> <input type="text" name="name" value="<?php echo $user -> name?>" disabled><br>
  							<label>Usuario:</label> <input type="text" name="username" value="<?php echo $user -> username?>" disabled><br>
  							<label>E-mail:</label> <input type="text" value="<?php echo $user -> email?>" name="email" disabled><br>
							<!--<input type="submit" value="Guardar">-->
						</form> 
					</div>	
					<div class="friendsBox">
						 <form action="#">
						 	<h1>Cambiar contraseña</h1><br>
						 	<label>Contraseña actual:</label> <input type="password" name="actualPass"><br>
  							<label>Nueva contraseña:</label> <input type="text" name="newPass"><br>
  							<label>Confirmar contraseña:</label> <input type="text" name="confPass"><br>
							<input type="submit" value="Guardar">
						</form> 
					</div>
					<!--<div class="friendsBox">
						<h1>Buscar amigos</h1><br>
						<form action="#" method="post" action="functions.php">
						 	<input type="text" name="friendName">
							<input type="submit" name="searchFriends" value="Buscar">
						</form>
							<p> <?php //echo $_POST["friendName"]; ?></p> 


					</div>	-->				
		</div>
	</div>
</body>
</html>
