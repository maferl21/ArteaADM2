<?php
   include_once("modelo/conexion.php");
   $idCAT = $_POST["action"];


   $Query = mysqli_query($conection,"SELECT * FROM producto WHERE nombre_producto='".$_POST['NOM']."'");
   $resultado= mysqli_num_rows($Query);

   if($resultado >0){
       // echo "ERRRRORRR";
        header("Location: index.php");
        $var = "El Nombre ingresado ya existe, por favor ingese uno diferente";
        echo "<script> alert('".$var."'); </script>";

   }if(!$resultado){

     $Imagen=addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));
     //echo $idCAT;

      if($idCAT==1){ //-------PROMOCIONES------

            $Query1= "INSERT INTO promociones(id_promociones) VALUES('0')";
            $resultado1= $conection->query($Query1);

             if($resultado1){
               $QueryIP1= "INSERT INTO producto(nombre_producto,descripcion_producto,precio_producto,id_categoria,imagen_producto) VALUES('".$_POST["NOM"]."','".$_POST["DESC"]."','".$_POST["PREC"]."','".$_POST["action"]."','$Imagen')";
               $resultadoIP1= $conection->query($QueryIP1);

               $query1="SELECT id_producto FROM producto WHERE id_producto=(SELECT MAX(id_producto) FROM producto)";
               $result1=mysqli_query($conection,$query1);
               
                if($row1=$result1->fetch_array()){
                   $PRmax1=trim ($row1[0]);


               $query11="SELECT id_promociones FROM promociones WHERE id_promociones=(SELECT MAX(id_promociones) FROM promociones)";
                $result11=mysqli_query($conection,$query11);
                if($row11=$result11->fetch_array()){
                  $max21=trim ($row11[0]);
              // echo $PRmax;
              // echo $max2;

               $Query="UPDATE promociones SET id_producto='$PRmax1' WHERE id_promociones='$max21'";
               $resultado= $conection->query($Query);
                if($resultado){
                $var = "El producto fue agregado correctamente";
                echo "<script> alert('".$var."'); </script>   ";
                // echo $PRmax;
                // echo $max2;

              }else
              echo "  NO HA SIDO POSIBLE AGREGAR en categoria id ";
              }
             }else{
                    echo "  NO HA SIDO POSIBLE AGREGAR EL PRODUCTO A LA TABLA DE PROMOCIONES linea 31";
                    // echo "<script> alert('".$var."'); </script>";
                 }
        }//25
    }//20

    if($idCAT==2){ //-------DESAYUNO------

          $Query2= "INSERT INTO desayuno(id_desayuno) VALUES('0')";
          $resultado2= $conection->query($Query2);

           if($resultado2){
             $QueryIP2= "INSERT INTO producto(nombre_producto,descripcion_producto,precio_producto,id_categoria,imagen_producto) VALUES('".$_POST["NOM"]."','".$_POST["DESC"]."','".$_POST["PREC"]."','".$_POST["action"]."','$Imagen')";
             $resultadoIP2= $conection->query($QueryIP2);

             $query2="SELECT id_producto FROM producto WHERE id_producto=(SELECT MAX(id_producto) FROM producto)";
             $result2=mysqli_query($conection,$query2);
              if($row2=$result2->fetch_array()){
                 $PRmax2=trim ($row2[0]);


             $query12="SELECT id_desayuno FROM desayuno WHERE id_desayuno=(SELECT MAX(id_desayuno) FROM desayuno)";
              $result12=mysqli_query($conection,$query12);
              
              if($row12=$result12->fetch_array()){
                $max22=trim ($row12[0]);
            // echo $PRmax;
            // echo $max2;

             $Query="UPDATE desayuno SET id_producto='$PRmax2' WHERE id_desayuno='$max22'";
             $resultado= $conection->query($Query);
              if($resultado){
              $var = "El producto fue agregado correctamente";
              echo "<script> alert('".$var."'); </script>   ";
              // echo $PRmax;
              // echo $max2;

            }else
            echo "NO HA SIDO POSIBLE AGREGAR en categoria id";
            }
           }else{
                  echo "NO HA SIDO POSIBLE AGREGAR EL PRODUCTO A LA TABLA DE PROMOCIONES linea 31";
                  // echo "<script> alert('".$var."'); </script>";
               }
      }//25
  }//20

  if($idCAT==3){ //-------DESAYUNO------
      //echo "linea 101";
        $Query3= "INSERT INTO almuerzo(id_alm) VALUES('0')";
        $resultado3= $conection->query($Query3);
        
     // echo "linea 104";
      //echo $resultado3;
      
         if($resultado3){
          // echo "linea 106";
           $QueryIP3= "INSERT INTO producto(nombre_producto,descripcion_producto,precio_producto,id_categoria,imagen_producto) VALUES('".$_POST["NOM"]."','".$_POST["DESC"]."','".$_POST["PREC"]."','".$_POST["action"]."','$Imagen')";
           $resultadoIP3= $conection->query($QueryIP3);

           $query3="SELECT id_producto FROM producto WHERE id_producto=(SELECT MAX(id_producto) FROM producto)";
           $result3=$conection->query($query3);

            if($row3=$result3->fetch_array()){
              
               $PRmax3=trim ($row3[0]);
                  
           $query13="SELECT id_alm FROM almuerzo WHERE id_alm=(SELECT MAX(id_alm) FROM almuerzo)";
            $result13=mysqli_query($conection,$query13);
           
            if($row13=$result13->fetch_array()){
              $max23=trim ($row13[0]);

           $Query="UPDATE almuerzo SET id_producto='$PRmax3' WHERE id_alm='$max23'";
           $resultado= $conection->query($Query);
            if($resultado){
            $var = "El producto fue agregado correctamente";
            echo "<script> alert('".$var."'); </script>   ";
            // echo $PRmax;
            // echo $max2;

          }else
          echo "NO HA SIDO POSIBLE AGREGAR en categoria id";
          }
         }else{
                echo "NO HA SIDO POSIBLE AGREGAR EL PRODUCTO A LA TABLA DE PROMOCIONES linea 31";
                // echo "<script> alert('".$var."'); </script>";
             }
    }//105
    else{
           echo "105";
           // echo "<script> alert('".$var."'); </script>";
        }
}//20
else{
       echo "20";
       // echo "<script> alert('".$var."'); </script>";
    }

    if($idCAT==4){ //-------CENA------
       // echo "linea 101";
          $Query4= "INSERT INTO cena(id_cena) VALUES('0')";
          $resultado4= $conection->query($Query4);
       // echo "linea 104";
        //echo $resultado4;
        
           if($resultado4){
             //echo "linea 106";
             $QueryIP4= "INSERT INTO producto(nombre_producto,descripcion_producto,precio_producto,id_categoria,imagen_producto) VALUES('".$_POST["NOM"]."','".$_POST["DESC"]."','".$_POST["PREC"]."','".$_POST["action"]."','$Imagen')";
             $resultadoIP4= $conection->query($QueryIP4);

             $query4="SELECT id_producto FROM producto WHERE id_producto=(SELECT MAX(id_producto) FROM producto)";
             $result4=$conection->query($query4);
             // echo $result3;

              if($row4=$result4->fetch_array()){
                 $PRmax4=trim ($row4[0]);

             $query14="SELECT id_cena FROM cena WHERE id_cena=(SELECT MAX(id_cena) FROM cena)";
              $result14=mysqli_query($conection,$query14);
              if($row14=$result14->fetch_array()){
                $max24=trim ($row14[0]);

             $Query="UPDATE cena SET id_producto='$PRmax4' WHERE id_cena='$max24'";
             $resultado= $conection->query($Query);
              if($resultado){
              $var = "El producto fue agregado correctamente";
              echo "<script> alert('".$var."'); </script>   ";
              // echo $PRmax;
              // echo $max2;

            }else
            echo "NO HA SIDO POSIBLE AGREGAR en categoria id";
            }
           }else{
                  echo "NO HA SIDO POSIBLE AGREGAR EL PRODUCTO A LA TABLA DE PROMOCIONES linea 31";
                  // echo "<script> alert('".$var."'); </script>";
               }
      }//105
      else{
             echo "105";
             // echo "<script> alert('".$var."'); </script>";
          }
    }//20
    else{
         echo "20";
         // echo "<script> alert('".$var."'); </script>";
      }

      if($idCAT==5){ //-------POSTRES------
         // echo "linea 101";
            $Query5= "INSERT INTO postres(id_postres) VALUES('0')";
            $resultado5= $conection->query($Query5);
         // echo "linea 104";
          //echo $resultado5;
             if($resultado5){
              // echo "linea 106";
               $QueryIP5= "INSERT INTO producto(nombre_producto,descripcion_producto,precio_producto,id_categoria,imagen_producto) VALUES('".$_POST["NOM"]."','".$_POST["DESC"]."','".$_POST["PREC"]."','".$_POST["action"]."','$Imagen')";
               $resultadoIP5= $conection->query($QueryIP5);

               $query5="SELECT id_producto FROM producto WHERE id_producto=(SELECT MAX(id_producto) FROM producto)";
               $result5=$conection->query($query5);
               // echo $result3;

                if($row5=$result5->fetch_array()){
                   $PRmax5=trim ($row5[0]);

               $query15="SELECT id_postres FROM postres WHERE id_postres=(SELECT MAX(id_postres) FROM postres)";
                $result15=mysqli_query($conection,$query15);
                if($row15=$result15->fetch_array()){
                  $max25=trim ($row15[0]);

               $Query="UPDATE postres SET id_producto='$PRmax5' WHERE id_postres='$max25'";
               $resultado= $conection->query($Query);
                if($resultado){
                $var = "El producto fue agregado correctamente";
                echo "<script> alert('".$var."'); </script>   ";
                // echo $PRmax;
                // echo $max2;

              }else
              echo "NO HA SIDO POSIBLE AGREGAR en categoria id";
              }
             }else{
                    echo "NO HA SIDO POSIBLE AGREGAR EL PRODUCTO A LA TABLA DE PROMOCIONES linea 31";
                    // echo "<script> alert('".$var."'); </script>";
                 }
        }//105
        else{
               echo "105";
               // echo "<script> alert('".$var."'); </script>";
            }
      }//20
      else{
           echo "20";
           // echo "<script> alert('".$var."'); </script>";
        }


        if($idCAT==6){ //------BEBIDAS------
            //echo "linea 101";
              $Query6= "INSERT INTO bebidas(id_bebidas) VALUES('0')";
              $resultado6= $conection->query($Query6);
            //echo "linea 104";
            //echo $resultado6;
            
               if($resultado6){
                // echo "linea 106";
                
                 $QueryIP6= "INSERT INTO producto(nombre_producto,descripcion_producto,precio_producto,id_categoria,imagen_producto) VALUES('".$_POST["NOM"]."','".$_POST["DESC"]."','".$_POST["PREC"]."','".$_POST["action"]."','$Imagen')";
                 $resultadoIP6= $conection->query($QueryIP6);

                 $query6="SELECT id_producto FROM producto WHERE id_producto=(SELECT MAX(id_producto) FROM producto)";
                 $result6=$conection->query($query6);
                 // echo $result3;

                  if($row6=$result6->fetch_array()){
                     $PRmax6=trim ($row6[0]);

                 $query16="SELECT id_postres FROM bebidas WHERE id_bebidas=(SELECT MAX(id_bebidas) FROM bebidas)";
                  $result16=mysqli_query($conection,$query16);
                  if($row16=$result16->fetch_array()){
                    $max26=trim ($row16[0]);

                 $Query="UPDATE bebidas SET id_producto='$PRmax6' WHERE id_bebidas='$max26'";
                 $resultado= $conection->query($Query);
                 
                  if($resultado){
                  $var = "El producto fue agregado correctamente";
                  echo "<script> alert('".$var."'); </script>   ";
                  // echo $PRmax;
                  // echo $max2;

                }else
                echo "NO HA SIDO POSIBLE AGREGAR en categoria id";
                }
               }else{
                      echo "NO HA SIDO POSIBLE AGREGAR EL PRODUCTO A LA TABLA DE PROMOCIONES linea 31";
                      // echo "<script> alert('".$var."'); </script>";
                   }
          }//105
          else{
                 echo "105";
                 // echo "<script> alert('".$var."'); </script>";
              }
        }//20
        else{
             echo "20";
             // echo "<script> alert('".$var."'); </script>";
          }

}//15

?>
