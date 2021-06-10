<?php
session_start();
include_once("cabecera_Inicio.html");
?>

<!DOCTYPE html>
<html>
<head>
<title>Venta mostrador</title>
</head>
<body>
    
      <section class="inicio">
			<center><h1> Venta Mostrador</h1></center>
			<table style="width: 100%" cellspacing="40">
								<tr height="100px">
									<td align="center" bgcolor="#F0E68C"><a href="../../RestauranteArteaCliente/index.php"><h1>Tomar pedido</h1><i class="far fa-edit"></i><a></td>
									<td align="center" bgcolor="#87CEFA"><a href="Generar_Ticket.php"><h1>Generar ticket<h1><i class="far fa-file-alt"></i></a></td>
								  <td align="center" bgcolor="#F0E68C"><a href="Generar_Factura.php"><h1>Generar factura<h1><i class="far fa-clipboard"></i></a></td>
								</tr>
								<tr height="100px">
									<td align="center" bgcolor="#87CEFA"><a href="Consultar_Pedidos.php"><h1>Consular Pedidos<h1><i class="fas fa-archive"></i></a></td>
									<td></td>
									<td align="center" bgcolor="#87CEFA"><a href="Historial_Ventas.php"><h1>Historial ventas</h1><i class="fas fa-book-open"></i></a></td>
								</tr>
							</table>
		</section>
		
</body>
</html>
<?php
include_once("pie.html");
?>
