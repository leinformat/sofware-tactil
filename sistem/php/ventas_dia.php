<?php 
    $ventas_dia= mysqli_query($conexion,"SELECT p.nombre_producto, sp.fecha_salida, SUM(sp.cantidad) cantidad_total, SUM(sp.cantidad * sp.monto) monto_total FROM salida_productos sp JOIN productos p WHERE sp.id_producto = p.id_producto GROUP BY sp.fecha_salida HAVING COUNT(*)>=1 ORDER BY sp.fecha_salida DESC LIMIT 10");
    $gastos_dia= mysqli_query($conexion,"SELECT * FROM gastos G JOIN categoria_gastos CG WHERE G.id_tipo_gasto = CG.id_cat_gasto ORDER BY G.fecha_gasto DESC LIMIT 10");
