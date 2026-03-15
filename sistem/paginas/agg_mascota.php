<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<?php
@session_start();

// Optener el Numero de Factura Autoincrementable //
      include 'php/query.php';
      while ($n= $num_id_mascota->fetch_array()) {
             $num_identificacion = $n['id_mascota'];
  break; }
// </ Optener el Numero de Factura Autoincrementable //
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Agregar Mascota
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Nueva Mascota</li>
      </ol>
    </section><br>

    <!-- Menu -->
    <div class="col-md-12">
      <div class="box box-info">
            <a  href="?mod=mascotas">
              <div class="description-block row">
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-paw fa-lg"></i>
                    <span><b>Mascotas</b></span>
                    <span class="pull-right-container">
                    </span>
                </div>
            </a>
            <a class="active noHover" href="?mod=agg_mascota">
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-plus-square fa-lg"></i>
                    <span><b>Agregar Mascota</b></span>
                    <span class="pull-right-container">
                      <div class="hr"></div>
                    </span>
                </div>
            </a>
            <a class="<?php if ($_SESSION['rol'] != 'Veterinario'){echo 'hidden';} ?>" href="?mod=reg_consulta_mascota">
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-stethoscope fa-lg"></i>
                    <span><b>Nueva Consulta</b></span>
                    <span class="pull-right-container">
                    </span>
                </div>
            </a>
            
            <a class="" href="<?php if($_SESSION['rol'] !='Veterinario'){echo '?mod=list_hosp_adm';}else{ echo '?mod=list_hospitalizacion';} ?>">
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-hospital-o fa-lg"></i>
                    <span><b>Hospitalizacion</b></span>
                    <span class="pull-right-container">
                    </span>
                </div>
            </a>
            
            <a class="" href="<?php if($_SESSION['rol'] !='Veterinario'){echo '?mod=list_altas_adm';}else{ echo '?mod=altas_medicas';} ?>">
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-hospital-o fa-lg"></i>
                    <span><b>Altas Medicas</b></span>
                    <span class="pull-right-container">
                      <div class="hr"></div>
                    </span>
                </div>
            </a>
             
             <a href="?mod=tipo_mascota">
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-plus-circle fa-lg"></i>
                    <span><b>Tipos de Mascota</b></span>
                    <span class="pull-right-container">
                    </span>
                </div>
            </a>
                <br><br>
            </div>
        </div>
      </div>
      <!-- /.Menu -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="box box-info">
            <div align="center" class="box-header with-border">
              <a href="?mod=agg_cliente"><button  type="button" class="close fa fa-lg fa-user-plus">Agregar Dueño</button></a> 
              <h3 class="box-title">Ingresar Datos</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <form action="php/query.php" method="post">
                    <div class="col-xs-2">
                      <span><b>N° Identificacion</b></span>
                      <input type="text" readonly class="form-control" value="<?php echo str_pad($num_identificacion, 5,"0", STR_PAD_LEFT) ;?>" name="id_mascota" placeholder="Numero ID"  required autofocus="">
                    </div>

                    <div class="col-xs-2">
                      <span><b>Dueño</b></span>
                      <select class="form-control"  name="dueño_mascota"  required>
                           <?php include 'php/query.php'; ?>
                            <option value="">Seleccione un Dueño</option>
                             <!-- Bucle para extraer los Datos de las tabla Cliente -->
                            <?php while ($row=mysqli_fetch_array($buscar_cliente)): ?>
                            <option value="<?php echo $row['id_cliente']; ?>"><?php echo $row['nombre_cliente']." Nit/CC: ".$row['nit_cliente']; ?></option>
                            <?php endwhile; ?>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <span><b>Tipo de Mascota</b></span>
                      <select class="form-control"  name="tipo_mascota"  required>
                           <?php include 'php/query.php'; ?>
                            <option value="">Selecione el Tipo de Mascota</option>
                             <!-- Bucle para extraer los Datos de las tabla Tipo mascota -->
                            <?php while ($row=mysqli_fetch_array($tipo_mascota)): ?>
                            <option  name="" value="<?php echo $row['id_tipo_mascota']; ?>"><?php echo $row['nombre_tipo_mascota']; ?></option>
                            <?php endwhile; ?>
                      </select>
                    </div>

                    <div class="col-xs-2">
                      <span><b>Nombre</b></span>
                      <input type="text" class="form-control" name="nombre_mascota" placeholder="Escriba un Nombre" required>
                    </div>
                    <div class="col-xs-2">
                      <span><b>Fecha de Nacimiento</b></span>
                      <input type="date" class="form-control" name="fecha_nac_mascota" placeholder="Seleccione una Fecha" required>
                    </div>
                    <div class="col-xs-2">
                      <span><b>Color</b></span>
                      <input type="text" class="form-control" name="color_mascota" placeholder="Escriba El Color" required>
                    </div>
                    <br><br><br><br>
                    <div class="col-xs-2">
                      <span><b>Raza</b></span>
                      <input type="text" class="form-control" name="raza_mascota" placeholder="Escriba la Raza" required>
                    </div>

                    <div class="col-xs-2">
                      <span><b>Sexo</b></span>
                      <select class="form-control" name="sexo_mascota" id="" required>
                        <option value="">Selecione un Sexo</option>
                        <option value="hembra">Hembra</option>
                        <option value="macho">Macho</option>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <span><b>Peso (Mg o Kg)</b></span>
                      <input type="text" class="form-control" name="peso_mascota" placeholder="Escriba el Peso">
                    </div>
                    <div class="col-xs-2">
                      <span><b>Tamaño (Cm o Mt)</b></span>
                      <input type="text" class="form-control" name="tamaño_mascota" placeholder="Escriba el tamaño">
                    </div>

                    <div class="col-xs-4">
                      <span><b>Observaciones</b></span>
                      <textarea class="form-control" rows="3" name="observaciones" placeholder="Escriba alguna observacion o Caracteristicas de Su mascota"></textarea>
                    </div>

                      <br><br><br><br>
                    <div class="col-xs-4">
                        <input type="submit" name="agregar_mascota" value="Agregar" class="btn btn-primary"/>
                        <a href="?mod=mascotas"><input type="button" value="Cancelar" class="btn btn-success"/></a>
                        <br><br>
                    </div>
                </form>          
            </div>

            <!-- /.box-body -->
          </div>
              </div>
        </div>
      </section>
      <?php if (isset($_GET['exito_mod'])){
                          echo "<div class='col-md-6 alert alert-info alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-info'></i> Ha Sido Guardado Correctamente!</h4>
                  </div>";
                      }

                        if (isset($_GET['error_mod'])){
                            echo "<div class='col-md-6 alert alert-danger alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <h4><i class='icon fa fa-info'></i> Ocurrio un Error!</h4>
                    </div>";
                      }
                  ?>
    <!-- /.content -->
  </div>