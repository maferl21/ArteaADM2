<?php
     include_once("modelo/conexion.php");
     include_once("modelo/conexion.php");
    require_once("cabecera.html");
    require_once("aside.html");
?>
<!DOCTYPE html>
<html>
<head>
</head>
<style>
        #tituloH{
            padding-top:10px;
            font-size: 30px;
        }

        #bus{
         padding-left: 25%;

        }
        .btn-eli, .btn-mod{
            padding: 10px;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }
        .btn-eli{
            background-color: #ff0000;
            color: #ffffff;
        }
        .btn-eli:hover{
            background-color: #e0e0e0;
            color: #ff0000;
        }
        
        .btn-mod{
            background-color: #388E3C;
            color: #ffffff;
        }
        .btn-mod:hover{
            background-color: #e0e0e0;
            color: #000000;
        }
        
</style>
<body>

<section id="bus">
<center>
<h3 id="tituloH"> Consultar Producto </h3> <br>

     <form action ="buscar.php" method="GET">

      <input type"text" REQUARED name="busqueda">
      <input type="submit" name="enviar" value="buscar">
     </form> </center>

<?php

    if(isset($_GET['enviar'])){
         $busqueda = $_GET['busqueda'];

         $consulta = $conection->query("SELECT * FROM producto WHERE nombre_producto LIKE '$busqueda%'");
         $row = $consulta -> fetch_array();
         
         if($row){
         while($row = $consulta -> fetch_array()){
           $ids= $row['id_categoria'];
          $consulta2 = $conection->query("SELECT categoria FROM categoria WHERE id_categoria LIKE '%$ids");
        //  echo "IMAGEN: ";
          ?>
         <table >
                      <tr>
                           <th rowspan="5">
                               <br> <img height="190px" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen_producto']); ?>"/> <br/>
                           </th>
                          <td><?php echo "NOMBRE: ";?>
                          <?php echo $row['nombre_producto'].'<br>';?></td>
                      </tr>
                      <tr>
                          <td><?php echo "DESCRIPCION: ";?>
                          <?php echo $row['descripcion_producto'].'<br>';?></td>
                      </tr>
                      <tr>
                        <td><?php echo "CATEGORIA: ";?>

                         <?php if($row['id_categoria'] == 1){
                                echo "Promociones ";
                             }if($row['id_categoria'] == 2){
                               echo "Desayunos ";
                             }if($row['id_categoria'] == 3){
                               echo "Almuerzo ";
                             }if($row['id_categoria'] == 4){
                               echo "Cena ";
                             }if($row['id_categoria'] == 5){
                               echo "Postres ";
                             }if($row['id_categoria'] == 6){
                               echo "Bebidas ";
                             }?>
                             </td>
                      </tr>

                          <?php echo "<br>";?>
                      <tr>
                        <td> <?php   echo "PRECIO: $ ";?>
                          <?php   echo $row['precio_producto'].'<br>';?>
                        </td>
                      </tr>
                      <tr>
                       <td><a href="modificar.php?id=<?php echo $row['id_producto'];?>"><button class="btn-mod">Modificar</button></a>
                       <a href="eliminar.php?id=<?php echo $row['id_producto'];?>&idc=<?php echo $row['id_categoria'];?>"><button class="btn-eli">Eliminar</button></a><br/></td>
                  </tr>
                  </table>
                  <?php
                             // echo $row['categoria'].'<br>';

                              // echo $row['imagen_producto'].'<br>';
                           }
                           
                        
                      }else{
                           if(!$row){?>
                            <br> <center> 
                            <?php echo "NO SE HAN ENCONTRADO COINCIDENCIAS";
                          }
                        }
    }
?>
                   
</section>
<br><br>
</body>
</html>
<?php
  include_once("pie.html");
?>