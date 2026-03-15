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
       Agregar Usuario
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Agregar Usuario</li>
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
                      <span><b>Nick</b></span>
                      <input type="text" class="form-control" name="nick" placeholder="Nombre para iniciar sesion"  required>
                    </div>
                    <div class="col-xs-4">
                      <span><b>Nombre del Usuario</b></span>
                      <input type="text" class="form-control" name="nom_usuario" placeholder="Ingrese Nombre"  required>
                    </div>
                    <div class="col-xs-4">
                      <span><b>Contraseña</b></span>
                      <input type="text" class="form-control" name="clave_usuario" placeholder="Ingrese una Contraseña" required>
                    </div><br><br><br><br>
                    <div class="col-xs-4">
                      <span><b>Tipo de Usuario</b></span>
                      <select class="form-control"  name="rol_usuario"  required>
                           <?php include 'php/query.php'; ?>
                            <option value="">Selecione un Nivel de Usuario</option>
                             <!-- Bucle para extraer los Datos de las tabla Cliente -->
                            <?php while ($row=mysqli_fetch_array($roles)): ?>
                            <option  name="" value="<?php echo $row['id_rol']; ?>"><?php echo $row['nombre_rol']; ?></option>
                            <?php endwhile; ?>
                      </select>
                    </div>
                    
                    <div class="col-xs-4">
                      <span><b>Telefono</b></span>
                      <input type="number" class="form-control" name="tel_usuario" placeholder="Ingese numero de Contacto">
                    </div>
                    <div class="col-xs-4">
                      <span><b>Correo</b></span>
                      <input type="email" class="form-control" name="correo_usuario" placeholder="Ingrese correo Electronico">
                    </div>
                    <br><br><br><br>
                    <div class="col-xs-2">
                        <input type="submit" name="agregar_usuario" value="Agregar" class="btn btn-success"/>
                        <br><br>
                    </div>
                </form>          
            </div>

            <!-- /.box-body -->
          </div>
              </div>
        </div>
      </section>
    <!-- /.content -->
  </div>