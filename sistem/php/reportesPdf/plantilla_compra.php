<?php 
	require 'fpdf/fpdf.php';

	//Optenemos los datos de la empresa por medio de la Variable $GLOBALS[]
	require '../datos_empresa.php';

	//Optenemos los datos de las Facturas de Compra.
	require '../datos_fact_compra.php';
	
	class PDF extends FPDF
	  {
	  	
		function Header()
		{
			$this->Image('../../../imagenes/'.$GLOBALS['logo_empresa'], 31, 2, 120,32 );
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
			$this->Cell(44,6,utf8_decode('FACTURA DE COMPRA'),0,1,'C');
			$this->SetX(161);
			$this->SetFont('Helvetica','B',16);
			$this->Cell(44,8,utf8_decode('N°_'),1,1,'L');
			$this->Ln(1);
			$this->SetX(161);
			$this->Ln(10);
			$this->SetTextColor(235,28,26);
			$this->SetFont('Helvetica','B',16);
			$this->SetXY(170.5,39);
			$this->Cell(34.5,8,str_pad($GLOBALS['num_fact'], 5,"0", STR_PAD_LEFT),0,1,'L');
			$this->SetXY(161,48);
			$this->Cell(44,8,date($GLOBALS['fecha']),1,0,'C');
			$this->Ln(11);
			$this->SetFont('Helvetica','B',16);
			$this->SetTextColor(0,0,0);
			$this->Cell(195,7,utf8_decode("Factura de Compra"),0,1,'C');
			$this->Ln(7);
			$this->SetFont('Helvetica','B',12);
			$this->Cell(145,6,utf8_decode("Proveedor: ".$GLOBALS['proveedor']),1,0,'L');
			$this->Cell(50,6,utf8_decode("Nit: ". $GLOBALS['nit']),1,1,'L');
			$this->Cell(160,6,utf8_decode("Dirección: ". $GLOBALS['direccion']),1,0,'L');
			$this->Cell(35,6,utf8_decode("Tel: ". $GLOBALS['telefono']),1,1,'L');
			$this->SetFont('Helvetica','B',10);
			$this->SetFillColor(234,174,44);
			$this->SetFont('Helvetica','B',8);
			$this->SetTextColor(240,240,240);
			$this->Cell(10,6,'CANT.',1,0,'C',1);
			$this->Cell(125,6,'DESCRIPCION',1,0,'C',1);
			$this->Cell(30,6,'VALOR UNITARIO',1,0,'C',1);
			$this->Cell(30,6,'VALOR TOTAL',1,1,'C',1);
				
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