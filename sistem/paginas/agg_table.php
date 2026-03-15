<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mesas
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="?mod=categoria"><i class=""></i>Mesa</a></li>
        <li class="active"> Agregar Mesa</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="col-md-12">
      	    	<div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Agregar Nueva Mesa</h3>
                  </div>
                  <div class="box-body">
                  <form method="post" action="php/query.php">
                    <div class="input-group input-group-sm col-md-6">
                      <input type="text" class="form-control" name="nombre_table" required autofocus placeholder="Agregar Nombre de Mesa">
                          <span class="input-group-btn">
                            <button type="button submit" class="btn btn-primary" name="agg_table" >Guardar!</button>
                            <a href="?mod=tables" class="btn btn-info " type="button">Cancelar</a>
                          </span>
                    </div>
                   </form>
                    <!-- /input-group -->
                  </div><br>
                  <!-- Notificaciones -->
      					<?php 
      			 			if(isset($_GET["exito"])){
      			                  echo "<div class='alert alert-info alert-dismissible'>
      						                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
      						                <h4><i class='icon fa fa-info'></i>Registro Satisfactorio!</h4>
      						            </div>";
      			               }
      			            ?> 
                  <!-- /.box-body -->
              </div>
	         </div>
      </div>
    </div>
    </section>
    <!-- /.content -->
  </div>