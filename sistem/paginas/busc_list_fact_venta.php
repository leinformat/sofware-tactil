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
       <small>Facturas de Venta</small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
       <li class="active">Facturas de Venta</li>
     </ol>
   </section>
   <br>
   <br>
    <!-- Main content -->
  <div class="col-md-12">
      <div class="box box-info">
            <div class="box-header with-border">
              <a href="?mod=rep_facturas_venta"><button  type="button" class="close fa fa-lg fa-reply-all"></button></a>
              <h3 class="box-title">Buscar Factura</h3>
            </div>
          <div class="box-body">
              <form method="post" action="?mod=busc_list_fact_venta">
                <div class="input-group input-group-sm col-md-6">
                  <input type="text" class="form-control" name="bsc_list_fact_venta" required placeholder="Ingrese El NIT o el NUMER0 de la Factura a Buscar!">
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
           <div class="box box-info">
              <table class="table table-hover">
                <thead> 
                  <?php 
                  include 'php/query.php';
                  $n=1;
                  $query= $busc_list_factura_venta;
                  if($query->num_rows>0):
                ?>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Num. Factura</th>
                      <th scope="col">Cliente</th>
                      <th scope="col">Nit</th>
                      <th scope="col">Fecha</th>
                  </tr>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($f=$query->fetch_array()):?>
                  <tr>
                    <th scope="row"><?php echo $n++;?></th>
              <td><?php echo str_pad($f['numero_fact'], 5,"0", STR_PAD_LEFT) ;?></td>
              <td><?php echo $f['nombre_cliente'];?></td>
              <td><?php echo $f['nit_cliente'];?></td>
              <td><?php echo $f['fecha_salida'];?></td>
                    <td>
                      <a title="Eliminar" href="#" id="del-<?php echo $f["id_prestamo"];?>" class="btn btn-sm icon fa fa-trash fa-lg"></a>
                      <a target="_blank" title="Ver" href="php/reportesPdf/reporte_venta.php?imprimir_venta2&num_fact=<?php echo $f['numero_fact']; ?>" id="del-<?php echo $f["id_prestamo"];?>" class="btn btn-sm icon fa fa-search fa-lg"></a>
                    </td>
                    <!--
                    <script>
                        $("#del-"+<?php echo $f["id_prestamo"];?>).click(function(e){
                          e.preventDefault();
                          p = confirm("Estas seguro? Si Acepta Toda la informacion Relacionada Sera eliminada y no podra Recuperarse");
                          if(p){
                            window.location="php/query.php?cancelar-prestamo="+<?php echo $f["id_prestamo"];?>;
                          }

                        });
                    </script>
                  -->
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
