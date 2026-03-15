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
			$this->Image('../../../imagenes/'.$GLOBALS['logo_empresa'], 5, 1, 40,20 );
			$this->Ln(13);
			$this->SetFont('times','',9);
			$this->SetX(0);
			$this->Cell(55,3.5,utf8_decode('Nit. '.$GLOBALS['nit_empresa']),0,1,'C');
			$this->SetX(0);
			$this->Cell(54,3.5,utf8_decode($GLOBALS['direccion_empresa']),0,1,'C');
			$this->SetX(0);
			$this->Cell(54,3.5,utf8_decode($GLOBALS['telefono_empresa']),0,1,'C');
			$this->Ln(18);
			$this->SetXY(0,38);
			$this->SetFont('times','',8);
			$this->Cell(45,4,utf8_decode('Factura:            ').str_pad($GLOBALS['num_fact'], 5,"0", STR_PAD_LEFT),0,1,'L');
			$this->SetX(0);
			$this->SetFont('times','',8);
			if (isset($_GET['imprimir_venta2'])) 
				{
					$this->Cell(86,4,utf8_decode('Fecha:')."              ".date($GLOBALS['fecha']),0,1,'L');
				}
			else
				{
					$this->Cell(86,4,utf8_decode('Fecha:')."              ".date('Y-m-d'),0,1,'L');
				}
			$this->SetX(0);
			$this->SetFont('times','',8);
			$this->Cell(86,4,utf8_decode('Atendido por:  ').utf8_decode($GLOBALS['nombre_usu']),0,1,'L');
			$this->Ln(3);
			$this->SetX(0);
			$this->SetFont('times','B',8);
			$this->Cell(20,4,'Articulo',0,0,'L');
			$this->Cell(10,4,'Valor',0,0,'C');
			$this->Cell(7,4,'Cant',0,0,'C');
			$this->Cell(11,4,'Total',0,1,'C');			
		}		
	}
?>