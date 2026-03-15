<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<?php
@session_start();

// Optener el Numero de Servicio Tecnico Autoincrementable //
      include 'php/query.php';
      while ($n= $num_servicio->fetch_array()) {
             $num_serv = $n['id_serv'];
  break; }
// </ Optener el Numero de Factura Autoincrementable //
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Agregar Servico Técnico
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Agregar Servico Técnico</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="box box-info">
            <div align="center" class="box-header with-border">
              <a href="?mod=agg_cliente"><button  type="button" class="close fa fa-lg fa-user-plus">Nuevo Cliente</button></a>
              <h2 class="box-title">Ingresar Datos</h2>
            </div>
            <div class="box-body">
              <div class="row">
                <form action="php/query.php" method="post">
                    <div class="col-xs-3">

                      <!--Id Servicio Tecnico Autoincrementable -->
                      <input type="number" class="form-control hidden" name="id_serv" value="<?php echo $num_serv; ?>" required>

                      <!--Id Usuario -->
                      <input type="text" class="form-control hidden" name="id_usuario" value="<?php echo $_SESSION["id_usu"]; ?>" required>

                      <!--Estatus, Por defecto en Cero(por Revisar) -->
                      <input type="text" class="form-control hidden" name="estatus" value="1" required>

                      <!--Datos del Servicio Tecnico -->
                      <span><b>Nombre del Cliente</b></span>
                      <select autofocus class="form-control"  name="nombre_cliente"  required>
                           <?php include 'php/query.php'; ?>
                            <option value="">Seleccione un Cliente</option>
                             <!-- Bucle para extraer los Datos de las tabla Cliente -->
                            <?php while ($row=mysqli_fetch_array($buscar_cliente)): ?>
                            <option  name="" value="<?php echo $row['id_cliente']; ?>"><?php echo $row['nombre_cliente']." Nit/CC: ".$row['nit_cliente']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                      <span><b>Tipo de Servicio</b></span>
                      <select class="form-control"  name="servicio_tec"  required>
                           <?php include 'php/query.php'; ?>
                            <option value="">Seleccione el Servicio a Realizar</option>
                             <!-- Bucle para extraer los Datos de las tabla Cliente -->
                            <?php while ($row=mysqli_fetch_array($tipo_st)): ?>
                            <option  name="" value="<?php echo $row['id_tipo_ser']; ?>"><?php echo $row['nombre_tst']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="col-xs-3">
                      <span><b>Fecha</b></span>
                      <input type="date" class="form-control" name="fecha_st" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="col-xs-3">
                      <span><b>Abono</b></span>
                      <input type="number" class="form-control" name="abono_st" required placeholder="El cliente Abonó">
                    </div>
                    <br><br><br><br>
                    <div class="form-group col-xs-3">
                      <label>Equipo</label>
                      <input type="text" class="form-control" name="equipo_st" required placeholder=" Marca y Modelo del Equipo">
                    </div>
                    <div class="form-group col-xs-6">
                      <label>Descripción</label>
                      <textarea class="form-control" rows="2" name="desc_st" placeholder="Ingrese Tipo de Equipo, Accesorios y demas Caracteristicas"></textarea>
                    </div>
                      <br><br><br>
                    <div class="col-xs-2">
                        <input type="submit" name="agregar_servicio_tec" value="Agregar" class="btn btn-success"/>
                        <br><br>
                    </div>
                </form>          
            </div>

            <!-- /.box-body -->
          </div>
          <!-- Notificaciones -->
              </div>
              <?php if(isset($_GET["serv-agregado"])){
                            echo "<div class='alert alert-info alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-info'></i>Agregado Correctamente </h4>
                            </div>";
                         } ?>
        </div>
      </section>
    <!-- /.content -->
  </div>