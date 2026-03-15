<!-- 
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
 --> 
<?php
 
	include 'conexion.php';
	//Trabajo
	$trabajo= mysqli_query($conexion, "SELECT * FROM empleados ORDER BY nombre_empleado ASC");

	//Tipo de Servicios Tecnicos
	$tipo_st= mysqli_query($conexion, "SELECT * FROM tipo_servicio_tec ORDER BY nombre_tst ASC");

	//Tipo de Gastos
	$tipo_gasto= mysqli_query($conexion, "SELECT * FROM categoria_gastos ORDER BY nombre_cat_gasto ASC");

	//Reportes
	$rep_trabajos= mysqli_query($conexion, "SELECT * FROM reportes, tipo_servicio_tec JOIN empleados WHERE empleados.id_empleado = reportes.id_empleado AND reportes.id_servicio_tec = tipo_servicio_tec.id_tipo_ser ORDER BY fecha DESC");

	$rep_prestamos= mysqli_query($conexion, "SELECT * FROM prestamos JOIN empleados WHERE empleados.id_empleado = prestamos.id_empleado ORDER BY fecha ASC");

	//Suma de la Tabla Reportes
	$sum_trabajos = mysqli_query($conexion, "SELECT SUM(monto) as total_trabajo FROM reportes");
	$sum_prestamos = mysqli_query($conexion, "SELECT SUM(monto) as total_prestamo FROM prestamos");
	
	//Busqueda de Prestamos por trabajador
	if (isset($_POST['s'])) 
		{
			$buscar= mysqli_query($conexion,'SELECT * FROM prestamos JOIN empleados WHERE prestamos.id_empleado = empleados.id_empleado AND empleados.nombre_empleado LIKE "%'.$_POST['s'].'%" ');
		}

	//Agregar una Categoria en el Inventario
	if (isset($_POST['agg_cat']))
		{
			mysqli_query($conexion,"INSERT INTO categorias(nombre_cat) VALUES('".$_POST['nombre_cat']."') ");
			header('Location: ../?mod=agg_cat&exito');
		}

	//Buscar Categoria
	$buscar_cat= mysqli_query($conexion, "SELECT * FROM categorias  ORDER BY nombre_cat ASC");

	// Ver Categorias
	$ver_categorias=mysqli_query($conexion,"SELECT * FROM categorias ORDER BY nombre_cat ASC ");

	// Inventario
		//Paginacion Exixtente en Inventario
	$articulos_x_pagina= 20;
	$inventario_inc= mysqli_query($conexion, "SELECT * FROM productos WHERE cantidad > 0 AND id_categoria != 9");
	$total_art_bd = $inventario_inc->num_rows;
	$paginas = $total_art_bd / $articulos_x_pagina;
	$paginas = ceil($paginas);

		//Paginacion Agotado en Inventario
	$articulos_x_pagina= 20;
	$inventario_agot= mysqli_query($conexion, "SELECT * FROM productos WHERE cantidad <= 0 AND id_categoria != 9");
	$total_agot_bd = $inventario_agot->num_rows;
	$paginas_agot = $total_agot_bd / $articulos_x_pagina;
	$paginas_agot = ceil($paginas_agot);

	// fIN  Inventario

	// Borrar producto del Inventario
	if(isset($_GET['borrar_producto']))
		{
			$sql = "UPDATE productos SET estado_producto = 0 WHERE id_producto='".$_GET['borrar_producto']."'";
			$con = $conexion->query($sql);
			if($con !=null){
				print "<script>window.location='../?mod=inventario&pagina=1&exito';</script>";
			}else{
				print "<script>window.location='../?mod=inventario&pagina=1&error';</script>";
			}
		}
	// Modificar Inventario
		if (isset($_POST['modificar_producto'])) {
			$id   = $_POST['id_producto'];
			$cod  = $_POST['cod_producto'];
			$nom  = $_POST['nom_producto'];
			$cat  = $_POST['cat_producto'];
			$cant = $_POST['cant_producto'];
			$pcomp = $_POST['precio_compra'];
			$punit = $_POST['precio_unitario'];

			$updateImageSQL = "";

			// Imagen
			if (!empty($_FILES['imagen']['name'])) {

				$nombre_imagen = $_FILES['imagen']['name'];
				$tipo_imagen   = $_FILES['imagen']['type'];
				$tmp_imagen    = $_FILES['imagen']['tmp_name'];
				$tamano_imagen = $_FILES['imagen']['size'];

				if ($tipo_imagen == 'image/jpeg' || 
					$tipo_imagen == 'image/jpg'  || 
					$tipo_imagen == 'image/png'  || 
					$tipo_imagen == 'image/gif') {

					$path = "uploads/products/";
					$destDir = "../".$path;

					if (!file_exists($destDir)) {
						mkdir($destDir, 0777, true);
					}

					$fileName = time() . "_" . basename($nombre_imagen);
					$destPath = $destDir . $fileName;

					if (move_uploaded_file($tmp_imagen, $destPath)) {
						// esto SI lo guarda completo
						$updateImageSQL = ", img = '{$path}{$fileName}'";
					}
				}
			}

			$sql = "
				UPDATE productos SET 
					cod_producto   = '$cod',
					nombre_producto = '$nom',
					id_categoria   = '$cat',
					cantidad       = '$cant',
					precio_compra  = '$pcomp',
					precio_unid    = '$punit'
					$updateImageSQL
				WHERE id_producto = '$id'
			";

			$res = mysqli_query($conexion, $sql);

			if ($res) {
				echo "<script>window.location='../?mod=inventario&pagina=1&exito_mod';</script>";
			} else {
				echo "<script>window.location='../?mod=inventario&pagina=1&error_mod';</script>";
			}
		}


		
	// Borrar Prestamo un Trabajador
	if(isset($_GET['cancelar-prestamo']))
		{
			$sql = "DELETE FROM prestamos WHERE id_prestamo='".$_GET['cancelar-prestamo']."'";
			$query = $conexion->query($sql);
			if($query!=null){
				print "<script>window.location='../?mod=rep_prestamos&exito';</script>";
			}else{
				print "<script>window.location='../?mod=rep_prestamos&error';</script>";
			}
		}

	// Borrar Trabajo Realizado por un Trabajador
	if(isset($_GET['eliminar-trabajo']))
		{
			
			$sql = "DELETE FROM reportes WHERE id_reporte='".$_GET['eliminar-trabajo']."'";
			$query = $conexion->query($sql);
			if($query!=null){
				print "<script>window.location='../?mod=rep_trabajos&exito';</script>";
			}else{
				print "<script>window.location='../?mod=rep_trabajos&error';</script>";

			}
		}

	//Buscar Producto
	$buscar_prod= mysqli_query($conexion, "SELECT id_producto,cod_producto, nombre_producto,cantidad FROM productos   ORDER BY nombre_producto ASC"); 
	$buscar_prod1= mysqli_query($conexion, "SELECT id_producto, nombre_producto,cod_producto,precio_unid,cantidad FROM productos WHERE cantidad > 0   ORDER BY nombre_producto ASC");

	// Carrito de Ingreso de Factura
	if (isset($_SESSION['id_usu']))
		{
			$ingreso_factura= mysqli_query($conexion, "SELECT * FROM productos p JOIN ing_productos_temp ip WHERE p.id_producto = ip.id_producto AND id_usuario = '".$_SESSION['id_usu']."' ORDER BY nombre_producto ASC");
		}
	// Carrito de Salida de Factura
	if (isset($_SESSION['id_usu'])) 
		{
			$salida_producto= mysqli_query($conexion, "SELECT * FROM productos p  JOIN salida_productos_temp sp WHERE sp.id_producto= p.id_producto AND id_usuario = '".$_SESSION['id_usu']."' ORDER BY nombre_producto ASC");
		}

	// Carrito de Salida por Planilla
	if (isset($_GET['fact_por_pagar'])) 
		{
			@$edit_fact_por_pagar= mysqli_query($conexion, "SELECT IP.cantidad, IP.precio, P.nombre_producto, P.cod_producto FROM ing_productos IP  JOIN productos P WHERE IP.id_producto = P.id_producto AND IP.numero_factura = '".$_GET['fact_por_pagar']."' ORDER BY P.nombre_producto ASC");
		}

	// Borrar Producto del Carrito Entrada de Producto
	if(isset($_GET['carrito_entrada']))
		{
			$sql = "DELETE FROM ing_productos_temp WHERE id_producto='".$_GET['carrito_entrada']."' && id_usuario='".$_GET['id_usuario']."'";
			$query = $conexion->query($sql);
			if($query!=null){
				print "<script>window.location='../?mod=ing_pedido';</script>";
			}
		}

	// Borrar Producto del Carrito Salida de Producto
	if(isset($_GET['carrito_salida']))
		{
			$sql = "DELETE FROM salida_productos_temp WHERE id_producto='".$_GET['carrito_salida']."'";
			$query = $conexion->query($sql);
			if($query!=null){
				print "<script>window.location='../?mod=salida_producto';</script>";
			}
		}
 
	////////////////////////////////////Listado de Facturas de Ventas///////////////////////////////////////
		//Paginacion
	$ventas_x_pagina= 10;
	$count_ventas= mysqli_query($conexion, "SELECT * FROM salida_productos GROUP BY numero_fact HAVING COUNT(*)>= 1");
	$total_ventas_bd = $count_ventas->num_rows;
	$paginas_ventas = $total_ventas_bd / $ventas_x_pagina;
	$paginas_ventas = ceil($paginas_ventas);


	/////////////////////////Buscar Ventas/////////////////////////////
	if (isset($_POST['bsc_ventas'])) 
		{
		$busc_ventas= mysqli_query($conexion,'SELECT p.nombre_producto, sp.fecha_salida, SUM(sp.cantidad) cantidad_total, SUM(sp.cantidad * sp.monto) monto_total FROM salida_productos sp JOIN productos p WHERE sp.id_producto = p.id_producto AND sp.fecha_salida BETWEEN "'.$_POST['bsc_ventas'].'" AND "'.$_POST['bsc_ventas2'].'" GROUP BY sp.fecha_salida HAVING COUNT(*)>=1 ORDER BY sp.fecha_salida DESC');

		}
	/////////////////////////Buscar en Listado de Facturas de Ventas y Servicios/////////////////////////////
	if (isset($_POST['bsc_list_fact_venta'])) 
		{
		$busc_list_factura_venta= mysqli_query($conexion,'SELECT * FROM salida_productos sp,clientes cl WHERE sp.nombre_fact = cl.id_cliente AND sp.numero_fact = "'.$_POST["bsc_list_fact_venta"].'" OR sp.nombre_fact = cl.id_cliente AND cl.nit_cliente = "'.$_POST['bsc_list_fact_venta'].'" OR sp.nombre_fact = cl.id_cliente AND cl.nombre_cliente LIKE "%'.$_POST['bsc_list_fact_venta'].'%" OR sp.nombre_fact = cl.id_cliente AND sp.fecha_salida LIKE "%'.$_POST['bsc_list_fact_venta'].'%" GROUP BY sp.numero_fact HAVING COUNT(*)>=1 ORDER BY sp.numero_fact DESC ');

		}

   //////////////////////////////////////////Listado de Facturas de Compras/////////////////////////////////////
				//Paginacion
		$compras_x_pagina= 10;
		$count_compras= mysqli_query($conexion, "SELECT * FROM ing_productos GROUP BY numero_factura HAVING COUNT(*)>= 1");
		$total_compras_bd = $count_compras->num_rows;
		$paginas_compras = $total_compras_bd / $compras_x_pagina;
		$paginas_compras = ceil($paginas_compras);

  ///////////////////////////////////////Buscar en Listado de Facturas de Compra////////////////////////////////
		if (isset($_POST['bsc_list_fact'])) 
		{
		$busc_list_factura_compra= mysqli_query($conexion,'SELECT * FROM ing_productos IP, proveedores P WHERE IP.id_proveedor = P.id_proveedor AND IP.numero_factura = "'.$_POST["bsc_list_fact"].'" OR IP.id_proveedor = P.id_proveedor AND P.nit_proveedor = "'.$_POST["bsc_list_fact"].'" OR IP.id_proveedor = P.id_proveedor AND P.nombre_proveedor LIKE "%'.$_POST["bsc_list_fact"].'%" OR IP.id_proveedor = P.id_proveedor AND IP.fecha_pedido LIKE "%'.$_POST["bsc_list_fact"].'%"  OR IP.id_proveedor = P.id_proveedor AND IP.estado LIKE "%'.$_POST["bsc_list_fact"].'%"  OR IP.id_proveedor = P.id_proveedor AND IP.forma_pago LIKE "%'.$_POST["bsc_list_fact"].'%"  OR IP.id_proveedor = P.id_proveedor AND IP.plazo LIKE "%'.$_POST["bsc_list_fact"].'%"  GROUP BY numero_factura HAVING COUNT(*)>=1 ORDER BY numero_factura DESC ');
		}


	//Optener Numero de Factura Autoincrementable
	$num_fact = mysqli_query($conexion,"SELECT max(numero_fact) + 1 as factura FROM salida_productos");

	//Optener Numero de Servicio Tecnico Autoincrementable
	$num_servicio = mysqli_query($conexion,"SELECT max(id_servicio) + 1 as id_serv FROM servicio_tec");

	//Agregar Proveedor
	if (isset($_POST['agregar_proveedor'])) {
		 mysqli_query($conexion,"INSERT INTO proveedores(nombre_proveedor,nit_proveedor,tel_proveedor,email_proveedor,dir_proveedor) VALUES('".$_POST['nom_proveedor']."', '".$_POST['nit_proveedor']."', '".$_POST['tel_proveedor']."','".$_POST['correo_proveedor']."', '".$_POST['dir_proveedor']."') ");
		print "<script>window.location='../?mod=agg_proveedor&proveedor-agregado';</script>";
	}
	//Lita de Proveedores
	$list_proveedores = mysqli_query($conexion,"SELECT * FROM proveedores ORDER BY nombre_proveedor ASC");

	//Lita de Clientes
	$list_clientes = mysqli_query($conexion,"SELECT * FROM clientes ORDER BY nombre_cliente ASC");

	//Lista de Facturas por pagar
	 $facturas_por_pagar= mysqli_query($conexion,"SELECT IP.plazo, IP.numero_factura, P.nombre_proveedor, P.id_proveedor FROM ing_productos IP, proveedores P WHERE IP.id_proveedor = P.id_proveedor AND IP.estado = 'por pagar'  GROUP BY numero_factura HAVING COUNT(*)>=1 ORDER BY fecha_pedido DESC ");

	 //Agregar Planilla
	if (isset($_POST['agregar_planilla'])) {
		 mysqli_query($conexion,"INSERT INTO planillas(id_cliente, id_usuario) VALUES('".$_POST['id_cliente']."', '".$_POST['id_usuario']."') ");
		print "<script>window.location='../?mod=planillas&planilla-agregada';</script>";
	}
	//Borrar Producto de las Planillas
	if(isset($_GET['borrar_producto_planilla']))
		{
			$sql = "DELETE FROM salida_planillas WHERE id_producto='".$_GET['borrar_producto_planilla']."' && id_cliente ='".$_GET['id_cliente']."'";
			$query = $conexion->query($sql);
			if($query!=null){
				print "<script>window.location='../?mod=agg_planilla&id_cliente='+$_GET[id_cliente];</script>";
			}
		}

	//Eliminar Planilla
	if (isset($_GET['eliminar_planilla'])) 
		{
			 mysqli_query($conexion,"DELETE FROM planillas WHERE id_planilla = '".$_GET["id_planilla"]."' ");
			print "<script>window.location='../?mod=planillas&planilla-eliminada';</script>";
		}	
	//Lita de Planillas
	$list_planillas = mysqli_query($conexion,"SELECT c.id_cliente, c.nombre_cliente, c.nit_cliente, p.id_planilla FROM clientes c JOIN planillas p WHERE p.id_cliente = c.id_cliente ");
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
   ////////////////////////////////  Facturas Para las Empresas ////////////////////////////////////////////////
   /////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//Buscar Cliente
	$buscar_cliente= mysqli_query($conexion, "SELECT * FROM clientes ORDER BY nombre_cliente ASC");

	//Borrar Carrito de Salida Facturas para Empresas
	if(isset($_GET['carrito_salida_empresa']))   
		{
			$sql = "DELETE FROM salida_productos_temp WHERE id_salida='".$_GET['carrito_salida_empresa']."' && id_usuario='".$_GET['id_usuario']."'";
			$query = $conexion->query($sql);
			if($query!=null){
				print "<script>window.location='../?mod=fact_empresas';</script>";
			}
		}

	//Agregar Cliente
	if (isset($_POST['agregar_cliente'])) {
		 mysqli_query($conexion,"INSERT INTO clientes(nombre_cliente,nit_cliente,tel_cliente,email_cliente,dir_cliente) VALUES('".$_POST['nom_cliente']."', '".$_POST['nit_cliente']."', '".$_POST['tel_cliente']."','".$_POST['correo_cliente']."', '".$_POST['dir_cliente']."') ");
		print "<script>window.location='../?mod=agg_cliente&cliente-agregado';</script>";
	}

	//Lita de Usuarios
	$list_usuarios = mysqli_query($conexion,"SELECT * FROM usuarios US INNER JOIN roles RL WHERE US.id_rol = RL.id_rol AND US.id_rol!=0  ORDER BY nombre_usu ASC");

	//Lita de Tecnico
	$list_tecnicos = mysqli_query($conexion,"SELECT * FROM usuarios US INNER JOIN roles RL WHERE US.id_rol = RL.id_rol AND US.id_rol = 2  ORDER BY nombre_usu ASC");



	// Borrar Usuario del Sistema
	if(isset($_GET['eliminar-usuario']))
		{
			
			$sql = "DELETE FROM usuarios WHERE id_usuario='".$_GET['eliminar-usuario']."'";
			$query = $conexion->query($sql);
			if($query!=null){
				print "<script>window.location='../?mod=adm_usuarios&exito';</script>";
			}else{
				print "<script>window.location='../?mod=adm_usuarios&error';</script>";

			}
		}

	//Roles
	$roles= mysqli_query($conexion,"SELECT * FROM roles");

	// Tipo de Mascotas
	$tipo_mascota= mysqli_query($conexion,"SELECT * FROM tipo_mascota ORDER BY nombre_tipo_mascota ASC");


	//Agregar Usuario
	if (isset($_POST['agregar_usuario'])) {
		 mysqli_query($conexion,"INSERT INTO usuarios(nick,nombre_usu,id_rol,password,email,telefono) VALUES('".$_POST['nick']."','".$_POST['nom_usuario']."', '".$_POST['rol_usuario']."', '".$_POST['clave_usuario']."','".$_POST['correo_usuario']."', '".$_POST['tel_usuario']."') ");
		print "<script>window.location='../?mod=adm_usuarios&usuario-agregado';</script>";
	}

	// Modificar Usuario
		if (isset($_POST['modificar_usuario']))
			{
				$modificar_usuario= mysqli_query($conexion,"UPDATE usuarios SET nick = '".$_POST['nick']."', nombre_usu = '".$_POST['nom_usuario']."', id_rol = '".$_POST['rol_usuario']."', password = '".$_POST['clave_usuario']."', email = '".$_POST['correo_usuario']."', telefono = '".$_POST['tel_usuario']."' WHERE id_usuario = '".$_POST['id_usuario']."' ");

					if ($modificar_usuario != NULL) {
						print "<script>window.location='../?mod=adm_usuarios&exito_mod';</script>";
					}else{
						print "<script>window.location='../?mod=adm_usuarios&error_mod';</script>";
					}
			}
	// Modificar Cliente
		if (isset($_POST['modificar_cliente']))
			{
				$modificar_cliente= mysqli_query($conexion,"UPDATE clientes SET nombre_cliente = '".$_POST['nombre_cliente']."', nit_cliente = '".$_POST['nit_cliente']."', tel_cliente = '".$_POST['tel_cliente']."', email_cliente = '".$_POST['email_cliente']."', dir_cliente = '".$_POST['dir_cliente']."' WHERE id_cliente = '".$_POST['id_cliente']."' ");

					if ($modificar_cliente != NULL) {
						print "<script>window.location='../?mod=clientes&exito_mod';</script>";
					}else{
						print "<script>window.location='../?mod=clientes&error_mod';</script>";
					}
			}

	// Modificar Proveedor
		if (isset($_POST['modificar_proveedor']))
			{
				$modificar_proveedor= mysqli_query($conexion,"UPDATE proveedores SET nombre_proveedor = '".$_POST['nombre_proveedor']."', nit_proveedor = '".$_POST['nit_proveedor']."', tel_proveedor = '".$_POST['tel_proveedor']."', email_proveedor = '".$_POST['email_proveedor']."', dir_proveedor = '".$_POST['dir_proveedor']."' WHERE id_proveedor = '".$_POST['id_proveedor']."' ");

					if ($modificar_proveedor != NULL) {
						print "<script>window.location='../?mod=proveedores&exito_mod';</script>";
					}else{
						print "<script>window.location='../?mod=proveedores&error_mod';</script>";
					}
			}		


	//Agregar Servicio Tecnico
	if (isset($_POST['agregar_servicio_tec'])) {
		 mysqli_query($conexion,"INSERT INTO servicio_tec(id_servicio, id_usuario, id_cliente, id_tipo_serv, fecha_serv,equipo_st,descripcion,estatus,abono) VALUES('".$_POST['id_serv']."', '".$_POST['id_usuario']."', '".$_POST['nombre_cliente']."','".$_POST['servicio_tec']."', '".$_POST['fecha_st']."','".$_POST['equipo_st']."', '".$_POST['desc_st']."', '".$_POST['estatus']."' , '".$_POST['abono_st']."') ");

		 if (@$_SESSION['rol'] != 'Tecnico' ){
		 	print "<script>window.location='../?mod=servicio_tec_adm&serv-agregado';</script>";
		 }else{
		 	print "<script>window.location='../?mod=servicio_tec&serv-agregado';</script>";
		 }
			
	}

	//Lista de Servicios tecnico con su Estatus
	@$list_servicios_tec= mysqli_query($conexion, "SELECT * FROM servicio_tec ST INNER JOIN usuarios U,clientes C,tipo_servicio_tec TS, estatus E WHERE ST.id_usuario = U.id_usuario AND ST.id_cliente= C.id_cliente AND ST.id_tipo_serv = TS.id_tipo_ser AND ST.estatus = E.id_estatus AND ST.id_usuario = '".$_SESSION['id_usu']."' AND E.id_estatus < 3 ORDER BY id_servicio DESC ");
	//Lista de Estatus
	$list_status= mysqli_query($conexion, "SELECT * FROM estatus");		

	//Actualizar Estatus

	if (isset($_POST['cambiar_estatus'])) 
		{
		  mysqli_query($conexion,"UPDATE servicio_tec SET estatus = '".$_POST['nuevo_status']."' , monto_total = '".$_POST['monto_st']."',equipo_st = '".$_POST['equipo_st']."', fecha_retiro = '".$_POST['fecha_egreso']."', descripcion = '".$_POST['desc_st']."' , abono = '".$_POST['abono_st']."' WHERE id_servicio = '".$_POST['id_servicio']."' AND id_usuario = '".$_POST['id_usuario']."'  ");
		  	if (isset($_GET['entregado'])) {
		  		print "<script>window.location='../?mod=equipos_entregados&serv-agregado';</script>";
		  	}else{
		  		print "<script>window.location='../?mod=list_serv_tec&serv-agregado';</script>";
		  	}
		  
		}

	//Lista de Equipos por entregar
	@$list_equipos_entregar= mysqli_query($conexion, "SELECT * FROM servicio_tec ST INNER JOIN usuarios U,clientes C,tipo_servicio_tec TS, estatus E WHERE ST.id_usuario = U.id_usuario AND ST.id_cliente= C.id_cliente AND ST.id_tipo_serv = TS.id_tipo_ser AND ST.estatus = E.id_estatus AND ST.id_usuario = '".$_SESSION['id_usu']."' AND E.id_estatus = 3 ORDER BY fecha_retiro DESC ");

	//Lista de Servicios tecnicos para el Adminstrador
	@$list_serv_administrador= mysqli_query($conexion, "SELECT * FROM servicio_tec ST INNER JOIN usuarios U,clientes C,tipo_servicio_tec TS, estatus E WHERE ST.id_usuario = U.id_usuario AND ST.id_cliente= C.id_cliente AND ST.id_tipo_serv = TS.id_tipo_ser AND ST.estatus = E.id_estatus ORDER BY id_servicio DESC "); 
	//Lista de Servicios tecnico con su Estatus para el Administrado y Cajero
	@$list_servicios_tec_adm= mysqli_query($conexion, "SELECT * FROM servicio_tec ST INNER JOIN usuarios U,clientes C,tipo_servicio_tec TS, estatus E WHERE ST.id_usuario = U.id_usuario AND ST.id_cliente= C.id_cliente AND ST.id_tipo_serv = TS.id_tipo_ser AND ST.estatus = E.id_estatus AND E.id_estatus < 3 ORDER BY id_servicio DESC ");

	// Buscar en la Lista de Servicios tecnicos para el Adminstrador
	if (isset($_POST['bsc_rep_trabajos'])) 
	{
		@$bsc_rep_serv_administrador= mysqli_query($conexion, "SELECT * FROM servicio_tec ST INNER JOIN usuarios U,clientes C,tipo_servicio_tec TS, estatus E WHERE ST.id_usuario = U.id_usuario AND ST.id_cliente= C.id_cliente AND ST.id_tipo_serv = TS.id_tipo_ser AND ST.estatus = E.id_estatus AND U.nombre_usu LIKE '%".$_POST['bsc_rep_trabajos']."%' OR ST.id_usuario = U.id_usuario AND ST.id_cliente= C.id_cliente AND ST.id_tipo_serv = TS.id_tipo_ser AND ST.estatus = E.id_estatus AND C.nit_cliente = '".$_POST['bsc_rep_trabajos']."' OR ST.id_usuario = U.id_usuario AND ST.id_cliente= C.id_cliente AND ST.id_tipo_serv = TS.id_tipo_ser AND ST.estatus = E.id_estatus AND ST.fecha_serv LIKE '%".$_POST['bsc_rep_trabajos']."%' ORDER BY id_servicio DESC ");
	}

	//Agregar nuevo Gasto
	if (isset($_POST['nuevo_gasto'])) {
		 mysqli_query($conexion,"INSERT INTO gastos(id_tipo_gasto, fecha_gasto, monto_gasto, descripcion_gasto) VALUES('".$_POST['tipo_gasto']."', '".$_POST['fecha_gasto']."', '".$_POST['monto_gasto']."', '".$_POST['descripcion_gasto']."') ");
		print "<script>window.location='../?mod=gastos&exito';</script>";
	}


	// Borrar un Gasto
	if(isset($_GET['borrar_gasto']))
		{
			$sql = "DELETE FROM gastos WHERE id_gasto='".$_GET['borrar_gasto']."'";
			$con = $conexion->query($sql);
			if($con !=null){
				print "<script>window.location='../?mod=gastos&exito1';</script>";
			}else{
				print "<script>window.location='../?mod=gastos&error';</script>";
			}
		}

	// Modifica Gastos
	if (isset($_POST['editar_gasto'])) {
		$mod_t_mascota=mysqli_query($conexion,"UPDATE gastos SET id_tipo_gasto = '".$_POST['tipo_gasto']."', fecha_gasto = '".$_POST['fecha_gasto']."', monto_gasto = '".$_POST['monto_gasto']."', descripcion_gasto = '".$_POST['descripcion_gasto']."' WHERE id_gasto = '".$_POST['id_gasto']."' ");
		if ($mod_t_mascota != NULL){
				print "<script>window.location='../?mod=gastos&exito';</script>";
		  	}else{
		  		print "<script>window.location='../?mod=gastos&error';</script>";
		  }
	}

	// Mesas
	$getTables=mysqli_query($conexion,"SELECT * FROM tables where state = 1 ORDER BY name ASC ");

	//Agregar una Mesa
	if (isset($_POST['agg_table'])){
		mysqli_query($conexion,"INSERT INTO tables(name,is_free,state) VALUES('".$_POST['nombre_table']."', '1', '1') ");
		header('Location: ../?mod=agg_table&exito');
	}
	// Borrar mesa
	if(isset($_GET['delete_table'])){
		$sql = "UPDATE tables SET state = 0 WHERE id='".$_GET['delete_table']."'";
		$con = $conexion->query($sql);
		if($con !=null){
			print "<script>window.location='../?mod=tables&exito';</script>";
		}else{
			print "<script>window.location='../?mod=tables&error';</script>";
		}
	}