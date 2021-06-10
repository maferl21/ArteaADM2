<?php
  include_once("cabecera.html");
  include_once("aside.html");
?>
<!--<link href="css/estiloHistorial.css" rel="stylesheet" type="text/css">-->

<center>
    <section>
       <br> <h2 id="tituloH">Agregar Producto</h2><br>
        
         <!-- con esto vamos apoder enviar archivos a la BD -->
           <form action="proceso_guardar4.php" method="POST" enctype="multipart/form-data" class="form-guardar"> 
           
                Nombre:      <br>  <input class="input-1" type="text" REQUIRED name="NOM"><br><br><br>
                <!-- <input type="text" REQUIRED name="nombre" placeholder="..."value=""/><br/><br/> -->
                Descripcion: <br>  <input class="input-1" type="text"   REQUIRED name="DESC"><br><br><br>
                Precio:      <br>  <input class="input-1" type="number" REQUIRED name="PREC"><br><br><br>
                Categoria:  <select name="action" REQUIRED class="input-2">
                               <option value="1">Promociones </option>
                               <option value="2">Desayuno</option>
                               <option value="3">Almuerzo</option>
                               <option value="4">Cena</option>
                               <option value="5">Bebidas</option>
                               <option value="6">Postres</option>
                          </select><br><br>
                <input type="file" REQUIRED name="Imagen"/><br/><br/><br>
                <input type="submit" value="AGREGAR" class="btn-agregarP">
                <!-- <input type="Reset" value="LIMPIAR"> -->
          </form>
    </section>
 </center>  
    <br>
<?php
  include_once("pie.html");
?>

<style>
    .input-1{
        font-family: Tahoma;
        padding: 6px;
        width: 250px;
        text-align: center;
        border: 1px solid #999999;
    }
    .input-1:hover, .input-2:hover {
        border: 1px solid #93BDED;
    }
    .form-guardar{
        font-family: Tahoma;
    }
    .input-2{
        font-family: Tahoma;
        padding: 4px;
        width: 150px;
        border: 1px solid #999999;
    }
    .btn-agregarP{
        padding: 10px;
        border: none;
        cursor: pointer;
        font-size: 15px;
        color: #fff;
    	background: #1850b1;
    }
    .btn-agregarP:hover{
        background: #2364d2;
    }
    .btn-agregarP:focus{
        background-color: #e0e0e0;
        color: #1850b1;
    }
</style>