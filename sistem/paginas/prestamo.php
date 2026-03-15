<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
		<section class="content-header">
	      <h1>
	         Reporte<small> Prestamos</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
	        <li class="active">Reporte de Trabajadores</li>
	      </ol>
	    </section>
	    <br><br>
	    <!-- Horizontal Form -->
	    <div class="col-md-8 center">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Registro de Prestamos</b></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" value="" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="id_empleado" id="" required>
                    	<?php include 'php/query.php'; ?>
                    		<option value="">Seleccione un Trabajador</option>
                    		<!-- Bucle para extraer los Datos de las tabla nombre_empleados -->
                    		<?php while ($row=mysqli_fetch_array($trabajo)): ?>
                    		<option value="<?php echo $row['id_empleado']; ?>"><?php echo $row['nombre_empleado']; ?></option>
						        	<?php endwhile; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Fecha</label>

                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="fecha" id="inputPassword3" placeholder="Password" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Monto</label>

                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="monto" id="inputPassword3" placeholder="$" required>
                  </div>
                </div>
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button name="prestamo" type="submit" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <?php include 'php/prestamos.php'; ?>
          <!-- /.box -->
       </div>
</div>