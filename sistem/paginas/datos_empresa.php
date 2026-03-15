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
      $consulta = mysqli_query($conexion,"SELECT * FROM datos_empresa");
        $row =$consulta->fetch_array();
            $nit_empresa=$row['nit_empresa'];
            $nombre_empresa=$row['nombre_empresa'];
            $direccion_empresa= $row['direccion_empresa'];
            $telefono_empresa= $row['telefono_empresa'];
            $email_empresa= $row['email_empresa'];
            $descripcion_empresa= $row['descripcion_empresa'];
            $logo_empresa= $row['logo_empresa'];

      if (isset($_POST['edit_empresa'])) {
          $edit_empresa = mysqli_query($conexion,"UPDATE datos_empresa SET nit_empresa = '".$_POST['nit_empresa']."', nombre_empresa = '".$_POST['nombre_empresa']."',direccion_empresa = '".$_POST['direccion_empresa']."', telefono_empresa = '".$_POST['telefono_empresa']."', email_empresa = '".$_POST['email_empresa']."',descripcion_empresa = '".$_POST['descripcion_empresa']."' ");

          print "<script>window.location='?mod=datos_empresa&cambio_datos';</script>";
      }
  ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Datos de la Empresa
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Datos de Su Empresa</li>
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
              <div class="row text-uppercase content-wrapper__form-container">
                <form action="?mod=datos_empresa" method="post">
                    <div class="form-group col-sm-6 col-lg-6 content-wrapper__field-row">
                      <span><b>Nombre</b></span>
                      <input type="text" class="form-control" value="<?php echo $nombre_empresa; ?>" name="nombre_empresa" placeholder="Ingrese Nombre de su Empresa"  required>
                    </div>
                    <div class="form-group col-sm-6 col-lg-6 content-wrapper__field-row">
                      <span><b>Nit</b></span>
                      <input type="text" class="form-control" value="<?php echo $nit_empresa; ?>" name="nit_empresa" placeholder="Ingrese el Nit de su Empresa"  required>
                    </div>
                    <div class="form-group col-sm-6 col-lg-6 content-wrapper__field-row">
                      <span><b>Correo</b></span>
                      <input type="email" class="form-control" value="<?php echo $email_empresa; ?>" name="email_empresa" placeholder="Ingrese el Correo de su Empresa">
                    </div>
                    <div class="form-group col-sm-6 col-lg-6 content-wrapper__field-row">
                      <span><b>Telefonos</b></span>
                      <input type="text" class="form-control" value="<?php echo $telefono_empresa; ?>" name="telefono_empresa" placeholder="Ingrese el numero Telefonico de su Empresa"  required>
                    </div>
                    <div class="form-group col-sm-6 col-lg-6 content-wrapper__field-row">
                      <span><b>Dirección</b></span>
                      <textarea class="form-control" rows="3" name="direccion_empresa" placeholder="Ingrese la Direccion de su Empresa"  required><?php echo $direccion_empresa; ?></textarea>
                    </div>
                    <div class="form-group col-sm-6 col-lg-6 content-wrapper__field-row">
                      <span><b>Descripcion</b></span>
                      <textarea class="form-control" rows="3" name="descripcion_empresa" placeholder="Ingrese la Descripcion de su Empresa"  required><?php echo $descripcion_empresa; ?></textarea>
                    </div>
                    <div class="col-sm-12 col-lg-12 content-wrapper__field-row content-wrapper__field-row">
                        <input type="submit" name="edit_empresa" value="Actualizar Datos" class="btn btn-info"/>
                    </div>
                </form>
                <form action="php/subir_imagen.php" method="post" enctype="multipart/form-data">
                      <input type="text" class="form-control hidden" value="<?php echo $id; ?>" name="id_usuario">
                      <div class="form-group col-sm-6 col-lg-4 content-wrapper__field-row">
                      <label required for="exampleInputFile">Cambiar Imagen</label>
                      <input name="imagen" type="file" id="exampleInputFile">
                    </div>
                    <div class="image col-sm-12 col-lg-4 content-wrapper__field-row">
                      <img width="100px" src="../imagenes/<?php echo $logo_empresa; ?>" class="img-circle img-responsive" alt="User Image">
                    </div>
                    
                    <div class="col-sm-12 col-lg-12 content-wrapper__field-row">
                        <input type="submit" name="edit_empresa" value="Actualizar Imagen" class="btn btn-info"/>
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
                    if(isset($_GET["error2"])){
                            echo "<div class='alert alert-danger alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-danger'></i>Error.! Imagen demasiado grande. (LAS IMAGENES DEBEN TENER UN MAXIMO DE 2MB)</h4>
                            </div>";
                          } 
              ?>

        </div>
      </section>
    <!-- /.content -->
  </div>