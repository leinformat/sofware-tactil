<?php
	include 'plantilla_inv.php';
	require '../conexion.php';
	if (isset($_GET['imprimir_inv'])) {
		$query = "SELECT P.id_producto, P.cod_producto, P.nombre_producto, C.nombre_cat, P.cantidad, P.precio_compra, P.precio_unid FROM productos P JOIN categorias C WHERE P.id_categoria = C.id_categoria AND P.cantidad > 0 AND C.nombre_cat NOT LIKE '%servicio%' AND P.estado_producto = 1 ORDER BY P.nombre_producto ASC";
		$resultado = $conexion->query($query);
		
		$pdf = new PDF('P','mm','Letter');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		
		
		$pdf->SetFont('Helvetica','',8);
		$n= 1;
		$suma =0;
		while($row = $resultado->fetch_assoc())
		{
			$pdf->Cell(10,6,$n++,1,0,'C');
			$pdf->Cell(20,6,utf8_decode($row['cod_producto']),1,0,'C');
			$pdf->Cell(70,6,utf8_decode($row['nombre_producto']),1,0,'L');
			$pdf->Cell(30,6,utf8_decode($row['nombre_cat']),1,0,'C');
			$pdf->Cell(20,6,number_format($row['cantidad']),1,0,'C');
			$pdf->Cell(22,6,"$ ".number_format($row['precio_unid']),1,0,'R');
			$pdf->Cell(23,6,"$ ".number_format($row['precio_unid'] * $row['cantidad']),1,1,'R');
			$suma += $row['precio_unid'] * $row['cantidad'];
		}
		$pdf->SetFont('Helvetica','b',8);
		$pdf->Cell(150,6,'Total',1,0);
		$pdf->Cell(45,6,"$ ".number_format($suma),1,1,'C');
		$pdf->Output();
	}else{
		echo "Archivo Vacio";
	}
	
?>