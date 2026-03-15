<?php
	include 'plantilla_compra.php';
	
	if (isset($_GET['imprimir_compra']) ) {

		//Optenemos los datos de las Facturas de Compra '../datos_fact_compra.php';		
		$pdf = new PDF('P','mm','Letter');
		$pdf->AliasNbPages();
		$pdf->AddPage();	
		$pdf->SetFont('Helvetica','',8);

		$n= 1;
		$suma =0;
		while($row = $list_productos->fetch_assoc())
			{
				$pdf->SetTextColor(0,0,0);
				$pdf->Cell(10,6,utf8_decode($row['cantidad']),1,0,'C');
				$pdf->Cell(125,6,utf8_decode($row['nombre_producto']." ".$row['cod_producto']),1,0,'L');
				$pdf->Cell(30,6,'$'.number_format($row['precio']),1,0,'C');
				$pdf->Cell(30,6,'$'.number_format($row['precio']*$row['cantidad']),1,1,'C');
				$suma += $row['precio'] * $row['cantidad'];
			}
		$pdf->SetFont('Helvetica','b',12);
		$pdf->Cell(165,6,'Total',1,0);
		$pdf->Cell(30,6,'$'.number_format($suma),1,1,'C');
		$pdf->Output();
	}
	else
	{
		echo "Archivo Vacio";
	}