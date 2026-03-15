<?php 
	require '../conexion.php';
	
		$query = 'SELECT * FROM  productos pd  JOIN ing_productos ip  , proveedores pv  WHERE ip.id_producto = pd.id_producto AND ip.id_proveedor = pv.id_proveedor AND  ip.numero_factura = "'.$_GET['imprimir_compra'].'" ';
		$list_productos = $conexion->query($query);
		$datos_proveedor = $conexion->query($query);


		$num_fact = 0;
		$proveedor=0;
		$nit =0;
		$direccion = 0;
		$telefono =0;
		$fecha =0;
		
		// DATOS DE LA FACTURA DE COMPRA
			$row=$datos_proveedor->fetch_assoc();
				$num_fact = $row['numero_factura'];
				$proveedor= $row["nombre_proveedor"];
				$fecha= $row["fecha_pedido"];
				$nit= $row['nit_proveedor'];
				$direccion= $row['dir_proveedor'];
				$telefono= $row['tel_proveedor'];
			