<!--
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
 -->
 <?php
//Si no se ha Iniciado Session Me redirige al Login
  include('php/conexion.php');
  session_start();
  include('../login/sesion.php');
///////////////////////////ACTUALIZAR PRODUCTOS A CERO/////////////////////
  mysqli_query($conexion, "UPDATE productos SET cantidad = 0 WHERE cantidad < 0");

///////////////////////////NOTIFICACION FACTURAS POR PAGAR/////////////////////
$coun_fact_vencida = mysqli_query($conexion,"SELECT COUNT(*)>= 1 FROM ing_productos WHERE plazo <= '".date('Y-m-d')."' AND estado = 'por pagar' GROUP BY numero_factura HAVING COUNT(*)>=1 ");
$total_vencidas = $coun_fact_vencida->num_rows;

  //Todas Las Paginas
  include 'inc/head.php';
  include 'inc/header.php';
  include 'inc/left_menu.php';
  include 'inc/opciones.php';
  include 'inc/modal.php';
  include 'inc/footer.php';
 ?>
