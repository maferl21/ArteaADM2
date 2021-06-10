<?php
require_once("modelo/conexion.php");

$in_date='';
$end_date='';
$wheree="";

if (isset($_REQUEST['in_date']) || isset($_REQUEST['end_date']) ) {

  if ($_REQUEST['in_date'] == '' || $_REQUEST['end_date'] == '' ) {
    header("location: Historial_Ventas.php");
  }
}

if (!empty($_REQUEST['in_date']) && !empty($_REQUEST['in_date'])) {
  $in_date= $_REQUEST['in_date'];
  $end_date= $_REQUEST['end_date'];
?>

<section class="inicio">


<?php
  if($in_date> $end_date){
    header("Historial_Ventas.php");?>

    <h3 align="center"><?php echo   $mesaje="La fecha que ingreso De es mayor a la fecha de A";?></h3><br><br>

<?php
  }else if($in_date == $end_date){
    $wheree="fecha LIKE '$in_date'";
    $buscar="in_date=$in_date&end_date=$end_date";
  }else {
    $in_d=$in_date;
    $end_d=$end_date;
    $wheree="fecha BETWEEN '$in_d' AND '$end_d'";
    $buscar="in_date=$in_date&end_date=$end_date";
  }
}
?>

<center><h1> Historial de ventas </h1></center><br><br>
<center>
    <form action="Historial_Ventas.php" method="get">
    <label>De:</label>
    <input type="date" name="in_date" id="in_date" value="<?php echo $in_date ?>" required>
    <label>A</label>
    <input type="date" name="end_date" id="end_date" value="<?php echo $end_date ?>"required>
    <input type="submit" value="Buscar"/></td><br><br>
    
    </form>
    <br> 
</center>

<!--<center>-->
<!--<table border="1" style="width: 80%" class="tablaHistorial">-->
<table border="1" class="tablaHistorial">
  <tr>
    <th><strong>Numero Mesa</strong></td>
    <th><strong>Numero Pedido</strong></td>
    <th><strong>Costo del pedido</strong></td>
    <th><strong>Forma de pago</strong></td>
    <th><strong>Fecha</strong></td>
  </tr>

<?php
$strsql = "SELECT * from historial WHERE $wheree";

  $rs= mysqli_query($conection,$strsql) or die(mysql_error());
  $row =mysqli_fetch_assoc($rs);
  $total_rows = mysqli_num_rows($rs);


            if($total_rows > 0) {
              do{
                 ?>
             <tr>
             <td class="tdB"> <?php printf($row["num_mesa"]); ?> </td>

             <td class="tdB"> <?php printf($row["id_orden"]); ?> </td>
             <td class="tdB"> <?php printf($row["total_orden"]); ?> </td>
             <td class="tdB"> <?php printf($row["forma_pago"]); ?> </td>
            <td class="tdB"> <?php printf($row["fecha"]); ?>   </td>
            </tr>
          <?php	}while ($row = mysqli_fetch_assoc($rs) );
                 mysqli_free_result($rs);
          }else{
          ?>
           <tr>
             <td class="tdB"> colspan="5">No data faund.</td>
           </tr>
         <?php } ?>
		 </table>
		 <!--</center>-->
    </section>