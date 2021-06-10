<?php session_start();
include_once("modelo/conexion.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Historial de ventas</title>
</head>
<body>

<?php include_once("cabecera_Inicio.html");
include_once("menu.html");
?>
    
<section class="inicio">
<?php include_once("../HV2.php"); ?>
</section><br><br><br><br>
</body>
</html>
<?php
include_once("pie.html");
?>

