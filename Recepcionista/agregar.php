<?php
header("location: Generar_Factura.php");
include_once("modelo/conexion.php");

$id=$_REQUEST['id'];

date_default_timezone_set("America/Mexico_City");
$fechaActual=date("Y")."-".date("m")."-".date("d");
     
$nom=$_POST["Nombre"];
$rcf=$_POST["RCF"];
$ema=$_POST["Email"];


    $sql="SELECT id_factura FROM factura WHERE id_ticket='".$id."'";
    $rs2=mysqli_query($conection,$sql) or die(mysqli_error($conection));
    $row2=mysqli_fetch_assoc($rs2);
    
    if($row2==""){

         $sqlNueva="INSERT INTO factura (id_ticket,nombre,RFC,correo,fecha_factura) VALUES ('$id','".$nom."','".$rcf."','".$ema."','$fechaActual')";
         $Result=$conection->query($sqlNueva);
    }
?>