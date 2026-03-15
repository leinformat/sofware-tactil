<!--
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
 -->
<?php
	require_once 'conexion.php';
//Actualizar tabla inn_productos Factura Cancelada
	if (isset($_GET['factura'])) 
		{
			$pagar_factura = mysqli_query($conexion,"UPDATE ing_productos SET estado ='cancelada' WHERE numero_factura = '".$_GET['factura']."' ");
				if ($pagar_factura != NULL){
					print "<script>window.location='../?mod=facturas_por_pagar&exito';</script>";
				}else{
				print "<script>window.location='../?mod=facturas_por_pagar&error';</script>";
			 	}
			

		}