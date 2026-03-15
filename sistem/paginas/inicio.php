<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 --> 
 <?php 
      require 'php/datos_empresa.php';
      require 'php/conexion.php';
      require 'php/ventas_dia.php';
      $consulta = mysqli_query($conexion,"SELECT foto_usu, nombre_usu, email FROM usuarios WHERE nombre_usu = '".$_SESSION['usuario']."' ");
      $row = $consulta->fetch_array();
      $row1 = $ventas_dia->fetch_array();   
  ?>

<style>
  .data__session{
    max-width: 250px;
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    padding: 20px;
    background-color:#1b3158d1;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  }
</style>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inicio
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Panel de Control</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div  class="widget-user-header bg-black " style="height: 465px;background: url('../imagenes/sistem.jpg')">
              <div class="data__session">
                <h3 class="widget-user-username"><?php echo $row['nombre_usu']; ?></h3>
                <h5 class="widget-user-desc"><?php echo $row['email']; ?></h5>
                <h5 class="widget-user-desc"><?php echo date('d-M-Y'); ?></h5>
              </div>
              
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="../imagenes/<?php echo $row['foto_usu']; ?>" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-2">
                  <div class="description-block">
                    <i ></i>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-2 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo '$ ' . number_format(@$row1['monto_total'], 1); ?></h5>
                    <span class="description-text">VENTAS DEL DÍA</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-1">
                  <div class="description-block">
                    <i class="icon fa fa-money fa-3x fa-lg" style="color: #009551;"></i>
                  </div>
                  <!-- /.description-block -->
                </div>

                <div class="col-sm-1">
                  <div class="description-block">
                    <i ></i>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo number_format(@$row1['cantidad_total'], 0) . "  Unds"; ?></h5>
                    <span class="description-text">PRODUCTOS VENDIDOS HOY</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-1">
                  <div class="description-block">
                    <i class="icon fa fa-shopping-cart fa-3x fa-lg" style="color: #F39C12;"></i>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Inventario</h3>

            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="?mod=inventario" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Nueva Venta</h3>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="?mod=fact_empresas" class="small-box-footer">Ir<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Fact. Compra</h3>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="?mod=rep_facturas_compra" class="small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Fact. Venta</h3>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="?mod=rep_facturas_venta" class="small-box-footer">Mas Informacion<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </section>
    <!-- /.content -->
  </div>
  