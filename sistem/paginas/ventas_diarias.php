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
	     <small>Ventas Diarias</small>
	   </h1>
	   <ol class="breadcrumb">
	     <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
	     <li class="active">Ventas Diarias</li>
	   </ol>
	 </section>
	 <br>
	 <br>
    <!-- Main content -->
	<div class="col-md-12">
	   	<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Buscar Factura</h3>
            </div>
        	<div class="box-body">
	            <form method="post" action="?mod=busc_ventas">
                <div class="col-sm-6 col-lg-3 content-wrapper__field-row">
                  <input  type="date" class="form-control" name="bsc_ventas" required autofocus>
                </div>
	              <div class="col-sm-6 col-lg-3 content-wrapper__field-row">
	                <input  type="date" class="form-control" name="bsc_ventas2" value="<?php echo date('Y-m-d'); ?>" required autofocus>
	              </div>
                <div class="col-sm-6 col-lg-3 content-wrapper__field-row">
                        <input type="submit" value="Buscar" class="btn btn-info btn-flat">
                </div>
	             </form>

                <div class="content-wrapper__field-row col-sm-6 col-lg-3">
                <!--modal Busqueda -->
                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal" >Generar Reporte</button>
                </div>
              <!-- /input-group -->
        	</div>
            <!-- /.box-body -->
        </div>
	</div>
        <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 align="center" class="modal-title" id="exampleModalLabel">GANANCIAS E INVERSION</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="">
                  <form method="POST" action="php/reportespdf/reporte_intervalo.php?rep_intervalo">
                    <div class="form-group col-md-6">
                      <label for="recipient-name" class="col-form-label">Desde:</label>
                      <input type="date" name="desde" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="recipient-name" class="col-form-label">Hasta:</label>
                      <input type="date" name="hasta" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="recipient-name" required>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button target="_blank" type="button submit" class="btn btn-primary">Generar</button>
                    </div>   
                  </form>
                </div>
              </div>
            </div>
          </div>
        <!-- Fin Modal -->
    <!-- Listado de Facturas -->
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
           <div class="box box-info content-wrapper__table-container">
              <table class="table table-hover table-striped content-wrapper__table">
                <thead> 
                  <?php 
                  include 'php/query.php';
                  $n=1;
                  $query= $count_ventas;
                  if($query->num_rows>1):
                ?>
                  <tr>
                      <th scope="col">#</th>
            		      <th scope="col">Ventas del Día</th>
            		      <th scope="col">Articulos Vendidos</th>
            		      <th scope="col">Monto de Ventas</th>
            		          
                  </tr>
                  </tr>
                </thead>
                <tbody>

                  <?php 
                    require_once 'php/ventas_dia.php';
                    while ($f=$ventas_dia->fetch_array()):?>
                  <tr>  
                        <th scope="row"><?php echo $n++;?></th>
          				      <td><?php echo $f['fecha_salida'];?></td>
          				      <td><?php echo $f['cantidad_total'] . '   Unds';?></td>
          				      <td><?php echo '$ ' . number_format($f['monto_total'], 1) ;?></td>
                    <td>
                      <a target="_blank" title="Ver" href="php/reportesPdf/reporte_diario.php?ventas_dia&fecha=<?php echo $f['fecha_salida'];?>" class="btn btn-sm icon fa fa-search fa-lg"></a>
                    </td>
              
                    <?php  endwhile;?>
                    
                  </tr>     
                </tbody>
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
  </div>
