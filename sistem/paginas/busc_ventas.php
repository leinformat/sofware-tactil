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
              <a href="?mod=ventas_diarias"><button  type="button" class="close fa fa-lg fa-reply-all"></button></a>
              <h3 class="box-title">Buscar Venta</h3>
            </div>
          <div class="box-body">
              <form method="post" action="?mod=busc_ventas">
                <div class=" col-md-3">
                  <input  type="date" class="form-control" name="bsc_ventas" required autofocus>
                </div>
                <div class="col-md-3">
                  <input  type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="bsc_ventas2" required autofocus>
                </div>
                <div class="col-md-3">
                        <input type="submit" value="Buscar" class="btn btn-info btn-flat">
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
                  $query= $busc_ventas;
                  if($query->num_rows>0):
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
                  <?php while ($f=$query->fetch_array()):?>
                  <tr>
                        <th scope="row"><?php echo $n++;?></th>
                        <td><?php echo $f['fecha_salida'];?></td>
                        <td><?php echo $f['cantidad_total'] . '   Unds';?></td>
                        <td><?php echo '$ ' . number_format($f['monto_total'], 1) ;?></td>
                    <td>
                      <a target="_blank" title="Ver" href="php/reportesPdf/reporte_diario.php?ventas_dia&fecha=<?php echo $f['fecha_salida']; ?>" class="btn btn-sm icon fa fa-search fa-lg"></a>
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
