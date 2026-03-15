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
	        <small>Equipos por Entregar</small>
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
	        <li class="active">Equipos por Entregar</li>
	      </ol>
	</section>
    <!-- Main content -->

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
           <div class="box box-info">
              <table class="table table-striped table-hover">
                <thead> 
                  <?php 
                  include 'php/query.php';
                  $n=1;
                  $query= $list_servicios_tec_adm;
                  if($query->num_rows>0):
                ?>
                  <tr>
                    <th scope="col">Nro. Referencia</th>
                    <th scope="col">Tecnico</th>
      				<th scope="col">Cliente</th>
                    <th scope="col">Nit</th>
      				<th scope="col">Servicio Realizado</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Ingreso</th>
      				<th scope="col">Estatus</th>
                    <th scope="col">Monto</th>      				      
                  </tr>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($f=$query->fetch_array()):?>
                  <tr>
                    <td align="center"><?php echo $f['id_servicio'];?></td>
                    <td><?php echo $f['nombre_usu'];?></td>     
      			    <td><?php echo $f['nombre_cliente'];?></td>
                    <td><?php echo $f['nit_cliente'];?></td>
      			    <td><?php echo $f['nombre_tst'];?></td>
                    <td><?php echo $f['descripcion'];?></td>                    
                    <td><?php echo $f['fecha_serv'];?></td>
                    <td><?php echo $f['nombre_status'];?></td>
                    <td><?php echo number_format($f['monto_total'],2).'$' ;?></td>
                    <?php $id_servicio=$f['id_servicio']; ?>
			      	
                    <td>
                    <!--
                      <a href="#" id="del-<?php echo $f["id_reporte"];?>" class="btn btn-sm icon fa fa-trash fa-lg">
                      </a>
                      <a  href="?mod=cambiar_estatus_st&id-servicio=<?php echo $id_servicio;  ?>" class="btn btn-sm icon fa fa-edit fa-lg"> </a>
					-->
                      <a  target="_blank" href="php/reportesPdf/reporte_equipo.php?imprimir=<?php echo $f['id_servicio'] ?>" class="btn btn-sm icon icon fa fa-print fa-lg"> </a>
                    </td>
                    <script>
                        $("#del-"+<?php echo $f["id_reporte"];?>).click(function(e){
                          e.preventDefault();
                          p = confirm("Estas seguro? Si Acepta Toda la informacion Relacionada Sera eliminada y no podra Recuperarse");
                          if(p){
                            window.location="php/query.php?eliminar-trabajo="+<?php echo $f["id_reporte"];?>;
                          }

                        });
                    </script>
                    <?php  endwhile;?>                    
                  </tr>     
                </tbody>
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