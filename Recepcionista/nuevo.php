<?php 
session_start();
include_once("modelo/conexion.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Nueva Factura</title>
    </head>
<body>
        <?php
    $id_ticket=$_GET['busqueda'];
    $strsql = "SELECT id_orden FROM ticket WHERE id_ticket='".$id_ticket."'";
    $rs= mysqli_query($conection,$strsql) or die(mysql_error());
    $row =mysqli_fetch_assoc($rs);
    
    $ticket=$id_ticket;
    ?>
      <div class="title_page">
        <h1>Nueva Factura</h1>
      </div>
      <div class="datos_cliente">
        <div class="action_cliente">
          <h3>Datos del cliente</h3>
        </div>
        <form action="agregar.php?id=<?php echo $ticket ?>" target="" method="POST" name="form_new_cliente" class="datos">
           <!--<input type="text" name="busqueda" placeholder="No. ticket" value="<?php echo $busqueda;?>">-->
            <TABLE>
                <TR>
                    <TD><strong>Nombre</strong> </TD>
                    <td><input type=text size=40 name="Nombre"></td>
                </TR>
               
                <TR>
                    <TD><strong>RFC</strong> </TD>
                    <td><input type=text size=40 name="RCF"></td>
                </TR>
                <TR>
                    <TD><strong>Email</strong> </TD>
                    <td><input type=text size=40 name="Email"></td>
                </TR>    
            </TABLE>
          <button type="submit" class="bth_generar">Generar</button>
        </form>
      </div>
      
      <div class="datos_venta">
        <h3>Datos del restaurante</h3>
        <div class="datos">
        <div class="wd50">
          <label>RECEPCIONISTA: Carlos Estrada Porras</label><br>
          <label>RFC: ARTEA-294649</label><br>
          <label>DOMICILIO FISCAL: ORIZABA CENTRO, VER CP. 94300 </label><br>
          <label>TEL. 2723456283</label>
        </div>
      </div>
    </div>

      <div class="datos_venta">
        <h3>Datos de los productos</h3>
        <div class="datos">
        <div class="wd50">
      
      <?php
      $strsql1="SELECT * FROM prodFactura WHERE id_orden='".$row["id_orden"]."'";
      $rs1=mysqli_query($conection,$strsql1) or die(mysql_error());
      $row1=mysqli_fetch_assoc($rs1);
      $total_rows1=mysqli_num_rows($rs1);
      $to=$row1["total_orden"];
      
      ?>

              <table style="width: 100%">
                  <tr align="center">
                  <td><strong>Codigo</strong></td>      
                  <td><strong>Nombre</strong></td>
                  <td><strong>Descripcion</strong></td>
                  <td><strong>Cantidad</strong></td>
                  <td><strong>Precio Unitario</strong></td>
                  <td><strong>Precio Total</strong></td>
                  </tr>
                  
            <?php if($total_rows1 > 0) {
                     do{ ?>
                      <tr>
                        <td align="center"> <?php print($row1["id_prod"]); ?> </td>  
                        <td align="center" style="width: 20%"> <?php print($row1["nombre_producto"]); ?> </td>
                        <td> <?php print($row1["descripcion_producto"]);?> </td>
                        <td align="center"> <?php print($row1["cantidad"]); ?> </td>
                        <td align="center"> <?php print($row1["precio_producto"]); ?> </td>
                        <td align="center"> <?php print($row1["total"]); ?> </td>
                      </tr>
                 <?php }while ($row1 = mysqli_fetch_assoc($rs1) );
                                      mysqli_free_result($rs1);
                    } ?>
            </table><br><br>
            <table>
      <tfoot>
          <tr>
              <td class="textringht"><strong>TOTAL Q. $</strong></td>
              <td class="textrigth"><strong><?php echo $to;?></strong></td>
          </tr>
      </tfoot>
      </table>
          </div>
        </div>
     </div>
  </body>
</html>
