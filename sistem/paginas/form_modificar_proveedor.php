<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Datos de Proveedor
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Editar Datos de Proveedor</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="box box-info">
            <div align="center" class="box-header with-border">
              <h3 class="box-title">Ingresar Nuevos Datos</h3>
            </div>
            <div class="box-body">
              <div class="row">


      <?php
        include "php/conexion.php";
        $nombre_proveedor= '';
        $id_proveedor= '';
        $nit_proveedor= '';
        $tel_proveedor= '';
        $email_proveedor= '';
        $dir_proveedor= '';
        $sql1= mysqli_query($conexion,"SELECT * FROM proveedores WHERE id_proveedor = '".$_GET['editar_proveedor']."' ");

        $row=mysqli_fetch_array($sql1);
        $id_proveedor=$row['id_proveedor'];
        $nombre_proveedor= $row['nombre_proveedor'];
        $nit_proveedor= $row['nit_proveedor'];
        $tel_proveedor= $row['tel_proveedor'];
        $email_proveedor= $row['email_proveedor'];
        $dir_proveedor=$row['dir_proveedor'];
        ?>
                <form action="php/query.php" method="post">
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <!-- ID del Usuario -->
                      <input type="text" name="id_proveedor" class="form-control hidden " value="<?php echo $id_proveedor ?>">
                      <!-- //ID del Usuario -->

                      <span><b>Nombre</b></span>
                      <input type="text" class="form-control" value="<?php echo $nombre_proveedor ?>" name="nombre_proveedor" placeholder="Nombre de Usuario"  required>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Nit</b></span>
                      <input type="text" class="form-control" value="<?php echo $nit_proveedor; ?>"name="nit_proveedor" placeholder="Contraseña" required>
                    </div>

                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Telefono</b></span>
                      <input type="text" class="form-control" value="<?php echo $tel_proveedor; ?>"name="tel_proveedor" placeholder="Contraseña" required>
                    </div>                   
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Correo</b></span>
                        <input class="form-control" type="email" name="email_proveedor" value="<?php echo $email_proveedor; ?>"/>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Direccion</b></span>
                        <input class="form-control" type="text" name="dir_proveedor" value="<?php echo $dir_proveedor ?>"/>
                    </div>
                    <div class="col-sm-12 col-lg-12 content-wrapper__field-row">
                        <input type="submit" name="modificar_proveedor" value="Guardar" class="btn btn-info"/>
                        <a href="?mod=proveedores"><input type="button" value="Cancelar" class="btn btn-success"/></a>
                    </div>
                </form>

            <!-- Notificaciones -->
              </div>
            <!-- /.box-body -->
          </div>
        </div>
    </section>

    </section>
    <!-- /.content -->
  </div>