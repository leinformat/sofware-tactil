<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<?php 
@session_start();

// Optener el Numero de Factura Autoincrementable //
      include 'php/query.php';
      while ($n= $num_fact->fetch_array()) {
             $num_factura = $n['factura'];
  break; }
// </ Optener el Numero de Factura Autoincrementable //

//Mostrar el Nombre del Cliente
if (isset($_SESSION['nombre_cliente'])) {
  $sql=mysqli_query($conexion,"SELECT nombre_cliente,id_cliente, nit_cliente FROM clientes WHERE id_cliente = '".$_SESSION['nombre_cliente']."' ");
  $row=mysqli_fetch_array($sql);
  $cliente= $row['nombre_cliente'];
  $id_cliente=$row['id_cliente'];
  $nit_cliente=$row['nit_cliente'];
}

?>
<div class="content-wrapper">
  <div class="pos">
  
  <!-- TOP BAR -->
  <header class="topbar">
    <div class="left top-bar-icon__clock">00:00 PM</div>
  </header>
  <!-- MAIN -->
  <div class="main-restaurant">
    <!-- CENTER -->
    <main class="tables-section">
      <div class="tabs">
      </div>
      <div class="grid">
        <div class="card">
        </div>
      </div>
    </main>
  </div>
</div>
</div>

<link rel="stylesheet" href="../css/tables.css">
<script type="module" src="../js/tables.js"></script>