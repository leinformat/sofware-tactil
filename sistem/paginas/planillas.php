<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Planillas
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Planillas</li>
      </ol>
    </section>
    <!-- Main content -->
    <section style="margin-bottom: -160px;" class="content">
      <div class="row">
        <div class="col-xs-12 " align="center">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Planilla</h3>
            </div>
            <div class="box-body">

              <form action="php/query.php" method="post">
                    <div class="col-xs-6">
                      <input type="text" name="id_usuario" value="<?php echo $_SESSION['id_usu']; ?>" class="hidden"/>
                      <!--Datos del Cliente -->
                      <span><b>Nombre del Cliente</b></span>
                      <select class="form-control"  name="id_cliente"  required>
                           <?php include 'php/query.php'; ?>
                            <option value="">Seleccione un Cliente</option>
                             <!-- Bucle para extraer los Datos de las tabla Cliente -->
                            <?php while ($row=mysqli_fetch_array($buscar_cliente)): ?>
                            <option  name="" value="<?php echo $row['id_cliente']; ?>"><?php echo $row['nombre_cliente']." Nit/CC: ".$row['nit_cliente']; ?></option>
                            <?php endwhile; ?>
                      </select>
                    </div>
                    <br>
                    <div class="col-xs-2">
                        <input type="submit" name="agregar_planilla" value="Agregar" class="btn btn-info"/>
                        <br><br>
                    </div>
                </form>     
            </div>
          </div>
            <?php 
          		if(isset($_GET["planilla-agregada"])){
                    echo "<div class='alert alert-info alert-dismissible'>
                        	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-info'></i>Planilla Creada Correctamente </h4>
                          </div>";
          				}
          		if(isset($_GET["planilla-eliminada"])){
                    echo "<div class='alert alert-danger alert-dismissible'>
                        	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-info'></i>Planilla Eliminada Correctamente </h4>
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
           
                  <?php 
                  include 'php/query.php';
                  $n=1;
                  $query= $list_planillas;
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
			              <span class="info-box-text info-box-number"><?php echo $f['nombre_cliente']; ?></span>
			              <span class="info-box-text num"><?php echo "Nit ". $f['nit_cliente']; ?></span>
			            </div>
			            <a  title="Borrar" href="php/query.php?eliminar_planilla&id_planilla=<?php echo $f['id_planilla'] ?>" class="icono btn btn-sm icon fa fa-trash fa-2x fa-lg">                        
                      	</a>
                      	<a title="Editar" href="?mod=agg_planilla&editar_planilla=<?php echo $f['id_planilla']; ?>&id_cliente=<?php echo $f['id_cliente'] ?>"  class="icono btn btn-sm icon fa fa-edit fa-2x fa-lg">
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