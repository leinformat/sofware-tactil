
<?php
	include 'plantilla_inv.php';
	
	require '../conexion.php';
	if (isset($_GET['imprimir_inv'])) {
		$query = "SELECT * FROM productos JOIN categorias WHERE productos.id_categoria = categorias.id_categoria AND productos.cantidad > 0 AND productos.id_categoria != 0 ORDER BY nombre_producto ASC";
		$resultado = $conexion->query($query);
		
		$pdf = new PDF('P','mm','Letter');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		
		
		$pdf->SetFont('Helvetica','',8);
		$n= 1;
		$suma =0;
		while($row = $resultado->fetch_assoc())
		{
			$codigo = $row['cod_producto'];

			barcode('cod_barras/' . $codigo . '.png', $codigo, 50, 'horizontal', 'code128', true);
		$pdf->Cell(11,11,$pdf->Image('cod_barras/'.$codigo.'.png',$pdf->GetX(), $pdf->GetY(),11 ),1);	
		}
		$pdf->SetFont('Helvetica','b',8);
		$pdf->Cell(150,6,'Total',1,0);
		$pdf->Cell(45,6,"$ ".number_format($suma),1,1,'C');
		$pdf->Output();
	}else{
		echo "Archivo Vacio";
	}
	
?>