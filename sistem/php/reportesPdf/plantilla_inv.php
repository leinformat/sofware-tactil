<?php
	require_once 'fpdf/fpdf.php'; 
	include_once 'barcode.php';
	//Optenemos los datos de la empresa por medio de la Variable $GLOBALS[]
	require_once '../datos_empresa.php';
	
	class PDF extends FPDF
	{
		function Header()
		{
			$this->Image('../../../imagenes/'.$GLOBALS['logo_empresa'],76, 5, 60,50 );
			$this->Ln(40);
			$this->SetFont('Helvetica','B',13);
			
			$this->SetXY(65,60);

			if (isset($_GET['ventas_dia']))
			{
				$this->Cell(80,10,utf8_decode('Ventas del Día'),0,0,'C');
			}
			elseif (isset($_GET['rep_intervalo']))
			{
				$this->Cell(80,10,utf8_decode('REPORTE GENERAL'),0,0,'C');
			}
			else
			{
				$this->Cell(80,10,utf8_decode('Productos en Inventario'),0,0,'C');
			}
			
			$this->SetFont('Helvetica','B',12);
			$this->SetX(170);

			if (isset($_GET['rep_intervalo'])) 
			{
				$this->Cell(30,10, 'Periodo',0,1,'C');
			}
			else
			{
				$this->SetXY(170,60);
				$this->Cell(30,10, 'Fecha',0,1,'C');
			}
			
			$this->SetY(65);
			$this->SetX(170);
			if (isset($_GET['fecha']))
			{
				$this->Cell(30,10,$_GET['fecha'],0,1,'R');
			}
			elseif (isset($_GET['rep_intervalo'])) 
			{
				$this->Cell(30,10,$_POST['desde']." - ".$_POST['hasta'],0,1,'R');
			}
			else
			{
				$this->Cell(30,10,date('d/m/Y'),0,1,'R');
			}
			$this->Ln(5);

			if (isset($_GET['imprimir_inv'])) 
			{
				$this->SetFillColor(27,49,88);
				$this->SetTextColor(255,255,255);
				$this->SetFont('Helvetica','B',8);
				$this->Cell(10,6,'#',1,0,'C',1);
				$this->Cell(20,6,utf8_decode('Código'),1,0,'C',1);
				$this->Cell(70,6,utf8_decode('Nombre de Producto'),1,0,'C',1);
				$this->Cell(30,6,utf8_decode('Categoria'),1,0,'C',1);
				$this->Cell(20,6,utf8_decode('Cantidad'),1,0,'C',1);
				$this->Cell(22,6,utf8_decode('Precio Unitario'),1,0,'C',1);
				$this->Cell(23,6,utf8_decode('Precio Total'),1,1,'C',1);
			}
			if (isset($_GET['ventas_dia'])) 
			{
				$this->SetX(15);
				$this->SetFillColor(27,49,88);
				$this->SetTextColor(255,255,255);
				$this->SetFont('Helvetica','B',8);
				$this->Cell(10,6,'#',1,0,'C',1);
				$this->Cell(55,6,utf8_decode('Nombre de Producto'),1,0,'C',1);
				$this->Cell(15,6,utf8_decode('Cant.'),1,0,'C',1);
				$this->Cell(20,6,utf8_decode('Vr. Compra'),1,0,'C',1);
				$this->Cell(20,6,utf8_decode('Vr. Venta'),1,0,'C',1);
				$this->Cell(20,6,utf8_decode('G.x Prod.'),1,0,'C',1);
				$this->Cell(20,6,utf8_decode('TG.x Prod.'),1,0,'C',1);
				$this->Cell(25,6,utf8_decode('M.Neto x Prod'),1,1,'C',1);
				$this->SetFont('Helvetica','',8);
			}
		}
		
		function Footer() 
		{
			$this->SetY(-15);
			$this->SetFont('Helvetica','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
