<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Datos del Cliente
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Editar Datos del Cliente</li>
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
        $nombre_cliente= '';
        $id_cliente= '';
        $nit_cliente= '';
        $tel_cliente= '';
        $email_cliente= '';
        $dir_cliente= '';
        $sql1= mysqli_query($conexion,"SELECT * FROM clientes WHERE id_cliente = '".$_GET['editar_cliente']."' ");

        $row=mysqli_fetch_array($sql1);
        $id_cliente=$row['id_cliente'];
        $nombre_cliente= $row['nombre_cliente'];
        $nit_cliente= $row['nit_cliente'];
        $tel_cliente= $row['tel_cliente'];
        $email_cliente= $row['email_cliente'];
        $dir_cliente=$row['dir_cliente'];
        ?>


                <form action="php/query.php" method="post">
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <!-- ID del Usuario -->
                      <input type="text" name="id_cliente" class="form-control hidden " value="<?php echo $id_cliente; ?>">
                      <!-- //ID del Usuario -->

                      <span><b>Nombre</b></span>
                      <input type="text" class="form-control" value="<?php echo $nombre_cliente; ?>" name="nombre_cliente" placeholder="Nombre de Usuario"  required>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Nit</b></span>
                      <input type="text" class="form-control" value="<?php echo $nit_cliente ; ?>"name="nit_cliente" placeholder="Contraseña" required>
                    </div>

                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Telefono</b></span>
                      <input type="text" class="form-control" value="<?php echo $tel_cliente ; ?>"name="tel_cliente" placeholder="Contraseña" required>
                    </div>                   
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Correo</b></span>
                        <input class="form-control" type="email" name="email_cliente" value="<?php echo $email_cliente ; ?>"/>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Direccion</b></span>
                        <input class="form-control" type="text" name="dir_cliente" value="<?php echo $dir_cliente; ?>"/>
                    </div>
                    <div class="col-sm-12 col-lg-12 content-wrapper__field-row">
                        <input type="submit" name="modificar_cliente" value="Guardar Cambios" class="btn btn-info"/>
                        <a href="?mod=clientes"><input type="button" value="Cancelar" class="btn btn-success"/></a>
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