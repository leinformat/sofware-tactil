<?php
	require 'fpdf/fpdf.php';
	require '../conexion.php';
	if (isset($_GET['imprimir'])) {
		$query = "SELECT * FROM consultas_vet CV INNER JOIN usuarios U,mascotas M, clientes C, estado_consultas EC, tipo_mascota TM, datos_empresa DE WHERE CV.id_usuario = U.id_usuario AND CV.id_pry_mascota= M.id_pry_mascota AND M.id_cliente = C.id_cliente AND CV.estado_consulta_mascota = EC.id_estado_consulta AND M.id_tipo_mascota = TM.id_tipo_mascota AND id_consulta_vet = '".$_GET['imprimir']."' ORDER BY  	CV.fecha_consulta_mascota DESC ";
		$resultado = $conexion->query($query);
		$row = $resultado->fetch_assoc();

		$pdf = new FPDF($orientation='L',$unit='mm', array(54,85.5));
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->setY(2);
		$pdf->setX(25);
		//////////CABECERA////////////////
		///////// Acho de la Hoja 48/////////
			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',8);
			$pdf->Image('../../../imagenes/huella.png', 1, 1, 84,52);
			$pdf->Ln();
		$pdf->setY(15);
		$pdf->setX(3);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Image('../../../imagenes/foto_carnet.png', 1, 1, 25,30);
			$pdf->ln(3);
			$pdf->setX(4);
			$pdf->Cell(19,6,utf8_decode('N° Id. Mascota:'),0,0);
			$pdf->SetFont('Helvetica','',7);
			$pdf->Cell(29,6,utf8_decode($row['id_mascota']),0,1);
			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(16,6,utf8_decode('Medico:'),0,0);
			$pdf->SetFont('Helvetica','',7);
			$pdf->Cell(32,6,utf8_decode($row['nombre_usu']),0,1,'L');
			$pdf->SetFont('Helvetica','B',7);
			
			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(16,6,utf8_decode('Tel. Medico:'),0,0);
			$pdf->SetFont('Helvetica','',7);
			$pdf->Cell(32,6,utf8_decode($row['telefono']),0,1,'L');
			
			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(16,6,'Cliente:',0,0);
			$pdf->SetFont('Helvetica','',7);
			$pdf->Cell(32,6,utf8_decode($row['nombre_cliente']),0,1,'L');

			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(16,6,utf8_decode('Tel. Cliente:'),0,0);
			$pdf->SetFont('Helvetica','',7);
			$pdf->Cell(32,6,utf8_decode($row['tel_cliente']),0,1,'L');

			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(24,6,utf8_decode('Feche de Ingreso:'),0,0,'L');
			$pdf->SetFont('Helvetica','',7);
			$pdf->Cell(24,6,utf8_decode($row['fecha_consulta_mascota']),0,1,'L');

			if (isset($_GET['estado']))
				{
					$pdf->setX(4);
					$pdf->SetFont('Helvetica','B',7);
					$pdf->Cell(24,6,utf8_decode('Feche de Egreso:'),0,0,'L');
					$pdf->SetFont('Helvetica','',7);
					$pdf->Cell(24,6,utf8_decode($row['fecha_alta_medica']),0,1,'L');
				}

			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(24,6,utf8_decode('Nombre Mascota:'),0,0,'L');
			$pdf->SetFont('Helvetica','',7);
			$pdf->Cell(24,6,utf8_decode($row['nombre_mascota']),0,1,'L');

			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(8,6,utf8_decode('Tipo:'),0,0,'L');
			$pdf->SetFont('Helvetica','',7);
			$pdf->Cell(20,6,utf8_decode($row['nombre_tipo_mascota']),0,1,'L');
			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(8,6,utf8_decode('Raza:'),0,0,'L');
			$pdf->SetFont('Helvetica','',7);
			$pdf->Cell(20,6,utf8_decode($row['raza_mascota']),0,1,'L');

			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(8,6,utf8_decode('Sexo:'),0,0,'L');
			$pdf->SetFont('Helvetica','',7);
			$pdf->Cell(20,6,utf8_decode($row['sexo_mascota']),0,1,'L');

			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(48,6,utf8_decode('Sintomas:'),0,1,'L');
			$pdf->SetFont('Helvetica','',7);
			$pdf->setX(4);
			$pdf->MultiCell(48,4,utf8_decode($row['sintomas_mascota']),0,'L');

			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(48,6,utf8_decode('Observaciones:'),0,1,'L');
			$pdf->setX(4);
			$pdf->SetFont('Helvetica','',7);
			$pdf->MultiCell(48,4,utf8_decode($row['observaciones_mascota']),0,'L');

			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(48,6,utf8_decode('Diagnostico:'),0,1,'L');
			$pdf->SetFont('Helvetica','',7);
			$pdf->setX(4);
			$pdf->MultiCell(48,4,utf8_decode($row['diagnostico_mascota']),0,'L');

			$pdf->setX(4);
			$pdf->SetFont('Helvetica','B',7);
			$pdf->Cell(48,6,utf8_decode('Formula Medica:'),0,1,'L');
			$pdf->SetFont('Helvetica','',7);
			$pdf->setX(4);
			$pdf->MultiCell(48,4,utf8_decode($row['formula_medica_mascota']),0,'L');
			$pdf->ln(6);

			$pdf->SetFont('Helvetica','B',6);
			$pdf->setX(2);
			$pdf->Cell(51,3,utf8_decode($row['direccion_empresa']),0,1,'C');
			$pdf->setX(2);
			$pdf->Cell(51,3,utf8_decode($row['telefono_empresa']),0,1,'C');
			$pdf->setX(2);
			$pdf->Cell(51,3,utf8_decode($row['email_empresa']),0,1,'C');
			$pdf->ln(1);
			$pdf->setX(3);
			$pdf->SetFont('Helvetica','',12);
			$pdf->Cell(51,3,utf8_decode(' -  -  -  -  -  -  -  -   -   -   -  '),0,1,'C');
			$pdf->ln(3);
			$pdf->setX(2);
			$pdf->MultiCell(49,4,utf8_decode('NUMERO DE CONSULTA'),0,'C');
			$pdf->SetFont('Helvetica','',14);
			$pdf->ln(3);
			$pdf->setX(2);
			$pdf->Cell(51,6,'#'.str_pad($row['id_consulta_vet'], 4,"0", STR_PAD_LEFT),0,1,'C');
			$pdf->ln(3);
		$pdf->Output();
	}else{
		echo "Archivo Vacio";
	}
