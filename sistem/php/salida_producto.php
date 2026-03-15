<!--
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
 -->
<?php
	require_once 'conexion.php';
	session_start();
	//Guardamos los Datos en session para utilizarlos hasta que se ingrese la factura
	@$_SESSION['nombre_cliente']= $_POST['nombre_cliente'];
	@$_SESSION['nit_cliente']= $_POST['nit_cliente'];
	@$_SESSION['fecha_sal']= $_POST['fecha_sal'];
	@$_SESSION['dir_cliente']= $_POST['dir_cliente'];
	@$_SESSION['tel_cliente']= $_POST['tel_cliente'];


	if (isset($_POST['agregar_producto'])) {

		// Validamos la Cantidad disponible del Producto en inventario
		$validar_existencia = mysqli_query($conexion,"SELECT cantidad FROM productos WHERE id_producto = '".$_POST['nom_producto']."' ");
		while ($existencia=$validar_existencia->fetch_array()) {
			if ($existencia['cantidad'] < $_POST['cant_producto']) {
				print "<script>window.location='../?mod=salida_producto&poca-cantidad-en-inventario';</script>";
			}else{

				// Ingresamos los Datos al carrito de Compra
				$salida_producto = "INSERT INTO salida_productos_temp(numero_fact,nombre_fact,fecha_salida,direccion,telefono,id_producto,cantidad) VALUES('".$_POST['num_factura']."', '".$_POST['nombre_cliente']."','".$_POST['fecha_sal']."','".$_POST['nom_producto']."','".$_POST['cant_producto']."')";
				$query = $conexion->query($salida_producto);
				if ($query != NULL) {
					print "<script>window.location='../?mod=salida_producto';</script>";
				}	
			}
		}	
	}

	if (isset($_POST['guardar_salida'])) {

	// Realizamos la consulta de las tablas productos y la tabla ing_productos_temp y sumamos sus cantidades

		$consulta = mysqli_query($conexion,"SELECT id_producto, SUM(cantidad) resta_total FROM ( SELECT id_producto, cantidad FROM productos UNION ALL SELECT id_producto, -cantidad FROM salida_productos_temp ) T GROUP BY id_producto");

	// Captamos los datos de la consulta y Actualizamos los datos en la tabla productos
			while ($fila=$consulta->fetch_array()){
			$actualizar_inv= mysqli_query($conexion,"UPDATE productos SET cantidad = '".$fila['resta_total']."' WHERE id_producto = '".$fila['id_producto']."' ");
				}
	// Copiamos todos los Datos de la Tabla temporal hacia la tabla ing_productos y vaciamos la tabla ing_productos_temp

			$copiar_tabla = mysqli_query($conexion,"INSERT INTO salida_productos(numero_fact,nombre_fact,fecha_salida,id_producto,cantidad) SELECT numero_fact,nombre_fact,fecha_salida,id_producto,cantidad FROM salida_productos_temp");
				if ($copiar_tabla != NULL) {
					mysqli_query($conexion,"TRUNCATE TABLE salida_productos_temp");
				}else{
					echo "Error al clonar la tabla ing_productos_temp";
				}
			print "<script>window.location='../?mod=salida_producto&exito';</script>";
		}else{
			print "<script>window.location='../?mod=salida_producto&error';</script>";
		}