<!-- 
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div style="top: -50px;" class="navbar navbar-fixed-top ">
      <aside class="main-sidebar ">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar sidebar-fixed-top ">
      <!-- Sidebar user panel -->
      <div style="background: #3C8DBC; height: 50px; font-size: 20px;" class="user-panel first">
        <div style="left:0px ;" class="pull-left info">
          <p>InfoLmTec</p>
        </div>
      </div><br>
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../imagenes/<?php echo $_SESSION['foto']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Software de Gestión</p>
          <a href="#"><i class="fa fa-circle text-success"></i> En Linea</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul style="top: 40px;" class="sidebar-menu navbar" data-widget="tree">
        <li>
          <a href="?mod=inicio">
            <i class="fa fa-dashboard fa-lg"></i> <span>Inicio</span>
          </a>
        </li>

<!-- //////////////////////////////////////////////////////////////// -->
        <li class="treeview <?php  if($_SESSION['rol'] != 'administrador' ){ echo 'hidden';} ?>">
          <a href="#">
            <i class="fa fa-edit fa-lg"></i>
            <span>Administrar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?mod=datos_empresa"><i class="fa fa-circle-o text-aqua"></i>Empresa</a></li>
            <li><a href="?mod=adm_usuarios"><i class="fa fa-circle-o text-aqua"></i>Usuarios</a></li>
            <li><a href="?mod=deletedProducts"><i class="fa fa-circle-o text-aqua"></i>Productos Eliminados</a></li>
            <li><a href="?mod=backup_db"><i class="fa fa-circle-o text-aqua"></i>Backup</a></li>
            <!-- <li><a href="?mod=planillas"><i class="fa fa-circle-o text-aqua"></i>Planillas</a></li> -->
          </ul>
        </li>

<!-- //////////////////////////////////////////////////////////////// -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart fa-lg"></i>
            <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?mod=ventas_diarias"><i class="fa fa-circle-o text-aqua"></i>Ventas Diarias</a></li>
            <li><a href="?mod=rep_facturas_venta"><i class="fa fa-circle-o text-aqua"></i>Facturas de Ventas</a></li>
            <li><a href="?mod=rep_facturas_compra"><i class="fa fa-circle-o text-aqua"></i>Facturas de Compras</a></li>
            <li><a href="?mod=gastos"><i class="fa fa-circle-o text-aqua"></i>Gastos</a></li>
          </ul>
        </li>



<!-- //////////////////////////////////////////////////////////////// -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart fa-lg"></i>
            <span>Ventas y Servicios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?mod=inventario"><i class="fa fa-circle-o text-red"></i>Inventario</a></li>
            <li><a href="?mod=ing_pedido"><i class="fa fa-circle-o text-red"></i>Ingreso de Productos</a></li>
            <!--
            <li><a href="?mod=salida_producto"><i class="fa fa-circle-o text-red"></i>Venta de Productos</a></li>
          -->
            <li><a href="?mod=fact_empresas"><i class="fa fa-circle-o text-red"></i>Ventas y Servicios</a></li>
            <li><a href="?mod=categoria"><i class="fa fa-circle-o text-red"></i>Categorias</a></li>
            <li><a href="?mod=clientes"><i class="fa fa-circle-o text-red"></i>Clientes</a></li>
            <li><a href="?mod=proveedores"><i class="fa fa-circle-o text-red"></i>Proveedores</a></li>
            <li><a href="?mod=restaurant"><i class="fa fa-circle-o text-red"></i>Restaurante</a></li>
            <li><a href="?mod=tables"><i class="fa fa-circle-o text-red"></i>Mesas</a></li>

          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
</div>
    