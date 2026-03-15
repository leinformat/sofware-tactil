<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        FACTURAS POR PAGAR
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">FACTURAS POR PAGAR</li>
      </ol>
    </section>
    <!-- Main content -->
    <section style="margin-bottom: -160px;" class="content">
      <div class="row">
        <div class="col-xs-12 " align="center">
          <div class="box box-default">
            <div class="box-header with-border">
              <h1 class="box-title">FACTURAS POR PAGAR</h1>
            </div>
          </div>
            <?php 
          		if(isset($_GET["exito"])){
                    echo "<div class='alert alert-info alert-dismissible'>
                        	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-info'></i>Factura Cancelada Correctamente</h4>
                          </div>";
          				}
          		if(isset($_GET["error"])){
                    echo "<div class='alert alert-danger alert-dismissible'>
                        	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-info'></i>Error</h4>
                          </div>";
          				}
          	?> 
        </div>
      </div>
    </section>
    <!-- /.content -->
    <section  class="content">
      <div class="row">
        <div class="col-xs-12 " align="center"><br>
        <!-- Notificacion de Trabajo Eliminado -->  
                  <?php 
                  include 'php/query.php';
                  $n=1;
                  $query= $facturas_por_pagar;
                  if($query->num_rows>0):
                	
                	 while ($f=$query->fetch_array()):?>
                  	<div class="col-md-3 col-sm-6 col-xs-12">
			          <div class="info-box">
			            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
						<style>
							.icono{
								color: #F39C12;
							}
							.icono:hover{
								color: #3C8DBC;
							}
						</style>
			            <div class="info-box-content">
			              <span class="info-box-text info-box-number"><?php echo  $f['nombre_proveedor']; ?></span>
                    <span class="info-box-text info-box-number"><?php echo  str_pad($f['numero_factura'], 5,"0", STR_PAD_LEFT); ?></span>
			              <span style="color:red;" class="info-box-text num"><?php echo "Vence el ". $f['plazo']; ?></span>
			            </div>
                      	<a title="Editar" href="?mod=edit_fact_x_pagar&fact_por_pagar=<?php echo $f['numero_factura']; ?>&id_proveedor=<?php echo $f['id_proveedor'] ?>"  class="icono btn btn-sm icon fa fa-edit fa-2x fa-lg">
                      	</a>
			            <!-- /.info-box-content -->
			          </div>
			          <!-- /.info-box -->
			        </div>
                  	<?php  endwhile;?>
                  <?php else:?>
                      <div class="row">
                        <p class="alert alert-success">No hay resultados</p>
                      </div>
                  
                    <?php endif;?>
                 </tr>
                </thead>
              </table>
          </div>
        </div>
      </div>    
    </section>
  </div>