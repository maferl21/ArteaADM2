<?php 
  session_start();
  include_once("modelo/conexion.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RECIBO</title>
<link rel="stylesheet" href="css/styleResumen.css">
</head>
<body>
<center>

  <?php
  $id_orden=$_GET['busqueda'];
  $strsql1 = "SELECT * FROM orden WHERE id_orden='".$id_orden."'";
    $rs1= mysqli_query($conection,$strsql1) or die(mysql_error());
    $row1 =mysqli_fetch_assoc($rs1);
    $total_rows1 = mysqli_num_rows($rs1);?>

  <div class="resumen">
      <div class="div-tar">
        <h2>RECIBO</h2>
      </div>
      <br>
      <p><b>Orden: </b><?php echo $id_orden ?></p>
      <?php  if($total_rows1>0){?>
      <p><b>No. Mesa: <?php echo ($row1["num_mesa"]);
                                  $to=($row1["total_orden"]);}?></b></p>
      <div class="contenedorC2">

    <table>
      <tr align="center">
      <td><strong>Platillo/Bebida</strong></td>
      <td><strong>Precio</strong></td>
      <td><strong>Cantidad</strong></td>
      <td><strong>Total</strong></td>
      </tr>

<?php
$fechaActual='';
$strsql = "SELECT * FROM condetalle WHERE id_orden='".$id_orden."'";

$rs= mysqli_query($conection,$strsql) or die(mysql_error());
$row =mysqli_fetch_assoc($rs);
$total_rows = mysqli_num_rows($rs);

if($total_rows > 0) {
    do{ ?>
<tr align="center">
  <td> <?php print($row["nombre_producto"]); ?> </td>
  <td> <?php printf($row["precio_producto"]); ?> </td>
  <td> <?php print($row["cantidad"]); ?> </td>
  <td> <?php printf($row["total"]); ?> </td>
</tr>
<?php	}while ($row = mysqli_fetch_assoc($rs) );
   mysqli_free_result($rs);
} ?>
</table>
<br><p class="tot"><b>Total a pagar: $</b><?php echo $to?></p><br>

<?php
date_default_timezone_set("America/Mexico_City");
$fechaActual=date("Y")."-".date("m")."-".date("d");

          $sqlNueva="INSERT INTO ticket (fecha_ticket,id_orden) VALUES ('$fechaActual','$id_orden')";
          $Result=$conection->query($sqlNueva);
 ?>


 <form action="Generar_Ticket.php" method="get" class="form_search">
            <tr>
               <button type="submit" class="btn_regre">Regresar</button>
            </tr>
      </form>
 </body>
 </html>
