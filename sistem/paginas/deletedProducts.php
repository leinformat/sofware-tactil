<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inventario
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Productos Eliminados</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 " align="center">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Productos Eliminados</h3>
            </div>
            <div class="box-body">
              <a href="?mod=agg_producto"><button type="button" class="btn btn-info">
                Agregar Nuevo Producto
              </button></a>
              <a title="Imprimir Inventario" target="_blank" href="php/reportesPdf/reporte_inv.php?imprimir_inv"  class="btn btn-sm icon fa fa-print fa-3x fa-lg">
                      </a>
              <a href="?mod=inventario"><button type="button" class="btn btn-success">
                Productos Disponibles
              </button></a>            
            </div>
          </div>
          <div class="box box-info">
              <hr class="">
            <div id="tablaDatatable"></div>
          </div>
          </div>
        </div>
        <?php if (isset($_GET['exito'])){
                          echo "<div class='alert alert-success alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-info'></i> El Producto ha sido eliminado Correctamente!</h4>
                  </div>";
                      }

                        if (isset($_GET['error'])){
                            echo "<div class='alert alert-danger alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <h4><i class='icon fa fa-info'></i> Ocurrio un Error y el Producto no pudo Ser Eliminado!</h4>
                    </div>";
                      }

                      if (isset($_GET['exito_mod'])){
                            echo "<div class='alert alert-info alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <h4><i class='icon fa fa-info'></i>Producto Modificado Correctamente!</h4>
                    </div>";
                      }

                      if (isset($_GET['error_mod'])){
                            echo "<div class='alert alert-danger alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <h4><i class='icon fa fa-info'></i> Ocurrio un Error y el Producto no pudo Ser Modificado!</h4>
                    </div>";
                      }
                  ?> 
      </div>    
    </section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#tablaDatatable').load('paginas/datatables/deletedProducts.php');
    });
  </script> 