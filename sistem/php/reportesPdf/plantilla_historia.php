<?php 
	require 'fpdf/fpdf.php';

	//Optenemos los datos de la empresa por medio de la Variable $GLOBALS[]
	require '../datos_empresa.php';

	//Optenemos los datos de las Facturas de Compra.
	require '../datos_historia_medica.php';
	
	class PDF extends FPDF
	  {
	  	
		function Header()
		{
			$this->Image('../../../imagenes/'.$GLOBALS['logo_empresa'], 10, 10, 195,30 );
			$this->Ln(27);
			$this->SetFont('Helvetica','',9);
			$this->SetXY(50,40);
			$this->Cell(80,5,utf8_decode('Nit. '.$GLOBALS['nit_empresa']),0,1,'C');
			$this->SetX(30);
			$this->SetFont('Helvetica','B',9);
			$this->MultiCell(120,5,utf8_decode($GLOBALS['descripcion_empresa']),0,'C');
			$this->SetFont('Helvetica','B',12);
			$this->SetXY(161,43);
			$this->SetTextColor(235,28,26);
			$this->Cell(44,6,utf8_decode('HISTORIA'),1,1,'L');
			$this->SetX(161);
			$this->SetFont('Helvetica','B',16);
			$this->Cell(44,8,utf8_decode('N°_'),1,1,'L');
			$this->Ln(1);
			$this->SetX(161); 
			$this->Ln(10);
			$this->SetTextColor(235,28,26);
			$this->SetFont('Helvetica','B',16);
			$this->SetXY(170.5,49);
			$this->Cell(34.5,8,$GLOBALS['n_historia_mascota'],0,1,'L');
			$this->SetXY(161,57);
			$this->Cell(44,8,utf8_decode('ID ').$GLOBALS['id_mascota'],1,1,'L');
			$this->Ln(11);
			
				
		}
		
		function Footer()
		{
			$this->SetY(-21);
			$this->SetFont('Helvetica','B', 8);
			$this->Cell(0,10,utf8_decode($GLOBALS['direccion_empresa'] . 'Cel. ' . $GLOBALS['telefono_empresa'] . ' Email '. $GLOBALS['email_empresa'] ),0,1,'C' );
			$this->SetY(-15);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
?>