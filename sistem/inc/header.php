<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<!-- sidebar-mini-expand-feature -->
<div class="wrapper ">
   <header class="main-header">
    <br><br>
    <nav class="navbar navbar-fixed-top ">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $total_vencidas; ?></span>
            </a>
            <ul class="dropdown-menu <?php if ($total_vencidas == 0){echo 'hidden';} ?>">
              <li class="header">Tienes <b style="color:#B10101; "><?php echo $total_vencidas ?></b> Facturas por Pagar Vencidas</li>
              <li>

                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php 
                  include 'php/query.php';
                  $n=1;
                  $query= $facturas_por_pagar;
                  if($query->num_rows>0):
                  
                   while ($f=$query->fetch_array()):
                    ?>
                  <li>
                    <a href="?mod=edit_fact_x_pagar&fact_por_pagar=<?php echo $f['numero_factura']; ?>&id_proveedor=<?php echo $f['id_proveedor']; ?>">
                      <i class="fa fa-file-text text-blue"></i><?php echo  $f['nombre_proveedor']; ?>
                    </a>
                  </li>
                  <?php  endwhile;?>
                  <?php endif;?>                    
                </ul>
              </li>
              <li class="footer"><a href="?mod=facturas_por_pagar">ir a Facturas por Pagar</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../imagenes/<?php echo $_SESSION['foto']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs">Usuario: <?php echo $_SESSION['usuario']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../imagenes/<?php echo $_SESSION['foto']; ?>" class="img-circle" alt="User Image">

                <p>
                  <span class="logo-lg"><b>Software</b>Lm'S</span>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="?mod=datos_usuario" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="../logout/logout.php" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class=""></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header> 
 
  <!-- Left side column. contains the logo and sidebar -->