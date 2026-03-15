<!--
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"><br>
	   <h1>
	     Respaldo
	     <small>Respaldo del Sistema</small>
	   </h1>
	   <ol class="breadcrumb">
	     <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
	     <li class="active">Respaldo del Sistema</li>
	   </ol>
	 </section>
	 <br>
	 <br>
       <style>
          .icon-backup:hover {
              color: red;
          }
          .icon-backup {
              transition: color 0.5s linear 0.09s;
          }
       </style>
    <!-- Listado de Facturas -->
    <section class="content">
      <div class="row">
        <div class="col-md-6 center col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="php/backup_db.php"><span class="info-box-icon bg-aqua"><i class="ion ion-android-download icon-backup"></i></span></a>
            <div class="info-box-content">
              <span class="info-box-text">Realizar Respaldo de la Base de Datos</span>
              <span class="info-box-number">Presione el Icono para Guardar</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->           
      </div>  
      <!-- Notificacion de Trabajo Eliminado -->  
          <?php if (isset($_GET['exito']) && isset($_GET['file'])){
                    $zipfile = $_GET["file"].'.gz';
                          echo "<div class='alert alert-info alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-info'></i>Respaldo Realizado con Éxito, por favor Guarde el Archivo en un lugar seguro</h4>
                    <a class='' target='_blank' href='php/BACKUP_DIR/$zipfile'>Volver a Descargar</a>
                  </div>";
                 
                  print "<script>window.location='php/BACKUP_DIR/$zipfile';</script>";
                  }
                  if (isset($_GET['error'])){
                            echo "<div class='alert alert-danger alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <h4><i class='icon fa fa-info'></i> Ocurrio un Error y el no se pudo hacer el Respaldo!</h4>
                    </div>";
                      }
                  ?>  
    </section>
  </div>
