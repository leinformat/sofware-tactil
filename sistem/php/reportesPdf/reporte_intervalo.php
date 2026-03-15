<?php
	include 'plantilla_inv.php';
	require '../conexion.php';
	if (isset($_GET['rep_intervalo'])) {
		$query = "SELECT p.precio_compra, p.nombre_producto,sp.id_producto,sp.monto, sp.fecha_salida, SUM(sp.cantidad) cantidad_total, SUM((sp.cantidad * sp.monto)-(sp.cantidad * sp.monto * sp.desc_product / 100)) monto2 FROM salida_productos sp JOIN productos p WHERE sp.id_producto = p.id_producto AND sp.fecha_salida BETWEEN '".$_POST['desde']."' AND '".$_POST['hasta']."' GROUP BY sp.id_producto HAVING COUNT(*)>=1 ORDER BY p.nombre_producto ASC";
		$query2 = "SELECT G.id_tipo_gasto, G.fecha_gasto, G.monto_gasto, G.descripcion_gasto, CG.nombre_cat_gasto FROM gastos G JOIN categoria_gastos CG WHERE G.id_tipo_gasto = CG.id_cat_gasto AND G.fecha_gasto BETWEEN '".$_POST['desde']."' AND '".$_POST['hasta']."' GROUP BY G.descripcion_gasto HAVING COUNT(*)>=1 ORDER BY G.fecha_gasto ASC";
		$resultado = $conexion->query($query);
		$gastos = $conexion->query($query2);
		$pdf = new PDF('P','mm','Letter');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetX(15);
		$pdf->SetFillColor(207,156,52);
		$pdf->SetFont('Helvetica','B',10);
		$pdf->Cell(185,6,'INGRESOS',1,1,'C',1);
		$pdf->SetFont('Helvetica','B',8);
		$pdf->SetX(15);
		$pdf->Cell(10,6,'#',1,0,'C',1);
		$pdf->Cell(55,6,utf8_decode('Nombre de Producto'),1,0,'C',1);
		$pdf->Cell(15,6,utf8_decode('Cant.'),1,0,'C',1);
		$pdf->Cell(20,6,utf8_decode('Vr. Compra'),1,0,'C',1);
		$pdf->Cell(20,6,utf8_decode('Vr. Venta'),1,0,'C',1);
		$pdf->Cell(20,6,utf8_decode('G.x Prod.'),1,0,'C',1);
		$pdf->Cell(20,6,utf8_decode('TG.x Prod.'),1,0,'C',1);
		$pdf->Cell(25,6,utf8_decode('M.Neto x Prod'),1,1,'C',1);
		$pdf->SetFont('Helvetica','',8);
		$n= 1;
		$x= 1;
		$suma1 =0;
		$suma2 =0;
		$suma3 =0;
		$suma =0;
		$total_gastos = 0;
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
		$pdf->ln(5);
		$pdf->SetX(15);
		$pdf->SetFillColor(207,156,52);
		$pdf->SetFont('Helvetica','B',10);
		$pdf->Cell(185,6,'GASTOS',1,1,'C',1);
		$pdf->SetFont('Helvetica','B',8);
		$pdf->SetX(15);
		$pdf->Cell(10,6,'#',1,0,'C',1);
		$pdf->Cell(70,6,utf8_decode('Tipo'),1,0,'C',1);
		$pdf->Cell(23,6,utf8_decode('Fecha.'),1,0,'C',1);
		$pdf->Cell(20,6,utf8_decode('Monto'),1,0,'C',1);
		$pdf->Cell(62,6,utf8_decode('Descripcion'),1,1,'C',1);

		while($row2 = $gastos->fetch_assoc())
		{
			$pdf->SetX(15);
			$pdf->Cell(10,6,$x++,1,0,'C');
			$pdf->Cell(70,6,utf8_decode($row2['nombre_cat_gasto']),1,0,'C');
			$pdf->Cell(23,6,utf8_decode($row2['fecha_gasto']),1,0,'C');
			$pdf->Cell(20,6,"$".number_format($row2['monto_gasto']),1,0,'C');
			$pdf->Cell(62,6,utf8_decode($row2['descripcion_gasto']),1,1,'C');
			$total_gastos += $row2['monto_gasto'];	
		}

		$pdf->ln(10);
		$pdf->SetX(15);
		$pdf->SetFillColor(207,156,52);
		$pdf->SetFont('Helvetica','b',8);
		$pdf->Cell(155,6,utf8_decode('REPORTE DE GANANCIAS E INVERSION'),1,1,'C',1);
		
		//Ventas (Representa el total de las ventas)
		$pdf->SetX(15);
		$pdf->SetFont('Helvetica','b',12);
		$pdf->Cell(80,6,utf8_decode('Ventas'),1,0);
		$pdf->SetTextColor(235,28,26);
		$pdf->Cell(75,6,"$".number_format($suma1),1,1,'L');
		$pdf->SetX(15);
		
		//Costo de Ventas (Representa el total de la inversion)
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(80,6,utf8_decode('Costo de Ventas'),1,0);
		$pdf->SetTextColor(235,28,26);
		$pdf->Cell(75,6,"$".number_format($suma3),1,1,'L');

		//Utilidad Bruta (Representa las ganancias = Ventas - Costo de ventas)
		$pdf->SetX(15);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(80,6,utf8_decode('Utilidad Bruta'),1,0);
		$pdf->SetTextColor(235,28,26);
		$pdf->Cell(75,6,"$".number_format($suma1 - $suma3),1,1,'R');

		//Gastos de Operacion (Representa el total de los Gastos)
		$pdf->SetX(15);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(80,6,utf8_decode('Gastos Generales'),1,0);
		$pdf->SetTextColor(235,28,26);
		$pdf->Cell(75,6,"$".number_format($total_gastos),1,1,'L');

		$utilida_bruta = $suma1 - $suma3;
		$utilidad_de_operacion = $utilida_bruta - $total_gastos;

		//Utilidad Bruta (Representa el monto total = Utilidad bruta - gastos generales)
		$pdf->SetX(15);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(80,6,utf8_decode('UTILIDAD DE OPERACIÓN'),1,0);
		$pdf->SetTextColor(235,28,26);
		$pdf->Cell(75,6,"$".number_format($utilidad_de_operacion),1,1,'R');

		//TOTAL EN CAJA (Representa el total en caja =  total de ventas -  los gastos generales)
		$pdf->SetX(15);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(80,6,utf8_decode('TOTAL EN CAJA'),1,0);
		$pdf->SetTextColor(235,28,26);
		$pdf->Cell(75,6,"$".number_format($suma1-$total_gastos),1,1,'l');

		$pdf->SetTextColor(0,0,0);
		$pdf->Output();
	}else{
		echo "Archivo Vacio";
	}
	
?>