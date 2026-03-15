<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
 <?php
    require_once 'php/conexion.php';
    $nombre = '';
    $clave = '';
    $id= 0;
    $foto= '';
      $consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE nombre_usu = '".$_SESSION['usuario']."' ");
        while ($row =$consulta->fetch_array()) {
            $nombre=$row['nombre_usu'];
            $clave=$row['password'];
            $id= $row['id_usuario'];
            $foto= $row['foto_usu'];
            $telefono= $row['telefono'];
            $correo= $row['email'];
        }

      if (isset($_POST['edit_usuario'])) {
          $edit_usuario = mysqli_query($conexion,"UPDATE usuarios SET nombre_usu = '".$_POST['nombre_usuario']."', password = '".$_POST['clave_usuario']."',email = '".$_POST['correo']."', telefono = '".$_POST['telefono']."' WHERE id_usuario = '".$_POST['id_usuario']."' ");

          print "<script>window.location='?mod=datos_usuario&cambio_datos';</script>";
      }
  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Datos de Usuario
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Datos de Usuario</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="box box-info">
            <div align="center" class="box-header with-border">
              <h3 class="box-title">Editar Datos</h3>
            </div>
            <div class="box-body">
              <div class="row content-wrapper__form-container">
                <form action="?mod=datos_usuario" method="post">
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <input type="text" class="form-control hidden" value="<?php echo $id; ?>" name="id_usuario">
                      <span><b>Nombre</b></span>
                      <input type="text" class="form-control" value="<?php echo $nombre; ?>" name="nombre_usuario" placeholder="Ingrese Nombre de Usuario"  required>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Contraseña</b></span>
                      <input type="text" class="form-control" value="<?php echo $clave; ?>" name="clave_usuario" placeholder="Ingrese su Nueva Contraseña"  required>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Correo</b></span>
                      <input type="email" class="form-control" value="<?php echo $correo; ?>" name="correo" placeholder="Ingrese su Nuevo Correo">
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Telefono</b></span>
                      <input type="text" class="form-control" value="<?php echo $telefono; ?>" name="telefono" placeholder="Ingrese su Nuevo Telefono">
                    </div>
                    <div class="col-sm-12 col-lg-12 content-wrapper__field-row">
                        <input type="submit" name="edit_usuario" value="Actualizar Datos" class="btn btn-info"/>
                    </div>
                </form>
                <form action="php/subir_imagen.php" method="post" enctype="multipart/form-data">
                    <input type="text" class="form-control hidden" value="<?php echo $id; ?>" name="id_usuario">
                      <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <label for="exampleInputFile">Cambiar Imagen</label>
                      <input name="imagen" type="file" id="exampleInputFile" required="">
                    </div>
                    <div class="image col-sm-6 col-lg-4 content-wrapper__field-row">
                      <img width="100px" src="../imagenes/<?php echo $foto; ?>" class="img-circle img-responsive" alt="User Image">
                    </div> 
                    <div class="col-sm-12 col-lg-12 content-wrapper__field-row">
                        <input type="submit" name="edit_usuario" value="Actualizar Imagen" class="btn btn-info"/>
                    </div>
                </form>


            </div>

            <!-- /.box-body -->
          </div>
          <!-- Notificaciones -->
              </div>
              <?php 
                    if(isset($_GET["cambio_datos"])){
                            echo "<div class='alert alert-info alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-info'></i>Información Actualizada Correctamente, los Cambios se aplicaran la Proxima vez que inicie Session</h4>
                            </div>";
                         }
                    if(isset($_GET["error1"])){
                            echo "<div class='alert alert-danger alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-danger'></i>Error al Actualizar la imagen.! Por favor Elija una opcion Valida</h4>
                            </div>";
                          }

              ?>
        </div>
      </section>
    <!-- /.content -->
  </div>