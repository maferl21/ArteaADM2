<?php
    require('../../lib/fpdf.php');

    class PDF extends FPDF{
        function footer(){
            $this->SetY(-15); 
            $this->SetFont('times','B',8);
            $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
        }
    }
    include_once("modelo/conexion.php");
    $idticket = $_GET['busqueda'];

    //buscar ticket
    $sqll12="SELECT id_orden FROM ticket WHERE id_ticket=".$idticket;
    $rs1=mysqli_query($conection,$sqll12) or die(mysql_error());
    $row1=mysqli_fetch_assoc($rs1);
    $orden=$row1['id_orden'];

    //para mostrar datos de factura
    $sqll="SELECT * FROM factura WHERE id_ticket=".$idticket;
    $rs2=mysqli_query($conection,$sqll) or die(mysql_error());
	$row2=mysqli_fetch_assoc($rs2);
	$idFac=$row2['id_factura'];
    $idTic=$row2['id_ticket'];
	$nombre=$row2['nombre'];
    $rfc=$row2['RFC'];
    $correo=$row2['correo'];
    
     // OBTENER FECHA ACTUAL
    date_default_timezone_set("America/Mexico_City");
    $fechaActual=date("Y")."-".date("m")."-".date("d"); //fecha actual del sistema

    //PRODUCTOS
    $sqlVista="SELECT * FROM prodFactura WHERE id_orden=".$orden;
    $rs3=mysqli_query($conection,$sqlVista) or die(mysql_error());
    $row3=mysqli_fetch_assoc($rs3);
    $total_rows3=mysqli_num_rows($rs3);
    
    //para mostrar datos de orden
    $sqll="SELECT id_orden, total_orden FROM orden WHERE id_orden=".$orden;
    $rs4=mysqli_query($conection,$sqll) or die(mysql_error());
	$row4=mysqli_fetch_assoc($rs4);
	$idOrden2=$row4['id_orden'];;
    $totalOrden=$row4['total_orden'];;


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
    //DATOS FACTURA
    $pdf->Cell(7);
    $pdf->Cell(30,7,"DATOS FACTURA ",0,1,'C',0);
        //FOLIO FACTURA
        $pdf->Cell(25);
        $pdf->Cell(30,7,"FOLIO FACTURA: ",0,0,'R',0);
        $pdf->SetFont('');
        $pdf->Cell(30,7, $idFac,0,1,'L',0);
        //FOLIO TICKET
        $pdf->SetFont('times','B', 12);
        $pdf->Cell(11);
        $pdf->Cell(30,7,"TICKET No. ",0,0,'R',0);
        $pdf->SetFont('');
        $pdf->Cell(30,7, $idTic,0,1,'L',0);
        //FOLIO ORDEN
        $pdf->SetFont('times','B', 12);
        $pdf->Cell(11);
        $pdf->Cell(30,7,"ORDEN No. ",0,0,'R',0);
        $pdf->SetFont('');
        $pdf->Cell(30,7, $idOrden2,0,1,'L',0);
        //FECHA
        $pdf->SetFont('times','B', 12);
        $pdf->Cell(5);
        $pdf->Cell(30,7,"FECHA: ",0,0,'R',0);
        $pdf->SetFont('');
        $pdf->Cell(30,7, $fechaActual,0,1,'L',0);
        //VENDEDOR
        $pdf->SetFont('times','B', 12);
        $pdf->Cell(14);
        $pdf->Cell(30,7,"VENDEDOR: ",0,0,'R',0);
        $pdf->SetFont('');
        $pdf->Cell(30,7, "CARLOS ESTRADA PORRAS",0,1,'L',0);
    
    // $pdf->Cell(10);
    $pdf->Cell(30,7,"------------------------------------------------------------------------------------------------------------------------------------",0,1,'L',0);
        
    $pdf->SetFont('times','B', 12);
    
    //DATOS CLIENTE
    $pdf->Cell(7);
    $pdf->Cell(30,7,"DATOS CLIENTE ",0,1,'C',0);
        //NOMBRE
        $pdf->Cell(14);
        $pdf->Cell(25,7,"NOMBRE: ",0,0,'R',0);
        $pdf->SetFont('');
        $pdf->Cell(30,7, $nombre,0,1,'L',0);
        //RFC
        $pdf->SetFont('times','B', 12);
        $pdf->Cell(14);
        $pdf->Cell(15,7,"RFC: ",0,0,'R',0);
        $pdf->SetFont('');
        $pdf->Cell(30,7, $rfc,0,1,'L',0);
        //CORREO
        $pdf->SetFont('times','B', 12);
        $pdf->Cell(9);
        $pdf->Cell(30,7,"CORREO: ",0,0,'R',0);
        $pdf->SetFont('');
        $pdf->Cell(30,7, "$correo",0,1,'L',0);
    
    $pdf->Cell(30,7,"------------------------------------------------------------------------------------------------------------------------------------",0,1,'L',0);

    $pdf->SetFont('times','B', 12);

    //PRODUCTOS
    $pdf->Cell(28);
    $pdf->Cell(10,10,"ID",0,0,'C',0);
    $pdf->Cell(60,10,"Nombre",0,0,'C',0);
    // $pdf->Cell(60,10,utf8_decode('Descripción'),0,0,'C',0);
    $pdf->Cell(20,10,"Precio",0,0,'C',0);
    $pdf->Cell(20,10,"Cantidad",0,0,'C',0);
    $pdf->Cell(30,10,"Total",0,1,'C',0);
    
    $pdf->SetFont('');
    
    if ($total_rows3>0){
            do{
                $pdf->Cell(28);
                $pdf->Cell(10,10, $row3["id_prod"],0,0,'C',0);
                $pdf->Cell(60,10, $row3["nombre_producto"],0,0,'C',0);
                $pdf->Cell(20,10, number_format($row3["precio_producto"],2),0,0,'C',0);
                $pdf->Cell(20,10, $row3["cantidad"],0,0,'C',0);
                $pdf->Cell(30,10, number_format($row3["total"],2),0,1,'C',0);
            }while ($row3 = mysqli_fetch_assoc($rs3) );
                    mysqli_free_result($rs3);
        }
    
    $pdf->Ln(5); 

    $pdf->Cell(30,7,"------------------------------------------------------------------------------------------------------------------------------------",0,1,'L',0);
    
    $pdf->SetFont('times','B', 12);
    $pdf->Cell(125);
    $pdf->Cell(30,7,"TOTAL A PAGAR: $",0,0,'R',0);
    $pdf->SetFont('');
    $pdf->Cell(30,7, number_format($totalOrden,2),0,1,'L',0);

    $pdf->SetFont('times','B', 14);
    $pdf->Ln(13); 
    $pdf->Cell(60);
    $pdf->Cell(70,5,utf8_decode('¡GRACIAS POR TU COMPRA!'),0,1,'C',0);

    $pdf->Output();
    // // $pdf->SetX(10);
                // $pdf->Multicell(60,10, $row3["descripcion_producto"],0);
                // $pdf->SetX(30);
                // $pdf->Multicell(20,10, number_format($row3["precio_producto"],2),0);
                // $pdf->SetX(60);
                // $pdf->Multicell(20,10, $row3["cantidad"],0);
                // $pdf->SetX(80);
                // $pdf->Multicell(30,10, number_format($row3["total"],2),0);
                // $pdf->Ln(); 
?>