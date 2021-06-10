<?php
session_start();
include_once("modelo/conexion.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="css/estilo.css">
<title>Consular pedidos</title>
</head>
<body>


<?php
  include_once("cabecera_Inicio.html");
  include_once("menu.html");

  $busqueda='';
  $where="";

  if(isset($_REQUEST['busqueda']) && $_REQUEST['busqueda']==''){
    header("location: Consultar_Pedidos.php");
  }

  if(!empty($_REQUEST['busqueda'])){
    if(!is_numeric($_REQUEST['busqueda'])){
      header("location: Consultar_Pedidos.php");
    }

    $busqueda = strtolower($_REQUEST['busqueda']);
    $where = "id_orden = $busqueda";
    $buscar= "busqueda = $busqueda";
  }
?>
    <section class="inicio">

      <h1> Consultar Pedidos </h1><br>

      <form action="Consultar_Pedidos.php" method="get" class="form_search">
            <tr>
               <td><br><input type="text" name="busqueda" placeholder="No. Pedido" value="<?php echo $busqueda;?>" </td>
               <button type="submit" class="bth_search"><i class="fas fa-search"></i></button> <br><br>
            </tr>
      </form>


            <center>  
              <strong>Numero del pedido: </strong>
              <table class="tablaConsultarPedidos">
                  <tr align="center">
                  <th><strong>Nombre del producto</strong></td>
                  <th><strong>Precio del producto</strong></td>
                  <th><strong>Cantidad del producto</strong></td>
                  <th><strong>Forma pago</strong></td>
                  </tr>

        <?php
        $strsql = "SELECT * FROM condetalle WHERE $where";
          $rs= mysqli_query($conection,$strsql) or die(mysql_error());
          $row =mysqli_fetch_assoc($rs);
          $total_rows = mysqli_num_rows($rs);
        $strsql1 = "SELECT * FROM historial WHERE $where";
          $rs1= mysqli_query($conection,$strsql1) or die(mysql_error());
          $row1 =mysqli_fetch_assoc($rs1);

          if($total_rows > 0) { ?>
            <tr> <?php print($row["id_orden"]); ?> </tr><br><br>
          <?php  do{ ?>
           <tr align="center">
              <td class="tdB"> <?php print($row["nombre_producto"]); ?> </td>
              <td class="tdB"> <?php printf($row["precio_producto"]); ?> </td>
              <td class="tdB"> <?php print($row["cantidad"]); ?> </td>
              <td class="tdB"> <?php print($row1["forma_pago"]); ?> </td>
           </tr>
        <?php	}while ($row = mysqli_fetch_assoc($rs) );
               mysqli_free_result($rs);
                ?>
        </table>         
                <strong><br>Total de la orden: </strong>
                <strong>$<?php printf($row1["total_orden"]); ?></strong>
        <?php
        }else{
        ?>
        <table class="tablaConsultarPedidos">
                  <tr align="center"><br><strong>NO HAY DATOS</strong></tr>
        </table>         
        <?php } ?>
        </center>
  </section>
</body>
</html>
<?php
include_once("pie.html");
?>
