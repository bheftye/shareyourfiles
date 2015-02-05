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
  else{
  	header("Location: login.html");
  }

  $found_users = array();

  if(isset($_GET["search_string"])){
  	$search_string = $_GET["search_string"];
  	$user_controller = new user_controller();
  	$found_users = $user_controller -> list_users_found($search_string);
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
				  <li ><a href='inicio.php?u=<?php echo $user -> username?>'><span>Inicio</span></a></li>
				   <li><a href='misArchivos.php?u=<?php echo $user -> username;?>'><span>Mis archivos</span></a></li>
				   <li class='active'><a href='amigos.php?u=<?php echo $user -> username;?>'><span>Amigos</span></a></li>

				</ul>
				</div>
				<div class="content">	
					<div class="friendsBox">
						 	<h1>Amigos</h1><br>
						 	<?php foreach ($friends as $friend) {
						 		echo '<p>'.$friend -> username.'</p><br>';
						 	}?>
 							
					</div>
					<div class="friendsBox">
						<h1>Buscar usuarios</h1><br>
						<form method="get" action="amigos.php">
						 	<input type="text" name="search_string">
						 	<input type="hidden" name="u" value="<?php echo $user -> username?>">
							<input type="submit" value="Buscar">
						</form>
						<?php foreach ($found_users as $found_user) {
								$is_friend = false;
								foreach ($friends as $friend) {
									if($friend -> username == $found_user -> username || $found_user -> username == $_SESSION["username_shayourfiles"]){
										$is_friend = true;
										break;
									}
								}
								if($is_friend){
									echo '<p>'.$found_user -> username.'</p><br>';
								}
								else{
									echo '<form method="post" action="functions.php">
											<input type="hidden" name="new_friend" value="'.$found_user -> username.'">
											<input type="hidden" name="user" value="'.$_SESSION["username_shayourfiles"].'">
											<input type="hidden" name="operation" value="af">
											<p>'.$found_user -> username.'<input type="submit" value="Agregar"></p><br>';

								}
						 }?>
					</div>		
				</div>
	</div>
</body>
</html>
