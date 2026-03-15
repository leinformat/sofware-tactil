<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<?php
@session_start();
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Agregar Cliente
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Agregar Cliente</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="box box-info">
            <div align="center" class="box-header with-border">
              <h3 class="box-title">Ingresar Datos</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <form action="php/query.php" method="post">
                    <div class="col-xs-4">
                      <span><b>Nombre del Cliente</b></span>
                      <input autofocus type="text" class="form-control" name="nom_cliente" placeholder="Ingrese el Nombre"  required>
                    </div>
                    <div class="col-xs-4">
                      <span><b>Nit-CC</b></span>
                      <input type="text" class="form-control" name="nit_cliente" placeholder="Ingrese Nit o Cedula de Ciudadania"  required>
                    </div>
                    <div class="col-xs-4">
                      <span><b>Telefono</b></span>
                      <input type="number" class="form-control" name="tel_cliente" placeholder="Ingese numero de Contacto">
                    </div>
                    <br><br><br><br>
                    <div class="col-xs-6">
                      <span><b>Direccion</b></span>
                      <input type="text" class="form-control" name="dir_cliente" placeholder="Ingrese la Dirección">
                    </div>
                    <div class="col-xs-6">
                      <span><b>Correo Electrónico</b></span>
                      <input type="email" class="form-control" name="correo_cliente" placeholder="Ingrese el Correo">
                    </div>
                      <br><br><br><br>
                    <div class="col-xs-6">
                        <input type="submit" name="agregar_cliente" value="Agregar" class="btn btn-info"/>
                        <a href="?mod=clientes"><input type="button" value="Cancelar" class="btn btn-success"/></a>
                        <br><br>
                    </div>
                </form>          
            </div>

            <!-- /.box-body -->
          </div>
          <!-- Notificaciones -->
              </div>
              <?php if(isset($_GET["cliente-agregado"])){
                            echo "<div class='alert alert-info alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-info'></i>Cliente Agregado Correctamente </h4>
                            </div>";
                         } ?>
        </div>
      </section>
    <!-- /.content -->
  </div>