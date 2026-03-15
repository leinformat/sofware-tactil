<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Gastos
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Editar Gasto</li>
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
        $query= mysqli_query($conexion,"SELECT * FROM gastos G JOIN categoria_gastos CG WHERE G.id_tipo_gasto = CG.id_cat_gasto AND  id_gasto = '".$_GET['editar_gasto']."' ");
            $r=$query->fetch_array();              
		  ?>
			       <form method="POST" action="php/query.php">
                    <div class=" col-sm-6 col-lg-4 content-wrapper__field-row">
                      <input type="text" name="id_gasto" class="hidden" value="<?php echo $r['id_gasto']; ?>" required>
                      <label for="recipient-name" class="col-form-label">FECHA:</label>
                      <input type="date" name="fecha_gasto" value="<?php echo $r['fecha_gasto']; ?>" class="form-control" id="recipient-name" required>
                    </div>

                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <label for="recipient-name" class="col-form-label">TIPO DE GASTO:</label>
                      <select class="form-control"  name="tipo_gasto"  required>
                           <?php include 'php/query.php'; ?>
                            <option value="<?php echo $r['id_tipo_gasto'] ?>"><?php echo $r['nombre_cat_gasto'] ?></option>
                             <!-- Bucle para extraer los Datos de la tabla Categoria_gasto -->
                            <?php while ($row=mysqli_fetch_array($tipo_gasto)): ?>
                            <option  name="" value="<?php echo $row['id_cat_gasto']; ?>"><?php echo $row['nombre_cat_gasto']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-6 col-lg-4 content-wrapper__field-row">
                      <label for="recipient-name" class="col-form-label">MONTO:</label>
                      <input type="number" value="<?php echo $r['monto_gasto'] ?>" name="monto_gasto" class="form-control" required>
                    </div>

                    <div class="form-group col-sm-6 col-lg-4 content-wrapper__field-row">
                      <label for="recipient-name" class="col-form-label">DESCRIPCION:</label>
                      <textarea class="form-control" rows="2" name="descripcion_gasto" placeholder="Ingrese la descripcion del Gasto realizado"><?php echo $r['descripcion_gasto'] ?></textarea>
                    </div>
                    
                    <div class="col-sm-12 col-lg-12 content-wrapper__field-row">
                      <a href="?mod=gastos" type="" class="btn btn-info">Cancelar</a>
                      <button  type="button submit" name="editar_gasto" class="btn btn-primary">Guardar</button>
                    </div>   
                  </form>
            </div>
              </div>
            <!-- /.box-body -->
          </div>
        </div>
    </section>

    </section>
    <!-- /.content -->
  </div>