<?php 
	require 'fpdf/fpdf.php';
	require '../conexion.php';
	if (isset($_GET['imprimir_carnet'])) {
		$query = "SELECT * FROM mascotas M INNER JOIN usuarios U, clientes C, tipo_mascota TM, datos_empresa DE WHERE M.id_tipo_mascota = TM.id_tipo_mascota AND M.id_cliente = C.id_cliente AND U.nombre_usu = '".$_GET['usuario']."' AND id_pry_mascota = '".$_GET['imprimir_carnet']."' ";
		$resultado = $conexion->query($query);
		$row = $resultado->fetch_assoc();

		$pdf = new FPDF($orientation='L',$unit='cm', array(17,26));
		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		//////////CABECERA////////////////
		///////// Acho de la Hoja 26cm/////////
			$pdf->Image('../../../imagenes/carnet1.jpg', 0, 0, 26,15 );
			$pdf->SetFont('Helvetica','',12);
			$pdf->setXY(15.3,9.9);
			$pdf->Cell(2,1,utf8_decode($row['nombre_mascota']),0,0);
			$pdf->setXY(21.5,9.9);
			$pdf->Cell(2,1,utf8_decode($row['nombre_tipo_mascota']),0,0);
			$pdf->setXY(21.5,10.8);
			$pdf->Cell(2,1,utf8_decode($row['sexo_mascota']),0,0);
			$pdf->setXY(15.3,10.8);
			$pdf->Cell(2,1,utf8_decode($row['raza_mascota']),0,0);
			$pdf->setXY(15.3,11.6);
			$pdf->Cell(2,1,utf8_decode($row['color_mascota']),0,0);
			$pdf->setXY(22.5,11.6);
			$pdf->Cell(2,1,utf8_decode($row['fecha_nac_mascota']),0,0);
			$pdf->setXY(15.3,13.68);
			$pdf->Cell(2,1,utf8_decode($row['nombre_cliente']),0,0);
			$pdf->setXY(21.6,13.68);
			$pdf->Cell(2,1,utf8_decode($row['tel_cliente']),0,0);
			
			$pdf->AddPage();
			$pdf->Image('../../../imagenes/carnet2.jpg', 0, 0, 26,15 );
		$pdf->Output();
	}else{
		echo "Archivo Vacio";
	}
