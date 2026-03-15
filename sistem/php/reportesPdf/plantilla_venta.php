<?php 
	require 'fpdf/fpdf.php';

	//Optenemos los datos de la empresa por medio de la Variable $GLOBALS[]
	require '../datos_empresa.php';

	//Optenemos los datos de las Facturas de Compra.
	require '../datos_fact_venta.php';
	
	class PDF extends FPDF
	  {
	  	
		function Header()
		{
			$this->Image('../../../imagenes/'.$GLOBALS['logo_empresa'], 11, 10, 60,50 );
			
			$this->SetFont('Helvetica','',9);
			$this->SetXY(75,30);
			$this->Cell(80,5,utf8_decode('Nit. '.$GLOBALS['nit_empresa']),0,1,'L');
			$this->SetXY(75,39);
			$this->SetFont('Helvetica','B',9);
			$this->MultiCell(85,5,utf8_decode($GLOBALS['descripcion_empresa']),0,'L');
			$this->SetFont('Helvetica','B',12);
			$this->SetXY(161,33);
			$this->SetTextColor(235,28,26);
			$this->Cell(44,6,utf8_decode('FACTURA DE VENTA'),0,1,'C');
			$this->SetX(161);
			$this->SetFont('Helvetica','B',16);
			$this->Cell(44,8,utf8_decode('N°_'),1,1,'L');
			$this->Ln(2);
			$this->SetX(161);
			$this->SetFont('Helvetica','B',10);
			$this->SetTextColor(235,28,26);
			$this->SetFont('Helvetica','B',16);
			$this->SetXY(170.5,39);
			$this->Cell(34.5,8,str_pad($GLOBALS['num_fact'], 5,"0", STR_PAD_LEFT),0,1,'L');
			$this->SetXY(161,53);
			if (isset($_GET['imprimir_venta2'])) 
				{
					$this->Cell(44,8,date($GLOBALS['fecha']),1,0,'C');
				}
			else
				{
					$this->Cell(44,8,date('Y-m-d'),1,0,'C');
				}
			$this->Ln(15);
			$this->SetFont('Helvetica','B',12);
			$this->SetTextColor(1,1,1);
			$this->Cell(145,6,utf8_decode("Señor: ".$GLOBALS['nombre']),1,0,'L');
			$this->Cell(50,6,utf8_decode("Nit: ".$GLOBALS['nit']),1,1,'L');
			$this->Cell(145,6,utf8_decode("Dirección: ".$GLOBALS['direccion']),1,0,'L');
			$this->Cell(50,6,utf8_decode("Tel: ".$GLOBALS['telefono']),1,1,'L');
			
			$this->SetFillColor(27,49,88);
		    $this->SetTextColor(255,255,255);
			$this->SetFont('Helvetica','B',8);
			$this->Cell(10,6,'CANT.',1,0,'C',1);
			$this->Cell(110,6,'DESCRIPCION',1,0,'C',1);
			$this->Cell(25,6,'VR. UNIT',1,0,'C',1);
			$this->Cell(25,6,'IVA %',1,0,'C',1);
			$this->Cell(25,6,'VR. TOTAL',1,1,'C',1);
			
			
		}
		
		function Footer()
		{
			$this->SetY(-25);
			$this->SetFont('Helvetica','B', 8);
			$this->Cell(0,10,utf8_decode($GLOBALS['direccion_empresa'] . ' Cel. ' . $GLOBALS['telefono_empresa'] . ' Email '. $GLOBALS['email_empresa'] ),0,1,'C' );
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
?>