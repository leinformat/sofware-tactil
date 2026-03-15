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
          <small>Trabajos Realizados</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
          <li class="active">Trabajos Realizados</li>
        </ol>
  </section>
    <br>
   <br>
    <!-- Main content -->
  <div class="col-md-12">
      <div class="box box-info">
            <div class="box-header with-border">
              <a href="?mod=rep_trabajos"><button  type="button" class="close fa fa-lg fa-reply-all"></button></a>
              <h3 class="box-title">Buscar Servicio Tecnico</h3>
            </div>
          <div class="box-body">
              <form method="post" action="?mod=bsc_rep_trabajos">
                <div class="input-group input-group-sm col-md-6">
                  <input type="text" class="form-control" name="bsc_rep_trabajos" required placeholder=" NOMBRE DEL TECNICO, EL NIT DEL CLIENTE O LA FECHA DEL SERVICIO TECNICO a Buscar!">
                      <span class="input-group-btn">
                        <button type="button submit" class="btn btn-info btn-flat">Buscar!</button>
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
           <div class="box box-info">
              <table class="table table-striped table-hover">
                <thead> 
                  <?php 
                  include 'php/query.php';
                  $query= $bsc_rep_serv_administrador;
                  if($query->num_rows>0):
                ?>
                  <tr>
                    <th scope="col">Nro. Ref</th>
                    <th scope="col">Técnico</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Nit</th>
                    <th scope="col">Servicio Realizado</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Ingreso</th>
                    <th scope="col">Egreso</th>
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
                    <td><?php echo $f['fecha_retiro'];?></td>
                    <td><?php echo $f['nombre_status'];?></td>
                    <td><?php echo number_format($f['monto_total'],2).'$' ;?></td>
                    <?php $id_servicio=$f['id_servicio']; ?>
              <!--
                    <td>
                      <a href="#" id="del-<?php echo $f["id_reporte"];?>" class="btn btn-sm icon fa fa-trash fa-lg">
                      </a>
                      <a  href="?mod=cambiar_estatus_st&id-servicio=<?php echo $id_servicio;  ?>" class="btn btn-sm icon fa fa-edit fa-lg"> </a>
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
                 -->   
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