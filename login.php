<?php session_start();
require_once("modelo/conexion.php");
$alert='';

if(!empty($_SESSION['active'])){  //if del rol
    header("Location: index.php");
		
		if($data['id_rol']==1){
			header("Location: inicioADM.php");
	    
		}else{
			
		   if($data['id_rol']==2){
			  header("Location: Recepcionista/inicio.php");
		    }
		}
		
}else{
	
	if(!empty($_POST)){
		if(empty($_POST['usuario']) || empty($_POST['password'])){
		   $alert='Falta ingresar su usuario o su contraseña';
	
	}else{
	   $user=$_POST['usuario'];
	   $pass=$_POST['password'];

       $query="SELECT * FROM usuario WHERE usuario ='$user' AND password ='$pass'";
	   $result=$conection->query($query);
	   $numeroRegistros=$result->num_rows;
       
       if($numeroRegistros>0){
		  $data=$result->fetch_array();

			if($data['id_rol'] ==1){ //Si es ADMINISTRADOR
               $_SESSION['active']=true;
			   $_SESSION['idUser']=$data['id_usuario'];
			   $_SESSION['rol']=$data['id_rol'];
			   $_SESSION['User']=$data['usuario'];
			   header("Location: inicioADM.php");
            
			}else{
				
			   if ($data['id_rol'] ==2){
				   $_SESSION['active']=true;
				   $_SESSION['idUser']=$data['id_usuario'];
				   $_SESSION['id_rol']=$data['id_rol'];
				   $_SESSION['User']=$data['usuario'];
				   header("Location: Recepcionista/inicio.php");
				}
            }
		}else{
		   $alert='El usuario o la clave son incorrectos';
		   session_destroy();
		}
	}//corchete else linea 24
   } //linea 20
 }//corchete del else de linea 18
?>