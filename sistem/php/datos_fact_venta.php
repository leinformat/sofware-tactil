<?php

require '../conexion.php';
		if (isset($_GET['imprimir_venta'])) 
			{
				$query = "SELECT * FROM productos p  JOIN salida_productos_temp sp, clientes cl WHERE sp.id_producto= p.id_producto AND cl.id_cliente = sp.nombre_fact AND sp.id_usuario = '".$_GET['id_usuario']."'  ORDER BY nombre_producto ASC";
			}
		else
			{
				$query = 'SELECT * FROM productos  JOIN salida_productos, clientes, usuarios  WHERE salida_productos.id_producto = productos.id_producto AND clientes.id_cliente = salida_productos.nombre_fact AND usuarios.id_usuario = salida_productos.id_usuario   AND salida_productos.numero_fact = "'.$_GET["num_fact"].'" ORDER BY nombre_producto ASC ';
			}
		
		$list_productos = $conexion->query($query);
		$datos_cliente = $conexion->query($query);

		$num_fact = 0;
		$nombre=0;
		$nit =0;
		$direccion = 0;
		$telefono =0;
		$fecha =0; 
		$nombre_usu= 0;
		//$vendedor=0;
		while ($row=$datos_cliente->fetch_assoc())
			{
				$num_fact = $row['numero_fact'];
				$nombre= $row["nombre_cliente"];
				$nit= $row["nit_cliente"];
				$direccion= $row["dir_cliente"];
				$telefono= $row["tel_cliente"];
				$fecha= $row["fecha_salida"];
				$nombre_usu= $row["nombre_usu"];
				//$vendedor = $row['nombre_usu'];
			}