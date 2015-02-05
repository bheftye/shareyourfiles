<?php
include_once("controllers/user_controller.php");
$username = "";
$name="";
session_start();
if(isset($_SESSION["id_user_shareyourfiles"])){
$username = $_SESSION["username_shayourfiles"];
$name = $_SESSION["name_shareyourfiles"];
$email= $_SESSION["email_shareyourfiles"];

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
					<?php if(isset($_SESSION["username_shayourfiles"])) echo '<a class="user" href="perfil.php"><span>'.$username.'</span></a>'; else header("Location: login.html?success=0")?></a>

				<ul>
				   <li class='active'><a href='#'><span>Inicio</span></a></li>
				   <li><a href='#'><span>Mis archivos</span></a></li>
				   <li><a href='functions.php?operation2=cs'><span>Cerrar sesión</span></a></li>

				</ul>
				</div>
				<div class="content">	
					<div class="archive">
						<!--id="form_update" onsubmit="return validateForm()"-->
						 <form   method="post"  action="functions.php">
 							<label>Nombre:</label> <input type="text" name="name" value="<?php  echo (isset($name))? $name:'';?>"><br>
  							<label>&nbspUsuario:</label> <input type="text" name="username" value="<?php  echo (isset($username))? $username:'';?>"><br>
  							<label>&nbsp&nbsp&nbsp&nbspE-mail:</label> <input type="text" name="email" value="<?php  echo (isset($email))? $email:'';?>"><br>
  							
  							<input type="hidden" name="operation" value="ai">

							<input type="submit" value="Editar info">
						</form> 
						<!--<form action="#">
							<input type="submit" value="Cambiar contraseña">
						</form>
						</form>-->

					</div>
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
