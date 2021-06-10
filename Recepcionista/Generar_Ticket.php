<?php
  session_start();
  include_once("modelo/conexion.php");
  
  include_once("cabecera_Inicio.html");
  include_once("menu.html");

  $busqueda='';
  $where="";

  if(isset($_REQUEST['busqueda']) && $_REQUEST['busqueda']==''){
    header("location: Generar_Ticket.php");
  }

  if(!empty($_REQUEST['busqueda'])){
    if(!is_numeric($_REQUEST['busqueda'])){
      header("location: Generar_Ticket.php");
    }

    $busqueda = strtolower($_REQUEST['busqueda']);
    $where = "id_orden = $busqueda";
    $buscar= "busqueda = $busqueda";
  }
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/estilo.css">    
<title>Generar ticket</title>
</head>
<body>
    <section class="inicio">

    <table style="width: 100%">
      <tr>
      <td><h1> Generar ticket </h1></td><br>
      </tr>

      <form action="Generar_Ticket.php" method="get" class="form_search">
            <tr>
               <td><br><input type="text" name="busqueda" placeholder="No. Pedido" value="<?php echo $busqueda;?>" </td>
               <button type="submit" class="bth_search"><i class="fas fa-search"></i></button> <br><br>
            </tr>
      </form>
      
      <table class="tablaGeneraTicket">
        <tr align="center">
          <th><strong>Numero Mesa</strong></td>
          <th><strong>Numero Pedido</strong></td>
          <th><strong>Fecha</strong></td>
          <th><strong>Ticket</strong></td>
        </tr>

      <?php
      $strsql = "SELECT * FROM historial WHERE $where";

        $rs= mysqli_query($conection,$strsql) or die(mysql_error());
        $row =mysqli_fetch_assoc($rs);
        $total_rows = mysqli_num_rows($rs);

        if($total_rows > 0) {
          do{
             ?>
         <tr  align="center">
         <td class="tdB"> <?php printf($row["num_mesa"]); ?> </td>
         <td class="tdB"> <?php printf($row["id_orden"]); ?> </td>
         <td class="tdB"> <?php printf($row["fecha"]); ?>   </td>
      <?php	}while ($row = mysqli_fetch_assoc($rs) );
             mysqli_free_result($rs);
     
      $strsql1 = "SELECT * FROM ticket WHERE $where";
        $rs1= mysqli_query($conection,$strsql1) or die(mysql_error());
        $row1 =mysqli_fetch_assoc($rs1);
        
        if($busqueda==$row1["id_orden"]){ ?>
            <td class="tdB"><a target="_BLANK" href="ticket.php?busqueda=<?php print($busqueda); ?>"><button type="submit" class="bth_imprimir">Imprimir</button></a></td>
        <?php 
        }else{ ?>
            <td class="tdB"><a href="genera.php?busqueda=<?php print($busqueda); ?>"><button type="submit" class="bth_generar">Generar</button></a></td>
       <?php }
    
    }else{?>
        <tr align="center">
         <td class="tdB" colspan="4">NO HAY DATOS</td>
       </tr>
   <?php }?>
   
  </table>
  </section>
</body>
</html>
<?php
include_once("pie.html");
?>
