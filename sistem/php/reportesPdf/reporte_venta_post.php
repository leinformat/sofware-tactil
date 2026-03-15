<?php 
	include 'plantilla_venta_post.php';
	if (isset($_GET['imprimir_venta']) || isset($_GET['imprimir_venta2']) ) 
	{
		$pdf = new PDF($orientation='P',$unit='mm', array(54,550));
		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		$pdf->SetFont('times','',7);
		$suma =0;
		$cantidad=0;

		$descuento =0;
		$totalDesc = 0;

		$descuento =0;
		$totalDesc = 0;
		while($row = $list_productos->fetch_assoc())
		{
			$pdf->SetX(0);
			// Nombre de Producto
			$pdf->MultiCell(20,4,utf8_decode($row['nombre_producto']),0,'L');

			// Precio Unitario del producto
			$pdf->Cell(20, -4, "$".number_format($row['monto']),0,0,'R');
			
			// Cantidad 
			$pdf->Cell(6, -4,utf8_decode($row['cantidad']),0,0,'C');

			// Total cantidad por precio unitario
			$pdf->Cell(12,-4,"$".number_format($row['monto']*$row['cantidad']),0,0,'L');

			$pdf->Ln(3);

			// Calculos
			$descuento = ($row['monto'] * $row['cantidad']) * $row['desc_product'] / 100;
			$totalDesc += $descuento;

			$cantidad += $row['cantidad'];
			$suma += $row['monto'] * $row['cantidad'];
		}
		$pdf->Ln(5);
		$pdf->SetX(0);
		$pdf->SetFont('times','',9);
		$pdf->Cell(86,4,utf8_decode("Articulos y/o Servicios:   ").$cantidad,0,1,'L');
		$pdf->SetX(0);
		$pdf->SetFont('times','',9);
		$pdf->Cell(86,4,utf8_decode("Descuento:   ").'$'.$totalDesc,0,1,'L');
		$pdf->Ln();
		$pdf->SetX(0);
		$pdf->SetFont('times','B',10);
		$pdf->Cell(12,4,'Sub Total',0,0);
		$pdf->Cell(36,4,"$".number_format($suma),0,1,'R');
		$pdf->Ln(3);
		$pdf->SetX(0);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(12,4,'Total',0,0);
		$pdf->Cell(36,4,"$".number_format($suma - $totalDesc),0,1,'R');
		$pdf->Ln(10);
		$pdf->SetX(0);
		$pdf->SetFont('times','',9);
		$pdf->Cell(50,4,"------ GRACIAS POR SU COMPRA ------",0,1,'C');
		
		
		$pdf->Output();
	}
	else
		{
		  echo "Archivo Vacio";
	}