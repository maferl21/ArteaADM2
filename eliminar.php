<?php
     include_once("modelo/conexion.php");
     $id=$_REQUEST['id'];
     $idcat=$_REQUEST['idc'];

        if($idcat==1){
          $Query= "DELETE FROM promociones WHERE id_producto='$id'";
          $resultado= $conection->query($Query);
        }
        
        if($idcat==2){
          $Query= "DELETE FROM desayuno WHERE id_producto='$id'";
          $resultado= $conection->query($Query);
        }
        
        if($idcat==3){
          $Query= "DELETE FROM almuerzo WHERE id_producto='$id'";
          $resultado= $conection->query($Query);
        }
        
        if($idcat==4){
          $Query= "DELETE FROM cena WHERE id_producto='$id'";
          $resultado= $conection->query($Query);
        }
        
        if($idcat==5){
          $Query= "DELETE FROM postres WHERE id_producto='$id'";
          $resultado= $conection->query($Query);
        }
        
        if($idcat==6){
          $Query= "DELETE FROM bebidas WHERE id_producto='$id'";
          $resultado= $conection->query($Query);
        }
            if($resultado){
              $Query= "DELETE FROM producto WHERE id_producto='$id'";
              $resultado= $conection->query($Query);
        
                 if($resultado){
                       header("Location: buscar.php");
                     // echo "se elimino de producto ";
                 }
                  else
                      echo "----No se elimin¨® de la tabla producto";
             }
            else
              echo "----NO se pudo eliminar de la categoria";
        
 ?>
