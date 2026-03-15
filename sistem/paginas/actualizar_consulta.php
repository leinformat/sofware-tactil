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
      Actualizar Consulta
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Actualizar Consulta</li>
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
            <a class="" href="?mod=agg_mascota">
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-plus-square fa-lg"></i>
                    <span><b>Agregar Mascota</b></span>
                    <span class="pull-right-container">
                    </span>
                </div>
            </a>
            <a class="<?php if($_SESSION['rol']!='Veterinario'){echo 'hidden';}?>" href="?mod=reg_consulta_mascota">
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-stethoscope fa-lg"></i>
                    <span><b>Nueva Consulta</b></span>
                    <span class="pull-right-container">
                      <div class="hr"></div>
                    </span>
                </div>
            </a>
            <a class="" href="<?php if($_SESSION['rol'] !='Veterinario'){echo '?mod=list_hosp_adm';}else{ echo '?mod=list_hospitalizacion';} ?>" >
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-hospital-o fa-lg"></i>
                    <span><b>Hospitalizacion</b></span>
                    <span class="pull-right-container">
                    </span>
                </div>
            </a>

            <a class="active noHover" href="?mod=reg_consulta_mascota">
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-credit-card fa-lg"></i>
                    <span><b>Actualizar Consulta</b></span>
                    <span class="pull-right-container">
                      <div class="hr"></div>
                    </span>
                </div>
            </a>  
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-money fa-lg"></i>
                    <span><b>Enlace</b></span>
                    <span class="pull-right-container">
                    </span>
                </div>

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
              <a href="#"><button  type="button" class="close fa fa-lg fa-user-md">Médico: <?php if(isset($_GET['medico'])){echo $_GET['medico'];}  ?></button></a>
              <h2 class="box-title">Ingresar Datos</h2>
            </div>
            <div class="box-body">
              <div class="agg-consulta row">
                
                    <div class="col-xs-2">
                      <span><b>N° Id</b></span>
                      <input type="text" readonly class="form-control" name="fecha_st" value="<?php if(isset($_GET['id_mascota'])){echo $_GET['id_mascota'];}  ?>" required>
                    </div>


                    <div class="col-xs-2">
                      <span><b>Nombre</b></span>
                      <input type="text" readonly class="form-control" name="fecha_st" value="<?php if(isset($_GET['nombre_mascota'])){echo $_GET['nombre_mascota'];}  ?>" required>
                    </div>
                    <div class="col-xs-2">
                      <span><b>Dueño</b></span>
                      <input type="text" readonly class="form-control" name="fecha_st" value="<?php if(isset($_GET['dueno_mascota'])){echo $_GET['dueno_mascota'];}  ?>" required>
                    </div>

                    <div class="col-xs-2">
                      <span><b>Especie</b></span>
                      <input type="text" readonly class="form-control" name="fecha_st" value="<?php if(isset($_GET['tipo'])){echo $_GET['tipo'];}  ?>" required>
                    </div>

                    <div class="col-xs-2">
                      <span><b>Raza</b></span>
                      <input type="text" readonly class="form-control" name="fecha_st" value="<?php if(isset($_GET['raza'])){echo $_GET['raza'];}  ?>" required>
                    </div>

                    <div class="col-xs-2">
                      <span><b>Edad</b></span>
                      <input type="text" readonly class="form-control" name="fecha_st" value="<?php if(isset($_GET['edad'])){echo $_GET['edad'];}  ?>" required>
                    </div>

                    <div class="col-xs-2">
                      <span><b>Sexo</b></span>
                      <input type="text" readonly class="form-control" name="fecha_st" value="<?php if(isset($_GET['sexo'])){echo $_GET['sexo'];} ?>" required>
                    </div>

                    <div class="col-xs-2">
                      <span><b>Peso</b></span>
                      <input type="text" readonly class="form-control" name="fecha_st" value="<?php if(isset($_GET['peso'])){echo $_GET['peso'];} ?>" required>
                    </div>

                    <div class="col-xs-2">
                      <span><b>Tamaño</b></span>
                      <input type="text" readonly class="form-control" name="fecha_st" value="<?php if(isset($_GET['tamano'])){echo $_GET['tamano'];} ?>" required>
                    </div>
              
                    <div class="col-xs-4">
                      <span><b>Fecha Ingreso</b></span>
                      <input type="date" class="form-control" readonly name="fecha_consulta" value="<?php if(isset($_GET['fecha'])){echo $_GET['fecha'];} ?>" required>
                    </div>
                    <br><br><br><br><br><br><br>
                 <form class="" action="php/query.php" method="post">
                  <div class="form-group col-xs-3">
                      <!--Id Consulta -->
                      <input value="<?php echo $_GET['id_consulta_vet'];?>" class="hidden" name="id_consulta_vet" type="text">

                      <input type="date" value="<?php echo date('Y-m-d'); ?>" class="hidden" name="fecha_alta" type="text">

                      
                      <label>SINTOMAS</label>
                      <textarea class="form-control"  name="sintomas_mascota" placeholder="Por Favor Ingrese los sintomas la Mascota"><?php if(isset($_GET['sintomas'])){echo $_GET['sintomas'];} ?></textarea>
                    </div>
                    <div class="form-group col-xs-3">
                      <label>OBSERVACIONES</label>
                      <textarea class="form-control" rows="3" name="observaciones__mascota" placeholder="Por Favor Ingrese las Observaciones"><?php if(isset($_GET['observaciones'])){echo $_GET['observaciones'];} ?></textarea>
                    </div>
                    <div class="form-group col-xs-3">
                      <label>DIAGNOSTICO</label>
                      <textarea class="form-control" rows="3" name="diagnostico_mascota" placeholder="Por Favor Ingrese el diagnostico de La Consulta"><?php if(isset($_GET['diagnostico'])){echo $_GET['diagnostico'];} ?></textarea>
                    </div>
                    <div class="form-group col-xs-3">
                      <label>FORMULA MEDICA</label>
                      <textarea class="form-control" rows="3" name="formula_medica_mascota" placeholder="Por Favor Ingrese los Farmacos o alguna otra Formula Medica administrada a la Mascota"><?php if(isset($_GET['formula_medica'])){echo $_GET['formula_medica'];} ?></textarea>
                    </div>
                      <br><br><br><br>
                  <!-- BOTONES DE EJECUCIONES -->
                    <div class="save col-xs-6 <?php  if($_SESSION['rol']!='Veterinario'){echo 'hidden';} ?>">
                        <button aria-hidden="true" class="btn btn-primary fa fa-save fa-3x fa-lg cssToolTip" type="submit" name="actualizar_consulta"><span>Actualizar Datos</span></button>
                         
                        <button  aria-hidden="true"  class="btn btn-primary fa fa-wheelchair-alt fa-3x fa-lg cssToolTip" type="submit" name="dar_alta_medica"><span>Dar de Alta</span></button>

                        <a href="?mod=list_hospitalizacion" aria-hidden="true" class="btn btn-primary fa fa-close fa-3x fa-lg cssToolTip" type="submit"><span>Cancelar</span></a>
                        <br><br>
                    </div>
                  <!--/ BOTONES DE EJECUCIONES -->
              </form>          
            </div>

            <!-- /.box-body -->
          </div>
          <!-- Notificaciones -->
              </div>
              <?php if(isset($_GET["consulta-agregada"])){
                            echo "<div class='alert alert-info alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-info'></i>Agregado Correctamente </h4>
                            </div>";
                         }

                    if(isset($_GET["consulta-error"])){
                            echo "<div class='alert alert-danger alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-info'></i>Ocurrio un Error al intentar Registrar los Daros</h4>
                            </div>";
                         }
                          ?>
        </div>
      </section>
    <!-- /.content -->
  </div>