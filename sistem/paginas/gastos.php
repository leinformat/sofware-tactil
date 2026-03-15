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
	     <small>Gastos Diarios</small>
	   </h1>
	   <ol class="breadcrumb">
	     <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
	     <li class="active">Gastos Diarios</li>
	   </ol>
	 </section>
	 <br>
	 <br>

    <!-- Panel content -->
      <div class="container col-md-12">
        <div class="panel-group">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <h4 class="panel-title">
                  <a data-toggle="collapse" class="btn btn-sm icon fa fa-money fa-lg" href="#collapse1"> Nuevo Gasto</a>
               </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
               <div class="panel-body">
                  <form method="POST" action="php/query.php">

                    <div class="form-group col-md-2">
                      <label for="recipient-name" class="col-form-label">FECHA:</label>
                      <input type="date" name="fecha_gasto" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="recipient-name" required>
                    </div>

                    <div class="col-xs-3">
                      <label for="recipient-name" class="col-form-label">TIPO DE GASTO:</label>
                      <select class="form-control"  name="tipo_gasto"  required>
                           <?php include 'php/query.php'; ?>
                            <option value="">Seleccione el Servicio a Realizar</option>
                             <!-- Bucle para extraer los Datos de las tabla Cliente -->
                            <?php while ($row=mysqli_fetch_array($tipo_gasto)): ?>
                            <option  name="" value="<?php echo $row['id_cat_gasto']; ?>"><?php echo $row['nombre_cat_gasto']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                      <label for="recipient-name" class="col-form-label">MONTO:</label>
                      <input type="number" name="monto_gasto" value="<?php echo date('Y-m-d'); ?>" class="form-control" required>
                    </div>

                    <div class="form-group col-xs-5">
                      <label for="recipient-name" class="col-form-label">DESCRIPCION:</label>
                      <textarea class="form-control" rows="2" name="descripcion_gasto" placeholder="Ingrese la descripcion del Gasto realizado"></textarea>
                    </div>
                    
                    <div class="col-xs-12">
                      <button type="reset" class="btn btn-info">Limpiar</button>
                      <button  type="button submit" name="nuevo_gasto" class="btn btn-primary">Guardar</button>
                    </div>   
                  </form>
               </div>
               
               </div>
           </div>
         </div>
      </div>

    <!-- Listado de Facturas -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 " align="center"><br>
        <!-- Notificacion de Trabajo Eliminado -->	
        	<?php if (isset($_GET['exito'])){
                          echo "<div class='alert alert-info alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-info'></i>Guaradado Correctamente!</h4>
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
            <div class="box-header with-border">
              <h3 class="box-title"><b>GASTOS DEL DÍA</b></h3>
            </div>
              <table class="table table-hover table-striped content-wrapper__table">
                <thead> 
                  <?php 
                  include 'php/ventas_dia.php';
                  $n=1;
                  $query= $gastos_dia;
                  if(@$query->num_rows>0):
                ?>
                  <tr>
                      <th scope="col">#</th>
            		      <th scope="col">FECHA</th>
            		      <th scope="col">TIPO</th>
            		      <th scope="col">MONTO</th>
                      <th scope="col">DESCRIPCIÓN</th>
            		          
                  </tr>
                  </tr>
                </thead>
                <tbody>

                  <?php 
                    require_once 'php/ventas_dia.php';
                    while ($f=$gastos_dia->fetch_array()):?>
                  <tr>  
                        <th scope="row"><?php echo $n++;?></th>
          				      <td><?php echo $f['fecha_gasto'];?></td>
          				      <td><?php echo $f['nombre_cat_gasto'];?></td>
                        <td><?php echo '$ ' . number_format($f['monto_gasto']) ;?></td>
          				      <td><?php echo $f['descripcion_gasto'];?></td>
                    <td>
                          <a title="Borrar" href="#" id="del-<?php echo $f["id_gasto"];?>" class="btn btn-sm icon fa fa-trash fa-lg">                        
                          </a>
                          <a title="Editar" href="?mod=form_modificar_gasto&editar_gasto=<?php echo $f['id_gasto']; ?>"  class="btn btn-sm icon fa fa-edit fa-lg">
                          </a>
                    </td>

                        <script>
                        $("#del-"+<?php echo $f["id_gasto"];?>).click(function(e){
                          e.preventDefault();
                          p = confirm("Estas seguro? Si Acepta Toda la informacion Relacionada Sera eliminada y no podra Recuperarse");
                          if(p){
                            window.location="php/query.php?borrar_gasto="+<?php echo $f["id_gasto"];?>;
                          }

                        });
                    </script>
              
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
