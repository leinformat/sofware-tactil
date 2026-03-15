<!--
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
 -->
 <?php 
    if (!isset($_GET['pagina'])) {
    print "<script>window.location='?mod=rep_facturas_venta&pagina=1';</script>";
    }
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	   <h1>
	     Reporte
	     <small>Facturas de Ventas</small>
	   </h1>
	   <ol class="breadcrumb">
	     <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
	     <li class="active">Facturas de Ventas</li>
	   </ol>
	 </section>
	 <br>
	 <br>
    <!-- Main content -->
	<div class="col-md-12">
	   	<div class="box box-info">
            <div class="box-header with-border">
              <a href="?mod=fact_empresas"><button  type="button" class="close fa fa-lg fa-shopping-cart">Nueva Venta</button></a>
              <h3 class="box-title">FACTURAS DE VENTA</h3>
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
              <hr class="">
              <div id="tablaDatatable"></div>
          </div>
        </div>
      </div>    
    </section>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#tablaDatatable').load('paginas/datatables/fact_ventas.php');
    });
  </script>
