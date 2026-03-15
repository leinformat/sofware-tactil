<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	   <h1>
	     Reporte
	     <small>Prestamos</small>
	   </h1>
	   <ol class="breadcrumb">
	     <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
	     <li class="active">Prestamos</li>
	   </ol>
	 </section>
	 <br>
	 <br>
    <!-- Main content -->
	<div class="col-md-12">
	   	<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Buscar Tabajador</h3>
            </div>
        	<div class="box-body">
	            <form method="post" action="?mod=buscador_prestamo">
	              <div class="input-group input-group-sm col-md-6">
	                <input type="text" class="form-control" name="s" required placeholder="Buscar">
	                    <span class="input-group-btn">
	                      <button type="button submit" class="btn btn-info btn-flat" name="bsc_prestamo" >Buscar!</button>
	                    </span>
	              </div>
	             </form>
              <!-- /input-group -->
        	</div>
            <!-- /.box-body -->
        </div>
	</div>
    <section class="content">
      <div class="row">
        <div class="col-xs-12 " align="center"><br>
        <!-- Notificacion de Trabajo Eliminado -->	
        	<?php if (isset($_GET['exito'])){
                          echo "<div class='alert alert-info alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-info'></i> Ha Sido eliminado Correctamente!</h4>
                  </div>";
                      }

                        if (isset($_GET['error'])){
                            echo "<div class='alert alert-danger alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <h4><i class='icon fa fa-info'></i> Ocurrio un Error y el no pudo Ser Eliminado!</h4>
                    </div>";
                      }
                  ?>
           <div class="box box-danger">
              <table class="table table-hover">
                <thead> 
                  <?php 
                  include 'php/query.php';
                  $n=1;
                  $query= $rep_prestamos;
                  if($query->num_rows>0):
                ?>
                  <tr>
                      <th scope="col">#</th>
            		      <th scope="col">Nombre de Empleado</th>
            		      <th scope="col">Fecha</th>
            		      <th scope="col">Monto</th>
            		      <th scope="col">Acciones</th>
                  </tr>
                  </tr>
                </thead>
                <tbody>
                  <?php $suma=''; ?>
                  <?php while ($f=$query->fetch_array()):?>
                  <tr>
                    <th scope="row"><?php echo $n++;?></th>
				      <td><?php echo $f['nombre_empleado'];?></td>
				      <td><?php echo $f['fecha'];?></td>
				      <td><?php echo number_format($f['monto'],2) . " $";?></td>
			      		<?php $suma += $f['monto']; ?>
                    <td>
                      <a title="Eliminar" href="#" id="del-<?php echo $f["id_prestamo"];?>" class="btn btn-sm icon fa fa-trash fa-lg"></a>
                      <a href="#" id="del-<?php echo $f["id_prestamo"];?>" class="btn btn-sm icon fa fa-edit fa-lg"></a>
                    </td>
                    <script>
                        $("#del-"+<?php echo $f["id_prestamo"];?>).click(function(e){
                          e.preventDefault();
                          p = confirm("Estas seguro? Si Acepta Toda la informacion Relacionada Sera eliminada y no podra Recuperarse");
                          if(p){
                            window.location="php/query.php?cancelar-prestamo="+<?php echo $f["id_prestamo"];?>;
                          }

                        });
                    </script>
                    <?php  endwhile;?>
                    
                  </tr>     
                </tbody>
                <thead>
          		    <tr>
          		      <th scope="col">Total</th>
          		      <th scope="col"></th>
          		      <th scope="col"></th>
          		      <th scope="col"><?php echo  number_format($suma,2) ." $"; ?></th>
          		    </tr>
        		  </thead>
                <thead>
                  <tr>
                    <?php else:?>
                      <td class="row">
                        <p class="alert alert-success">No hay resultados</p>
                      </td>
                  
                  	<?php endif;?>
                 </tr>
                </thead>
              </table>
          </div>
        </div>
      </div>    
    </section>
    <!-- /.content -->
  </div>