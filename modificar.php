<?php
 include_once("modelo/conexion.php");
?>
<!DOCTYPE html>
<html>
<head>
     <title>Index de Imagenes</title>
</head>
<body>

  <?php
     $id=$_REQUEST['id'];

        $query="SELECT * FROM producto WHERE id_producto='$id'";
        $resultado=$conection->query($query);
        $row = $resultado->fetch_assoc();
       ?>

    <center><br/><br/><br/>
      <form action="proceso_modificar.php?id=<?php echo $row['id_producto'] ?>" method="POST" enctype="multipart/form-data" >   <!-- con esto vamos apoder enviar archivos a la BD -->
            Nombre:      <br>  <input type="text" REQUIRED name="NOM" value="<?php echo $row['nombre_producto']; ?>"><br><br><br>
            <!-- <input type="text" REQUIRED name="nombre" placeholder="..."value=""/><br/><br/> -->
            Descripcion: <br>  <input type="text" REQUIRED  name="DESC" value="<?php echo $row['descripcion_producto']; ?>"><br><br><br>
            Precio:      <br>  <input type="number" REQUIRED name="PREC" value="<?php echo $row['precio_producto']; ?>"><br><br><br>
            Categoria: <select name="action" REQUIRED value="<?php echo $row['id_categoria']; ?>">
                           <option value="1">Promociones </option>
                           <option value="2">Desayuno</option>
                           <option value="3">Comida</option>
                           <option value="4">Cena</option>
                           <option value="5">Bebidas</option>
                           <option value="6">Postres</option>
                      </select><br><br>
            <input type="file" REQUIRED name="Imagen"/><br/><br/>
            <img height="190px" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen_producto']); ?>"/>
            <input type="submit" value="modificar">
            <!-- <input type="Reset" value="LIMPIAR"> -->
        </form>
      </center>
</body>
<html>