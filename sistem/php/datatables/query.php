<!-- 
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
 --> 
<?php 

require_once "../../php/conexion.php";
session_start();
//Listado de Productos en Inventario
$inventario="SELECT P.id_producto, P.cod_producto, P.nombre_producto, C.nombre_cat, P.cantidad, P.precio_compra, P.precio_unid FROM productos P JOIN categorias C WHERE P.id_categoria = C.id_categoria AND P.cantidad > 0 AND C.nombre_cat NOT LIKE '%servicio%' AND estado_producto = 1 ORDER BY P.nombre_producto ASC ";

//Listados de Productos Agotados
$agotadosInv="SELECT P.id_producto, P.cod_producto, P.nombre_producto, C.nombre_cat, P.cantidad, P.precio_compra, P.precio_unid FROM productos P JOIN categorias C WHERE P.id_categoria = C.id_categoria AND P.cantidad <= 0 AND estado_producto = 1 ORDER BY P.nombre_producto ASC ";

//Listados de Productos Agotados
$deltedProducts="SELECT P.id_producto, P.cod_producto, P.nombre_producto, C.nombre_cat, P.cantidad, P.precio_compra, P.precio_unid FROM productos P JOIN categorias C WHERE P.id_categoria = C.id_categoria AND estado_producto < 1 ORDER BY P.nombre_producto ASC ";

//SERVICIOS
$servicios="SELECT P.id_producto, P.cod_producto, P.nombre_producto, C.nombre_cat, P.precio_unid FROM productos P JOIN categorias C WHERE P.id_categoria = C.id_categoria AND C.nombre_cat LIKE '%servicio%' ORDER BY P.nombre_producto ASC ";

//Listado de Equipos por entregar
@$equipos_x_entregar ="SELECT ST.id_servicio, C.nombre_cliente, C.nit_cliente, C.tel_cliente, ST.descripcion, ST.fecha_serv, E.nombre_status, ST.monto_total FROM servicio_tec ST INNER JOIN usuarios U,clientes C,tipo_servicio_tec TS, estatus E WHERE ST.id_usuario = U.id_usuario AND ST.id_cliente= C.id_cliente AND ST.id_tipo_serv = TS.id_tipo_ser AND ST.estatus = E.id_estatus AND ST.id_usuario = '".$_SESSION['id_usu']."' AND E.id_estatus < 3 ORDER BY ST.id_servicio DESC ";

//Listado de Equipos por entregar
@$equipos_entregados ="SELECT ST.id_servicio, C.nombre_cliente, C.nit_cliente, C.tel_cliente, ST.descripcion, ST.fecha_serv, E.nombre_status, ST.monto_total FROM servicio_tec ST INNER JOIN usuarios U,clientes C,tipo_servicio_tec TS, estatus E WHERE ST.id_usuario = U.id_usuario AND ST.id_cliente= C.id_cliente AND ST.id_tipo_serv = TS.id_tipo_ser AND ST.estatus = E.id_estatus AND ST.id_usuario = '".$_SESSION['id_usu']."' AND E.id_estatus = 3 ORDER BY ST.id_servicio DESC ";

//Listado de Clientes
$clientes ="SELECT id_cliente,nombre_cliente,nit_cliente,tel_cliente,email_cliente,dir_cliente FROM clientes ORDER BY nombre_cliente ASC ";

//Listado de Proveedores
$proveedores ="SELECT id_proveedor,nombre_proveedor,nit_proveedor,tel_proveedor,email_proveedor,dir_proveedor FROM proveedores ORDER BY nombre_proveedor ASC ";

//Listado de Clientes
$facturas_venta ="SELECT SP.numero_fact, C.nombre_cliente, C.nit_cliente, SP.fecha_salida FROM salida_productos SP INNER JOIN  clientes C WHERE C.id_cliente = SP.nombre_fact  GROUP BY SP.numero_fact HAVING COUNT(*)>=1 ORDER BY SP.numero_fact DESC";
