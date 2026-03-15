<?php 
	include 'conexion.php'; 

		// Bussqueda de Producto en Ventas
		if (isset($_POST['search']))
		{
			$search = $conexion->real_escape_string($_POST['search']);
			$query= mysqli_query($conexion,"SELECT * FROM productos JOIN categorias WHERE productos.id_categoria = categorias.id_categoria AND productos.cantidad > 0 AND productos.nombre_producto LIKE '%$search%' AND productos.id_categoria OR productos.id_categoria = categorias.id_categoria AND productos.cantidad > 0 AND productos.cod_producto LIKE '%$search%' AND productos.id_categoria != 9 ORDER BY nombre_producto");
			/*
			$query= mysqli_query($conexion,"SELECT * FROM productos JOIN categorias WHERE productos.id_categoria = categorias.id_categoria AND productos.cantidad > 0 AND productos.nombre_producto AND productos.estado_producto = 1 LIKE '%$search%' OR productos.id_categoria = categorias.id_categoria AND productos.cantidad > 0 AND productos.cod_producto LIKE '%$search%' AND productos.estado_producto = 1  ORDER BY nombre_producto");
			*/
			while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
			echo "<p><a href='?mod=fact_empresas&producto=$row[nombre_producto]&id=$row[id_producto]&precio=$row[precio_unid]'>$row[nombre_producto] $row[cod_producto] $row[precio_unid]</a></p>";
			}
		}

		// Bussqueda de Producto en Compras
		if (isset($_POST['search_ingreso'])) 
		{
			$search_ingreso = $conexion->real_escape_string($_POST['search_ingreso']);
			$query= mysqli_query($conexion,"SELECT * FROM productos JOIN categorias WHERE productos.id_categoria = categorias.id_categoria AND productos.nombre_producto LIKE '%$search_ingreso%' AND productos.estado_producto = 1  OR productos.id_categoria = categorias.id_categoria AND productos.cod_producto LIKE '%$search_ingreso%' AND productos.estado_producto = 1 ORDER BY nombre_producto");

			while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
			echo "<p><a href='?mod=ing_pedido&producto=$row[nombre_producto]&id=$row[id_producto]'>$row[nombre_producto] $row[cod_producto]</a></p>";
			}
		}

		// Bussqueda de Productos en Planillas
		if (isset($_POST['search_planilla'])) 
		{
			$search_planilla = $conexion->real_escape_string($_POST['search_planilla']);
			$query= mysqli_query($conexion,"SELECT * FROM productos JOIN categorias WHERE productos.id_categoria = categorias.id_categoria AND productos.cantidad > 0 AND productos.nombre_producto LIKE '%$search_planilla%' AND productos.id_categoria OR productos.id_categoria = categorias.id_categoria AND productos.cantidad > 0 AND productos.cod_producto LIKE '%$search_planilla%' AND productos.id_categoria != 9 ORDER BY nombre_producto");

			while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
			echo "<p><a href='?mod=agg_planilla&producto=$row[nombre_producto]&id=$row[id_producto]&precio=$row[precio_unid]'>$row[nombre_producto] $row[cod_producto] $row[precio_unid]</a></p>";
			}
		}