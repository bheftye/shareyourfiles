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
					<a class="user" href='#'><span><?php echo $user -> username?></span></a>
				<ul>
				   <li class='active'><a href='#'><span>Inicio</span></a></li>
				   <li><a href='misArchivos.php?u=<?php echo $user -> username;?>'><span>Mis archivos</span></a></li>
				</ul>
				</div>
				<div class="content">	
					<!--<div class="archive">
						 <!--<form action="#">
 							<label>Nombre:</label> <input type="text" name="name" value="<?php echo $user -> name?>" disabled><br>
  							<label>&nbspUsuario:</label> <input type="text" name="username" value="<?php echo $user -> username?>" disabled><br>
  							<label>&nbsp&nbsp&nbsp&nbspE-mail:</label> <input type="text" name="email" value="<?php echo $user -> email?>" disabled><br>
							<input type="submit" value="Editar info">
						</form>
						<form action="#"><!--
							<input type="submit" value="Cambiar contraseña">
						</form>

					</div>-->
					<div class="friendsBox">
						<h1>Amigos</h1>
						<p> Nombre completo del amigo</p>
						<p> Nombre completo del amigo</p>
						<p> Nombre completo del amigo</p>
						<p> Nombre completo del amigo</p>

					</div>			
				</div>
		</div>
	</div>
</body>
</html>
