<?php
	include 'plantilla_planilla.php';
	require '../conexion.php';
	if (isset($_GET['imprimir_planilla']) || isset($_GET['imprimir_planilla2']) ) {
		if (isset($_GET['imprimir_planilla'])) {
			$query = "SELECT sp.cantidad, sp.monto, sp.fecha_salida, p.nombre_producto, p.cod_producto, c.nombre_cliente, c.nit_cliente, c.dir_cliente, c.tel_cliente FROM salida_planillas sp JOIN clientes c, productos p  WHERE sp.id_producto= p.id_producto AND sp.id_cliente = c.id_cliente AND sp.id_cliente = '".$_GET['id_cliente']."' ORDER BY p.nombre_producto ASC";
		}else{
			$query = 'SELECT * FROM productos  JOIN salida_productos, clientes  WHERE salida_productos.id_producto = productos.id_producto AND clientes.id_cliente = salida_productos.nombre_fact  AND salida_productos.numero_fact = "'.$_GET['num_fact'].'" ';
		}
		
		$list_productos = $conexion->query($query);
		$datos_cliente = $conexion->query($query);
		
		$pdf = new PDF('P','mm','Letter');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Helvetica','B',10);
		$num_fact = 0;
		$nombre=0;
		$nit =0;
		$direccion = 0;
		$telefono =0;
		$fecha =0;
		while ($row=$datos_cliente->fetch_assoc()){
			$nombre= $row["nombre_cliente"];
			$nit= $row["nit_cliente"];
			$direccion= $row["dir_cliente"];
			$telefono= $row["tel_cliente"];
			$cod_producto= $row["cod_producto"];
		}
		$pdf->SetTextColor(235,28,26);
		$pdf->SetFont('Helvetica','B',16);
		
		$pdf->SetXY(161,48);
		if (isset($_GET['imprimir_venta2'])) {
			$pdf->Cell(44,8,date($fecha),1,0,'C');
		}else{
			$pdf->Cell(44,8,date('Y-m-d'),1,0,'C');
		}
		$pdf->Ln(11);
		$pdf->SetFont('Helvetica','B',12);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(145,6,utf8_decode("Señor: ".$nombre),1,0,'L');
		$pdf->Cell(50,6,utf8_decode("Nit: ".$nit),1,1,'L');
		$pdf->Cell(160,6,utf8_decode("Dirección: ".$direccion),1,0,'L');
		$pdf->Cell(35,6,utf8_decode("Tel: ".$telefono),1,1,'L');
		$pdf->Ln(2);
		$pdf->SetFillColor(235,28,26);
		$pdf->SetFont('Helvetica','B',8);
		$pdf->SetTextColor(240,240,240);
		$pdf->Cell(10,6,'CANT.',1,0,'C',1);
		$pdf->Cell(125,6,'DESCRIPCION',1,0,'C',1);
		$pdf->Cell(30,6,'VALOR UNITARIO',1,0,'C',1);
		$pdf->Cell(30,6,'VALOR TOTAL',1,1,'C',1);
		$pdf->SetFont('Helvetica','',8);

		$n= 1;
		$suma =0;
		while($row = $list_productos->fetch_assoc())
		{
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(10,6,utf8_decode($row['cantidad']),1,0,'C');
			$pdf->Cell(125,6,utf8_decode($row['nombre_producto'])." ".utf8_decode($row['cod_producto']),1,0,'L');
			$pdf->Cell(30,6,number_format($row['monto'],2).'$',1,0,'C');
			$pdf->Cell(30,6,number_format($row['monto']*$row['cantidad'],2).'$',1,1,'C');
			$suma += $row['monto'] * $row['cantidad'];
		}
		$pdf->SetFont('Helvetica','b',8);
		$pdf->SetX(145);
		$pdf->Cell(30,6,'SUB - TOTAL',1,0);
		$pdf->Cell(30,6,number_format($suma, 2)."$",1,1,'C');
		//$pdf->SetX(10);
		$pdf->Cell(135,6,'       ________________________________                  ___________________________________',0,0);
		$pdf->Cell(30,6,'RET - 6%',1,0);
		$pdf->Cell(30,6,number_format($suma*0.06, 2)."$",1,1,'C');
		
		$pdf->SetFont('Helvetica','B',9);
		$pdf->Cell(135,6,utf8_decode('      Vendedor.                                                        Recibí Conforme.'),0,0);
		$pdf->SetTextColor(255,0,0);
		$pdf->Cell(30,6,'TOTAL',1,0);
		$pdf->Cell(30,6,number_format($suma-$suma*0.06, 2)."$",1,1,'C');
		$pdf->SetTextColor(0,0,0);
		$pdf->Output();
	}else{
		echo "Archivo Vacio";
	}
	
?>