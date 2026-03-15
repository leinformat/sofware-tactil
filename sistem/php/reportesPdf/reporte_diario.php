<?php
	include 'plantilla_inv.php';
	require '../conexion.php';
	if (isset($_GET['ventas_dia'])) {
		$query = "SELECT p.precio_compra, p.nombre_producto,sp.id_producto,sp.monto, sp.fecha_salida, SUM(sp.cantidad) cantidad_total, SUM((sp.cantidad * sp.monto)-(sp.cantidad * sp.monto * sp.desc_product / 100)) monto2 FROM salida_productos sp JOIN productos p WHERE sp.id_producto = p.id_producto AND sp.fecha_salida = '".$_GET['fecha']."' GROUP BY sp.id_producto ORDER BY sp.fecha_salida DESC";
		$resultado = $conexion->query($query);
		
		$pdf = new PDF('P','mm','Letter');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$n= 1;
		$suma1 =0;
		$suma2 =0;
		$suma3 =0;
		$suma =0;
		while($row = $resultado->fetch_assoc())
		{
			$pdf->SetX(15);
			$pdf->Cell(10,6,$n++,1,0,'C');
			$pdf->Cell(55,6,utf8_decode($row['nombre_producto']),1,0,'L');
			$pdf->Cell(15,6,number_format($row['cantidad_total']),1,0,'C');
			$pdf->Cell(20,6,number_format($row['precio_compra']),1,0,'C');
			$pdf->Cell(20,6,number_format($row['monto']),1,0,'C');
			$pdf->Cell(20,6,number_format($row['monto'] - $row['precio_compra']),1,0,'C');
			$pdf->Cell(20,6,number_format($tg_x_prod=($row['monto'] - $row['precio_compra'])*$row['cantidad_total']),1,0,'C');
			$pdf->Cell(25,6,"$".number_format($row['monto2']),1,1,'R');
			$suma3 += $row['precio_compra'] * $row['cantidad_total'];
			$suma1 += $row['monto2'];
			$suma2 += $tg_x_prod;
			$suma += $row['monto'];
		}
		$pdf->ln(3);
		$pdf->SetX(15);
		$pdf->SetFillColor(207,156,52);
		$pdf->SetFont('Helvetica','b',8);
		$pdf->Cell(155,6,utf8_decode('REPORTE DE GANANCIAS E INVERSION'),1,1,'C',1);
		
		$pdf->SetX(15);
		$pdf->SetFont('Helvetica','b',12);
		$pdf->Cell(80,6,utf8_decode('Total Ventas'),1,0);
		$pdf->SetTextColor(235,28,26);
		$pdf->Cell(75,6,"$".number_format($suma1),1,1,'C');
		$pdf->SetX(15);
		
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(80,6,utf8_decode('Total Ganancias'),1,0);
		$pdf->SetTextColor(235,28,26);
		$pdf->Cell(75,6,"$".number_format($suma1 - $suma3),1,1,'C');
		$pdf->SetX(15);
		
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(80,6,utf8_decode('Total Inversion'),1,0);
		$pdf->SetTextColor(235,28,26);
		$pdf->Cell(75,6,"$".number_format($suma3),1,1,'C');
		$pdf->SetTextColor(0,0,0);
		$pdf->Output();
	}else{
		echo "Archivo Vacio";
	}
	
?>