<!--
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
 -->
	<script>
    		$(function(){
				// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
				$("#adicional").on('click', function(){
					$("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
				});
			 
				// Evento que selecciona la fila y la elimina 
				$(document).on("click",".eliminar",function(){
					var parent = $(this).parents().get(0);
					$(parent).remove();
				});
			});
		</script>
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header">
	      <h1>
	        Servicios Técnicos
	        <small></small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
	        <li class="active">Servicios Técnicos</li>
	      </ol>
	    </section>
	    <br><br>
	    <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Seleccionar Cliente</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-6">
                    <select class="form-control" name="id_cliente" required>
                    	<?php include 'php/query.php'; ?>
                    		<option value="">Seleccione el Cliente</option>

                    		<!-- Bucle para extraer los Datos de las tabla nombre_empleados -->
                    		<?php while ($row=mysqli_fetch_array($list_clientes)): ?>
                    		<option value="<?php echo $row['id_cliente']; ?>"><?php echo $row['nombre_cliente']; ?></option>
							<?php endwhile; ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info">Buscar</button>
              </div>
              <!-- /.box-footer -->
            </form><br><br>
            <?php if (isset($_POST['id_cliente'])): ?>

            	<?php
            		$con=mysqli_query($conexion,"SELECT * FROM clientes WHERE id_cliente = '".$_POST['id_cliente']."' ");
            		$cliente=mysqli_fetch_array($con);
            		$nombre_cliente=$cliente['nombre_cliente'];
            		$nit_cliente=$cliente['nit_cliente'];
            	 ?>
				<div class="box box-danger">
					 <div class="<?php echo $cliente; ?>">
					 	<div class="box-header with-border ">
			              <h3 class="box-title">Trabajos Realizados Por: <?php echo $nombre_cliente.$nit_cliente ; ?></h3>
			              <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg">Ir</button>
			            </div>
					 </div>
					</div>

            <?php endif ?>
          </div>
        </div>
     </div>
