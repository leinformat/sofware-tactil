<?php
	require 'fpdf/fpdf.php';
	require '../datos_empresa.php';

	if (isset($_GET['imprimir'])) 
	{
		if (isset($_GET['entregado']))
			{
				$query = "SELECT * FROM servicio_tec ST INNER JOIN usuarios U,clientes C,tipo_servicio_tec TS, estatus E WHERE ST.id_usuario = U.id_usuario AND ST.id_cliente= C.id_cliente AND ST.id_tipo_serv = TS.id_tipo_ser AND ST.estatus = E.id_estatus AND ST.id_servicio = '".$_GET['imprimir']."' AND E.id_estatus = 3 ORDER BY id_servicio DESC ";
					$resultado = $conexion->query($query);
			}else{
				$query = "SELECT * FROM servicio_tec ST INNER JOIN usuarios U,clientes C,tipo_servicio_tec TS, estatus E WHERE ST.id_usuario = U.id_usuario AND ST.id_cliente= C.id_cliente AND ST.id_tipo_serv = TS.id_tipo_ser AND ST.estatus = E.id_estatus AND ST.id_servicio = '".$_GET['imprimir']."' AND E.id_estatus < 3 ORDER BY id_servicio DESC ";
					$resultado = $conexion->query($query);
			}	
		$pdf = new FPDF($orientation='P',$unit='mm', array(216,216));
		$pdf->AliasNbPages();
		$pdf->SetTopMargin(0);
		$pdf->AddPage();
		
		//////////CABECERA////////////////
			$pdf->SetFont('Helvetica','B',8);
			$pdf->Image('../../../imagenes/'.$GLOBALS['logo_empresa'], 1, 2, 110,29 );
			$pdf->Ln(31);
			$pdf->setXY(39,22);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell(69,6,utf8_decode('NIT. '.$GLOBALS['nit_empresa'].'-0'),0,1);

			$pdf->SetFont('Helvetica','B',6);
			$pdf->setXY(119,11);
			$pdf->SetTextColor(33,33,33);
			$pdf->SetFillColor(223,81,58);
			$pdf->MultiCell(90,4,utf8_decode($GLOBALS['descripcion_empresa']),0,'L',0);
			$pdf->ln(7);
			$pdf->SetTextColor(0,0,0);
		$row = $resultado->fetch_assoc();
			$pdf->setX(4);

	// ------------INFORMACION DEL SERVICIO TECNICO------------------ //

			// FECHA DE RECEPCION
			$pdf->SetFont('Helvetica','B',10);
			$pdf->Cell(69,6,utf8_decode('Fecha de Recepción:'."  ". utf8_decode($row['fecha_serv'])),1,0);

			// STATUS DEL SERVICIO
			$pdf->Cell(68,6,utf8_decode('Estado del Servicio:'."  ".utf8_decode($row['nombre_status'])),1,0);
			
			// NUMERO DE REPORTE
			$pdf->Cell(68,6,utf8_decode('No. Reporte:'."  ".str_pad($row['id_servicio'], 4,"0", STR_PAD_LEFT)),1,1);

			$pdf->setX(4);
			// ABONÓ "$".number_format($row['monto']*$row['cantidad'])
			$pdf->SetFont('Helvetica','B',10);
			$pdf->Cell(69,6,utf8_decode('El Cliente abonó:'."  $". number_format($row['abono'])),1,0);

			// STATUS DEL SERVICIO
			$pdf->Cell(68,6,utf8_decode('Monto del Servicio:'."  $".number_format($row['monto_total'])),1,0);
			
			// NUMERO DE REPOSTE
			$pdf->Cell(68,6,utf8_decode('Pendiente por Pagar:'."  $".number_format($row['monto_total'] - $row['abono'])),1,1);
			
	// ------------INFORMACIO DEL TECNICO------------------ //	
			$pdf->SetTextColor(255,255,255);
			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',11);
			$pdf->Cell(205,6,utf8_decode('DATOS DEL TÉCNICO ENCARGADO'),1,1,'C',1);
			$pdf->setX(4);

			// NOMBRE DEL TECNICO
			$pdf->SetTextColor(33,33,33);
			$pdf->SetFont('Helvetica','B',10);
			$pdf->Cell(103,6,utf8_decode('Nombre:'."  ". utf8_decode($row['nombre_usu'])),1,0);

			// TELEFONO DEL TECNICO
			$pdf->Cell(102,6,utf8_decode('Teléfono:'."  ".utf8_decode($row['telefono'])),1,1);

	// ------------INFORMACION DEL CLIENTE------------------ //
			$pdf->SetTextColor(255,255,255);
			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',11);
			$pdf->Cell(205,6,utf8_decode('DATOS DEL CLIENTE'),1,1,'C',1);
			$pdf->setX(4);

			// NOMBRE DEL CLIENTE
			$pdf->SetTextColor(33,33,33);
			$pdf->SetFont('Helvetica','B',10);
			$pdf->Cell(70,6,utf8_decode('Nombre:'."  ".$row['nombre_cliente']),1,0);

			// CEDULA DEL CLIENTE
			$pdf->Cell(67,6,utf8_decode('Nit y/o CI:'."  ".$row['nit_cliente']),1,0);
			
			// TELEFONO DEL CLIENTE
			$pdf->Cell(68,6,utf8_decode('Teléfono:'."  ".$row['tel_cliente']),1,1);
			
	// ------------DETALLE DEL SERVICO TECNICO------------------ //
			$pdf->SetTextColor(255,255,255);
			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',11);
			$pdf->Cell(205,6,utf8_decode('DESCRIPCIÓN DEL SERVICIO TÉCNICO'),1,1,'C',1);

			// EQUIPO
			$pdf->SetTextColor(33,33,33);
			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',10);
			$pdf->Cell(205,6,utf8_decode('Equipo:'."  ". $row['equipo_st']),1,1);

			// DESCRIPCION
			$pdf->setX(4);
			$pdf->MultiCell(205,6,utf8_decode('Descripcion:'."  ".$row['descripcion']),1,'J');
			
			// PIE DE PAGINA
			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',12);
			$pdf->Cell(205,7,utf8_decode("NO NOS HACEMOS RESPONSABLES POR EQUIPOS DEJADOS DESPUES DE 30 DÍAS"),1,1,'C');

			$pdf->Image('../../../imagenes/tijera.png', 5, Null, 4,8 );
			$pdf->ln(-7.1);
			$pdf->SetFont('Helvetica','B',12);
			$pdf->Cell(21,6,utf8_decode('--------------------------------------------------------------------------------------------------------------------------------------------'),0,0);
			$pdf->ln(6.5);		

			$pdf->setX(4);
			// NUMERO DE REPORTE
			$pdf->Cell(68,6,utf8_decode('Nro. Reporte:'."  ".str_pad($row['id_servicio'], 4,"0", STR_PAD_LEFT)),1,0);

			// NUMERO DE REPORTE
			$pdf->Cell(69,6,utf8_decode('Nro. Reporte:'."  ".str_pad($row['id_servicio'], 4,"0", STR_PAD_LEFT)),1,0);
			
			// NUMERO DE REPORTE
			$pdf->Cell(68,6,utf8_decode('Nro. Reporte:'."  ".str_pad($row['id_servicio'], 4,"0", STR_PAD_LEFT)),1,1);

			$pdf->setX(4);
			// NOMBRE CLIENTE
			$pdf->Cell(68,6,utf8_decode('cliente:'." ".$row['nombre_cliente']),1,0);

			// NOMBRE CLIENTE
			$pdf->Cell(69,6,utf8_decode('cliente:'." ".$row['nombre_cliente']),1,0);
			
			// NOMBRE CLIENTE
			$pdf->Cell(68,6,utf8_decode('cliente:'." ".$row['nombre_cliente']),1,1);

			$pdf->setX(4);
			// TELEFONO CLIENTE
			$pdf->Cell(68,6,utf8_decode('Tel.Cliente:'." ".$row['tel_cliente']),1,0);

			// TELEFONO CLIENTE
			$pdf->Cell(69,6,utf8_decode('Tel.Cliente:'." ".$row['tel_cliente']),1,0);
			
			// TELEFONO CLIENTE
			$pdf->Cell(68,6,utf8_decode('Tel.Cliente:'." ".$row['tel_cliente']),1,1);
			$pdf->SetFont('Helvetica','B',10);
			$pdf->setX(4);
			// EQUIPO CLIENTE
			$pdf->Cell(68,6,utf8_decode('Equipo:'." ".$row['equipo_st']),1,0);

			// EQUIPO CLIENTE
			$pdf->Cell(69,6,utf8_decode('Equipo:'." ".$row['equipo_st']),1,0);
			
			// EQUIPO CLIENTE
			$pdf->Cell(68,6,utf8_decode('Equipo:'." ".$row['equipo_st']),1,0);
			$nReporte = str_pad($row['id_servicio'], 4,"0", STR_PAD_LEFT);
		$pdf->Output('', "Equipo #$nReporte.pdf");
	}else{
		echo "Archivo Vacio";
	}