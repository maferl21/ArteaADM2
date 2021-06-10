<?php require_once("login.php");
require_once("cabeceralogin.html");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="description" content="Proyecto">
	    <meta name="keywords" content="Artea">
		<title>Iniciar sesion</title>
	</head>
	<body>
    <div align="center">
        <section>
          <figure class="logo">
            <img  class="logo" src="img/logo_inicio.jpg"/>
            <br><br>
          </figure>
          
    		<form  method="post" action="">
    			  <input type="text" name="usuario" placeholder="Usuario">
    				<br/><br>
    			  <input type="password" name="password" placeholder="Contraseña">
    				<br/><br>
                  <div class="alert"><?php echo isset($alert)?$alert:'';?></div>
                  <br><input type="submit" value="Iniciar sesion">
    		</form>
    	</section>
    </div>
     <br>
     <?php include_once("pielogin.html");?>
   </body>
</html>
