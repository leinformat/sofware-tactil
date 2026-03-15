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
	@$_SESSION['fecha_sal']= $_POST['fecha_sal'];


	if (isset($_POST['agregar_st_pr'])) 
		{

			// Validamos la Cantidad disponible del Producto en inventario
			$validar_existencia = mysqli_query($conexion,"SELECT cantidad FROM productos WHERE id_producto = '".$_POST['nom_producto']."' ");
			while ($existencia=$validar_existencia->fetch_array())
				{
					if ($existencia['cantidad'] < $_POST['cant_st_pr']){
						print "<script>window.location='../?mod=fact_empresas&poca-cantidad-en-inventario';</script>";
				    }else{

							// Ingresamos los Datos al carrito de Compra
							$salida_producto = "INSERT INTO salida_productos_temp(numero_fact,nombre_fact,fecha_salida,id_producto,cantidad,monto,id_usuario,desc_product) VALUES('".$_POST['num_factura']."', '".$_POST['nombre_cliente']."','".$_POST['fecha_sal']."','".$_POST['nom_producto']."','".$_POST['cant_st_pr']."','".$_POST['precio_st_pr']."','".$_POST['id_usuario']."','".$_POST['desc_pr']."' )";
							$query = $conexion->query($salida_producto);
							if ($query != NULL) {
								print "<script>window.location='../?mod=fact_empresas';</script>";
							}	
						}
				}	
		}
//Por Ultimo Coppiamos los Datos de la Tabla Temporal a La Tabla salida Productos
	if (isset($_POST['guardar_fact_empresa'])) 
		{
			$copiar_tabla = mysqli_query($conexion,"INSERT INTO salida_productos(numero_fact,nombre_fact,fecha_salida,id_producto,cantidad,monto,id_usuario,desc_product) SELECT numero_fact,nombre_fact,fecha_salida,id_producto,cantidad,monto,id_usuario,desc_product FROM salida_productos_temp WHERE id_usuario='".$_GET['id_usuario']."'");
				if ($copiar_tabla != NULL) {
					mysqli_query($conexion,"DELETE FROM salida_productos_temp WHERE id_usuario = '".$_GET['id_usuario']."' ");
				}else{
					echo "Error al clonar la tabla ing_productos_temp";
				}
			print "<script>window.location='../?mod=fact_empresas&exito';</script>";

		}else{
				print "<script>window.location='../?mod=fact_empresas&error';</script>";
			 }