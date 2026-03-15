<?php 
	include 'plantilla_venta_post.php';
	if (isset($_GET['imprimir_venta']) || isset($_GET['imprimir_venta2']) ) 
	{
		$pdf = new PDF($orientation='P',$unit='mm', array(86,550));
		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		$pdf->SetFont('times','',8);
		$suma =0;
		$cantidad=0;
		while($row = $list_productos->fetch_assoc())
		{
			$pdf->SetX(1.5);
			$pdf->Cell(38,5,utf8_decode($row['nombre_producto'])." ".utf8_decode($row['cod_producto']),0,0,'L');
			$pdf->Cell(19,5,"$".number_format($row['monto']),0,0,'L');
			$pdf->Cell(8,5,utf8_decode($row['cantidad']),0,0,'L');
			$pdf->Cell(16,5,"$".number_format($row['monto']*$row['cantidad']),0,1,'L');
			$cantidad += $row['cantidad'];
			$suma += $row['monto'] * $row['cantidad'];
		}
		$pdf->Ln();
		$pdf->SetX(1.5);
		$pdf->SetFont('times','',10);
		$pdf->Cell(86,4,utf8_decode("Articulos y/o Servicios:   ").$cantidad,0,1,'L');
		$pdf->Ln();
		$pdf->SetX(1.5);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(21,4,'Total',0,0);
		$pdf->Cell(60,4,"$".number_format($suma),0,1,'R');
		$pdf->Ln(10);
		$pdf->SetX(1.5);
		$pdf->SetFont('times','',11);
		$pdf->Cell(80,4,"----------- GRACIAS POR SU COMPRA -----------",0,1,'C');
		
		
		$pdf->Output();
	}
	else
		{
		  echo "Archivo Vacio";
		}