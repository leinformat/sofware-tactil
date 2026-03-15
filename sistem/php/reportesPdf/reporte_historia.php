<?php 

	require '../conexion.php';
	$historia_med=mysqli_query($conexion, "SELECT id_pry_mascota FROM consultas_vet WHERE id_pry_mascota = '".$_GET['imprimir_historia']."'");
    $cant_hist = $historia_med->num_rows;
    if ($cant_hist > 0) 
    {
	    include 'plantilla_historia.php';
		if (isset($_GET['imprimir_historia'])) 
		{
			$consultas= mysqli_query($conexion, "SELECT * FROM consultas_vet CV INNER JOIN mascotas M, usuarios U WHERE M.id_pry_mascota = CV.id_pry_mascota AND CV.id_usuario = U.id_usuario AND M.id_pry_mascota = '".$_GET['imprimir_historia']."' ORDER BY CV.fecha_consulta_mascota DESC");

			$pdf = new PDF('P','mm','Letter');
			$pdf->AliasNbPages();
			$pdf->AddPage();
			
			$pdf->SetFont('Helvetica','b',12);
			$pdf->Cell(195,6,utf8_decode('HISTORIAL DEL PACIENTE'),0,1,'C');
			$pdf->Ln();
			$pdf->SetFont('Helvetica','b',9);		
			$pdf->Cell(195,6,utf8_decode('RESEÑA DEL PACIENTE'),1,1);
			$pdf->SetFont('Helvetica','',9);
			$pdf->Cell(65,6,utf8_decode('NOMBRE: ').utf8_decode($row['nombre_mascota']),1,0);
			$pdf->Cell(65,6,utf8_decode('ESPECIE: ').utf8_decode($row['nombre_tipo_mascota']),1,0);
			$pdf->Cell(65,6,utf8_decode('RAZA: ').utf8_decode($row['raza_mascota']),1,1);

			$pdf->Cell(65,6,utf8_decode('SEXO: ').utf8_decode($row['sexo_mascota']),1,0);
			$pdf->Cell(65,6,utf8_decode('EDAD: ').utf8_decode($row['edad_mascota']),1,0);
			$pdf->Cell(65,6,utf8_decode('TAMAÑO: ').utf8_decode($row['tamaño_mascota']),1,1);

			$pdf->Cell(65,6,utf8_decode('PESO: ').utf8_decode($row['peso_mascota']),1,0);
			$pdf->Cell(130,6,utf8_decode('OBSERVACIONES: ').utf8_decode($row['observaciones']),1,1);
			$pdf->Ln();

			$pdf->SetFont('Helvetica','b',9);		
			$pdf->Cell(195,6,utf8_decode('DATOS DEL PROPIETARIO'),1,1);
			$pdf->SetFont('Helvetica','',9);
			$pdf->Cell(120,6,utf8_decode('NOMBRE: ').$row['nombre_cliente'],1,0);
			$pdf->Cell(75,6,utf8_decode('IDENTIFICACION: ').$row['nit_cliente'],1,1);
			

			$pdf->Cell(195,6,utf8_decode('DIRECCION: ').$row['dir_cliente'],1,1);

			$pdf->Cell(97.5,6,utf8_decode('TELEFONO: ').$row['tel_cliente'],1,0);
			$pdf->Cell(97.5,6,utf8_decode('CORREO: ').$row['email_cliente'],1,1);
			$pdf->Ln();

			while ($row2=$consultas->fetch_assoc()) 
			{
				$pdf->SetFont('Helvetica','b',9);		
				$pdf->Cell(195,6,utf8_decode('DATOS DE LA CONSULTA       '). $row2['fecha_consulta_mascota'],1,1,'C');
				$pdf->Cell(195,6,utf8_decode('MEDICO:').utf8_decode($row2['nombre_usu'])."  ".utf8_decode('FECHA DE ALTA MEDICA:')."  ".utf8_decode($row2['fecha_alta_medica']),1,1,'L');
				$pdf->Cell(195,6,utf8_decode('SINTOMAS'),1,1);
				$pdf->SetFont('Helvetica','',9);
				$pdf->MultiCell(195,30,utf8_decode($row2['sintomas_mascota']),1,'L');
				$pdf->SetFont('Helvetica','b',9);
				$pdf->Cell(195,6,utf8_decode('OBSERVACIONES'),1,1);
				$pdf->SetFont('Helvetica','',9);
				$pdf->MultiCell(195,30,utf8_decode($row2['observaciones_mascota']),1,'L');
				$pdf->SetFont('Helvetica','b',9);
				$pdf->SetFont('Helvetica','b',9);
				$pdf->Cell(195,6,utf8_decode('DIAGNOSTICOS'),1,1);
				$pdf->SetFont('Helvetica','',9);
				$pdf->SetFont('Helvetica','',9);
				$pdf->MultiCell(195,30,utf8_decode($row2['diagnostico_mascota']),1,'L');
				$pdf->SetFont('Helvetica','b',9);
				$pdf->Cell(195,6,utf8_decode('FORMULA MEDICA'),1,1);
				$pdf->SetFont('Helvetica','',9);
				$pdf->MultiCell(195,30,utf8_decode($row2['formula_medica_mascota']),1,'L');
				$pdf->Cell(195,6,'',0,1);


			}
			
			$pdf->Output();
		}
		else
			{
			  echo "Archivo Vacio";
			}
    	
    }else
    {

    echo "<div >
             <h4><i class='icon fa fa-info'></i>La Mascota seleccionada no tiene Registros!</h4>
         </div>";
                     
    }

	
	
?>