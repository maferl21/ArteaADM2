<?php
    require('../../lib/fpdf.php');

    class PDF extends FPDF{
        
        function header(){
            $this->SetFont('times','B', 16);
            $this->Cell(60);
            $this->Cell(70,10, "Restaurante Artea",0,0,'C',0); //c para centrado
            $this->Cell(60);
            $this->Ln(20); //salto de linea
        }

        function footer(){
            $this->SetY(-15); 
            $this->SetFont('times','B',8);
            $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
        }
    }
    include_once("modelo/conexion.php");
    $id_orden=$_GET['busqueda'];

    //para mostrar los productos
    $sqlVista="SELECT nombre_producto, precio_producto, cantidad, total FROM condetalle WHERE id_orden=".$id_orden;
	$rs=mysqli_query($conection,$sqlVista) or die(mysql_error());
    $row=mysqli_fetch_assoc($rs);
    $total_rows= mysqli_num_rows($rs);

    //buscar ticket
    $sqll12="SELECT id_ticket FROM ticket WHERE id_orden=".$id_orden;
    $rs1=mysqli_query($conection,$sqll12) or die(mysql_error());
    $row1=mysqli_fetch_assoc($rs1);

    //para mostrar datos de orden
    $sqll="SELECT id_orden, num_mesa, total_orden FROM orden WHERE id_orden=".$id_orden;
    $rs2=mysqli_query($conection,$sqll) or die(mysql_error());
    $row2=mysqli_fetch_assoc($rs2);
   
    $mesa=$row2["num_mesa"];
	$total=$row2["total_orden"];

     // OBTENER FECHA ACTUAL
     date_default_timezone_set("America/Mexico_City");
     $fechaActual=date("Y")."-".date("m")."-".date("d"); //fecha actual del sistema

    if($row1==""){ //si esta vacio es que no hay ningun ticket y hace la insercion
        //para insertar el ticket
        $query="INSERT INTO ticket(fecha_ticket,id_orden) VALUES ('".$fechaActual."', '".$id_orden."')";
        $Result=$conection->query($query);

        $query="SELECT id_ticket, fecha_ticket FROM ticket WHERE id_orden=".$id_orden;
        $rs3=mysqli_query($conection,$query) or die(mysql_error());
        $bus=mysqli_fetch_assoc($rs3);
    }else{
        $query="SELECT id_ticket, fecha_ticket FROM ticket WHERE id_orden=".$id_orden;
        $rs3=mysqli_query($conection,$query) or die(mysql_error());
        $bus=mysqli_fetch_assoc($rs3);
    }
    $folio=$bus["id_ticket"];
    $fecha=$bus["fecha_ticket"];
    
    $pdf = new FPDF();
    $pdf->AliasNbPages();//CREA PIE DE PAGINA
    $pdf->AddPage(); //AGREGA LA PAGINA
    $pdf->SetFont('times','B', 18);
    
    $pdf->Cell(60);
    $pdf->Cell(70,10,"Restaurante Artea",0,1,'C',0); //c para centrado
    
    $pdf->SetFont('times','B', 10);
    $pdf->SetFont('');

    //DATOS DE LA EMPRESA
    $pdf->Cell(60);
    $pdf->Cell(70,5,"RFC ARTEA-294649",0,1,'C',0);
    $pdf->Cell(60);
    $pdf->Cell(70,5,"DOMICILIO FISCAL",0,1,'C',0);
    $pdf->Cell(60);
    $pdf->Cell(70,5,"ORIZABA CENTRO, VER CP. 94300",0,1,'C',0);
    $pdf->Cell(60);
    $pdf->Cell(70,5,"TEL. 2723456283",0,1,'C',0);
    $pdf->Ln(15); 

    $pdf->SetFont('times','B', 12);

    //FOLIO
    $pdf->Cell(7);
    $pdf->Cell(30,7,"FOLIO: ",0,0,'R',0);
    $pdf->SetFont('');
    $pdf->Cell(30,7, $folio,0,1,'L',0);
    //FECHA
    $pdf->SetFont('times','B', 12);
    $pdf->Cell(8);
    $pdf->Cell(30,7,"FECHA: ",0,0,'R',0);
    $pdf->SetFont('');
    $pdf->Cell(30,7, $fecha,0,1,'L',0);
    //ORDEN
    $pdf->SetFont('times','B', 12);
    $pdf->Cell(8);
    $pdf->Cell(30,7,"ORDEN: ",0,0,'R',0);
    $pdf->SetFont('');
    $pdf->Cell(30,7, $id_orden,0,1,'L',0);
    //MESA
    $pdf->SetFont('times','B', 12);
    $pdf->Cell(12);
    $pdf->Cell(30,7,"No. MESA: ",0,0,'R',0);
    $pdf->SetFont('');
    $pdf->Cell(30,7, $mesa,0,1,'L',0);
    
    $pdf->Cell(18);
    $pdf->Cell(30,7,"-------------------------------------------------------------------------------------------------------------",0,1,'L',0);

    $pdf->SetFont('times','B', 12);

    //PEDIDOS
    $pdf->Cell(15);
    $pdf->Cell(70,10,"Platillo/Bebida",0,0,'C',0);
    $pdf->Cell(30,10,"Precio",0,0,'C',0);
    $pdf->Cell(30,10,"Cantidad",0,0,'C',0);
    $pdf->Cell(30,10,"Total",0,1,'C',0);
    
    $pdf->SetFont('');

    if ($total_rows){
        do{
            $pdf->Cell(15);
            $pdf->Cell(70,10, $row["nombre_producto"],0,0,'C',0);
            $pdf->Cell(30,10, number_format($row["precio_producto"],2),0,0,'C',0);
            $pdf->Cell(30,10, $row["cantidad"],0,0,'C',0);
            $pdf->Cell(30,10, number_format($row["total"],2),0,1,'C',0);
        }while ($row = mysqli_fetch_assoc($rs) );
                mysqli_free_result($rs);
    }
    $pdf->Ln(5); 

    $pdf->Cell(18);
    $pdf->Cell(30,7,"-------------------------------------------------------------------------------------------------------------",0,1,'L',0);
    
    $pdf->SetFont('times','B', 12);
    $pdf->Cell(125);
    $pdf->Cell(30,7,"TOTAL A PAGAR: ",0,0,'R',0);
    $pdf->SetFont('');
    $pdf->Cell(30,7, number_format($total,2),0,1,'L',0);

    $pdf->SetFont('times','B', 14);
    $pdf->Ln(13); 
    $pdf->Cell(60);
    $pdf->Cell(70,5,utf8_decode('¡GRACIAS POR TU COMPRA!'),0,1,'C',0);

    $pdf->Output();

?>