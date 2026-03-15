<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modificar Usuario
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Modificar Usuario</li>
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
				$usuario= '';
				$id_usuario= '';
        $nick='';
				$rol= '';
				$clave= '';
				$correo= '';
				$telefono= '';
				$nombre_rol='';
				$sql1= mysqli_query($conexion,"SELECT * FROM usuarios US JOIN roles RL WHERE US.id_rol = RL.id_rol AND  US.id_usuario = '".$_GET['editar_usuario']."' ");

				$row=mysqli_fetch_array($sql1);
				$id_usuario=$row['id_usuario'];
        $nick=$row['nick'];
				$usuario= $row['nombre_usu'];
				$rol= $row['id_rol'];
				$clave= $row['password'];
				$correo= $row['email'];
				$telefono=$row['telefono'];
				$nombre_rol=$row['nombre_rol'];
				?>


                <form action="php/query.php" method="post">
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Nick</b></span>
                      <input type="text" class="form-control" value="<?php echo $nick ; ?>"name="nick" placeholder="Contraseña" required>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                    	<!-- ID del Usuario -->
                    	<input type="text" name="id_usuario" class="form-control hidden " value="<?php echo $id_usuario; ?>">
                    	<!-- //ID del Usuario -->

                      <span><b>Nombre Usuario</b></span>
                      <input type="text" class="form-control" value="<?php echo $usuario; ?>" name="nom_usuario" placeholder="Nombre de Usuario"  required>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Contraseña</b></span>
                      <input type="text" class="form-control" value="<?php echo $clave ; ?>"name="clave_usuario" placeholder="Contraseña" required>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                    	<span><b>Nivel de Usuario</b></span>
                        <select class="form-control"  name="rol_usuario"  required>
                           <?php include 'php/query.php'; ?>
                            <option class="hidden" value="<?php echo $rol;?>"><?php echo $nombre_rol;?></option>
                             <!-- Bucle para extraer los Datos de las tabla tipo de Servicio Tecnico -->
                            <?php while ($row=mysqli_fetch_array($roles)): ?>
                            <option value="<?php echo $row['id_rol']; ?>"><?php echo $row['nombre_rol'];?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                                     
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                    	<span><b>Correo</b></span>
                        <input class="form-control" type="email" name="correo_usuario" value="<?php echo $correo ; ?>"/>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                    	<span><b>Telefono</b></span>
                        <input class="form-control" type="text" name="tel_usuario" value="<?php echo $telefono; ?>"/>
                    </div>
                    
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                        <input type="submit" name="modificar_usuario" value="Guardar Cambios" class="btn btn-primary"/>
                        <a href="?mod=adm_usuarios" type="button" class="btn btn-success"/>Cancelar</a>
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