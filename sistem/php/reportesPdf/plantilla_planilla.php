<?php 
	require 'fpdf/fpdf.php';  

	//Optenemos los datos de la empresa por medio de la Variable $GLOBALS[]
	require '../datos_empresa.php';
	
	class PDF extends FPDF
	{
		function Header()
		{
			$this->Image('../../../imagenes/'.$GLOBALS['logo_empresa'], 10, 10, 195,20 );
			$this->Ln(27);
			$this->SetFont('Helvetica','',9);
			$this->SetXY(50,30);
			$this->Cell(80,5,utf8_decode('Nit. '.$GLOBALS['nit_empresa']),0,1,'C');
			$this->SetX(30);
			$this->SetFont('Helvetica','B',9);
			$this->MultiCell(120,5,utf8_decode($GLOBALS['descripcion_empresa']),0,'C');
			$this->SetFont('Helvetica','B',12);
			$this->SetXY(161,33);
			$this->SetTextColor(235,28,26);
			$this->Cell(44,6,utf8_decode('PLANILLA'),0,1,'C');
			$this->Ln(1);
			$this->SetX(161);
			$this->Ln(1);
			
		}
		
		function Footer()
		{
			$this->SetY(-25);
			$this->SetFont('Helvetica','B', 8);
			$this->Cell(0,10,utf8_decode($GLOBALS['direccion_empresa'] . 'Cel. ' . $GLOBALS['telefono_empresa'] . ' Email '. $GLOBALS['email_empresa'] ),0,1,'C' );
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
?>