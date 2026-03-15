<?php
	include 'plantilla_venta.php';
	if (isset($_GET['imprimir_venta']) || isset($_GET['imprimir_venta2']) ) 
	{
		$pdf = new PDF('P','mm','Letter');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		$pdf->SetFont('Helvetica','',10);

		$n= 1;
		$suma =0;
		$iva = 0;
		$descuento =0;
		$totalDesc = 0;
		$total_iva = 0;
		
		while($row = $list_productos->fetch_assoc())
		{
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(10,6,utf8_decode($row['cantidad']),1,0,'C');
			$pdf->Cell(110,6,utf8_decode($row['nombre_producto'])." ".utf8_decode($row['cod_producto']),1,0,'L');
			$pdf->Cell(25,6,'$'.number_format($row['monto']),1,0,'C');
			$pdf->Cell(25,6,number_format($row['iva_producto']).'%',1,0,'C');
			$pdf->Cell(25,6,'$'.number_format($row['monto']*$row['cantidad']),1,1,'C');
			
			$descuento = ($row['monto'] * $row['cantidad']) * $row['desc_product'] / 100;

			$montoDescuento = ($row['monto'] * $row['cantidad']) - ($row['monto'] * $row['cantidad'] * $row['desc_product'] / 100);
			
			$totalDesc += $descuento;
			$suma += $montoDescuento;
			
			$iva = ($row['monto']*$row['cantidad'])*$row['iva_producto'] / 100;
			$total_iva+=$iva;
		}
		
		$pdf->SetFont('Helvetica','b',10);
		$pdf->SetTextColor(0,0,0);
		$pdf->Ln(2);
		$pdf->MultiCell(120,5,utf8_decode("Esta factura por si sola surte los efectos de título valor, en razón del cumplimiento de lo establecido en la ley 1231 de 2008, estatuto tributario, código de comercio y demás normas."),0,'J',0);
		$pdf->Ln(-17);
		$pdf->SetFont('Helvetica','b',11);
		$pdf->SetTextColor(255,0,0);
		$pdf->SetX(130);
		$pdf->Cell(25,6,'SUBTOTAL',1,0);

		$pdf->Cell(50,6,'$'.number_format($suma),1,1,'R');
		$pdf->SetX(130);
		$pdf->Cell(25,6,'DESC',1,0);
		$pdf->Cell(50,6,'$'.number_format($totalDesc),1,1,'R');
		$pdf->SetX(130);
		$pdf->Cell(25,6,'IVA',1,0);
		
		$pdf->Cell(50,6,'$'.number_format($total_iva),1,1,'R');
		$pdf->SetX(130);
		$pdf->Cell(25,6,'TOTAL',1,0);
		$pdf->Cell(50,6,'$'.number_format($suma + $total_iva),1,1,'R');
		$pdf->Ln(10);
		$pdf->SetFont('Helvetica','b',11);
		$pdf->SetTextColor(0,0,0);
		$pdf->Image('../../../imagenes/FIRMA.png',15,NULL,45,15);
		$pdf->Ln(-5);
		
		$pdf->SetX(128);
		$pdf->Cell(30,6,'ACEPTADA',0,0);
		$pdf->Ln();
		$pdf->SetX(3);
		$pdf->Cell(135,2,'           ________________________________                  ___________________________________',0,1);
		$pdf->SetFont('Helvetica','B',9);
		$pdf->Cell(135,6,utf8_decode('      Vendedor.                                                                                   Recibí Conforme.'),0,0);
		
		$pdf->Output('', "factura#$GLOBALS[num_fact].pdf");
	}
	else
		{
		  echo "Archivo Vacio";
	}