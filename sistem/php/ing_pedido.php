<!--
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
 -->
<?php
	require_once 'conexion.php';
	session_start();
	@$_SESSION['nro_factura']= $_POST['nro_factura'];
	@$_SESSION['nombre_proveedor']= $_POST['nombre_proveedor'];
	@$_SESSION['fecha_ing']= $_POST['fecha_ing'];
	@$_SESSION['plazo']= $_POST['plazo'];
	@$_SESSION['forma_pago']= $_POST['forma_pago'];

	//Comparacion de fecha de vencimiento para las facturas
	if (@$_POST['forma_pago'] == "A credito") 
	{
		$estado = "por pagar";
	}
	if (@$_POST['forma_pago'] == "Al contado") 
	{
		$estado = "cancelada";
	}
	if (isset($_POST['agregar_producto'])) {

		$ing_pedido = " INSERT INTO ing_productos_temp(numero_factura, id_proveedor, fecha_pedido, id_producto, cantidad, precio,id_usuario,plazo,forma_pago,estado) VALUES('".$_POST['nro_factura']."', '".$_POST['nombre_proveedor']."', '".$_POST['fecha_ing']."', '".$_POST['nom_producto']."', '".$_POST['cant_producto']."', '".$_POST['precio_producto']."','".$_POST['id_usuario']."', '".$_POST['plazo']."' , '".$_POST['forma_pago']."', '".$estado."' )";
		$query = $conexion->query($ing_pedido);
		if ($query != NULL) {
			print "<script>window.location='../?mod=ing_pedido';</script>";
		}	
	}
	if (isset($_POST['guardar_pedido'])) {

			$copiar_tabla = mysqli_query($conexion,"INSERT INTO ing_productos(numero_factura,id_proveedor,fecha_pedido,id_producto,cantidad,precio,id_usuario,plazo,forma_pago, estado) SELECT numero_factura,id_proveedor,fecha_pedido,id_producto,cantidad,precio,id_usuario,plazo,forma_pago, estado FROM ing_productos_temp WHERE id_usuario='".$_GET['id_usuario']."'");
				if ($copiar_tabla != NULL) {
					mysqli_query($conexion,"DELETE FROM ing_productos_temp WHERE id_usuario = '".$_GET['id_usuario']."' ");
				}else{
					echo "Error al clonar la tabla ing_productos_temp";
				}
			print "<script>window.location='../?mod=ing_pedido&exito';</script>";
		}else{
			print "<script>window.location='../?mod=ing_pedido&error';</script>";
		}


