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
				   <li><a href='amigos.php?u=<?php echo $user -> username;?>'><span>Amigos</span></a></li>

				</ul>
				</div>
				<div class="content">	
					<div class="friendsBox">
						<h1>Buscar amigos</h1><br>
						<form action="#" method="post" action="functions.php">
						 	<input type="text" name="friendName">
							<input type="submit" name="searchFriends" value="Buscar">
						</form>
							<p> <?php //echo $_POST["friendName"]; ?></p> 
					</div>	
					<div class="friendsBox">
						<h1>Amigos</h1>
						    <?php// foreach ($friends as $friend) {
        						//echo  "<p> ".$friend->getUsername()."</p>";
      						//}?>
						<p> Nombre completo del amigo <input type="button" value="Agregar" /></p>
						<p> Nombre completo del amigo <input type="button" value="Agregar" /></p>

					</div>			
				</div>
	</div>
</body>
</html>
