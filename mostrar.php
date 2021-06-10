<!DOCTYPE html>
<html>
<head>
     <title>Mostrar imagenes</title>
</head>
<body>
   <center>
       <table>
         <thead>
           <tr>
           </tr>
           <tbody>
           <?php

               include_once("conexion.php");

                 $query="SELECT * FROM producto ";
                 $resultado=$conexion->query($query);

                 while($row = $resultado->fetch_assoc()){
                ?>
                <tr>
                <td> <?php echo $row['id_producto'];?> <br/>
                <td>  <label for="nombre">Nombre:</label><br>
                <td> <?php echo $row['nombre_producto']; ?><br/>
                <td>     <label for="nombre">Imagen:</label><br>
                <td>  <img height="250px" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen_producto']); ?>"/> <br/>
                <th>  <a href="modificar.php?id=<?php echo $row['id_producto'];?>">Modificar</a><br/>
                <th>  <a href="eliminar.php?id=<?php echo $row['id_producto'];?>&idc=<?php echo $row['id_categoria'];?>">Eliminar</a><br/>
                </tr>

            <!--     </tr>-->
              <?php
                 }
              ?>

        </tbody>

        </table>

   </center>
</body>
</html>
<?php  include_once("pie.html");
?>