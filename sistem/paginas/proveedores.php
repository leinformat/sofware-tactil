<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Proveedores
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Proveedores</li>
      </ol>
    </section>
    <!-- Main content -->
    <section style="margin-bottom: -160px;" class="content">
      <div class="row">
        <div class="col-xs-12 " align="center">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar</h3>
            </div>
            <div class="box-body">

              <a href="?mod=agg_proveedor"><button type="button" class="btn btn-info">
                Agregar Nuevo Proveedor
              </button></a>
                          
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <section  class="content">
      <div class="row">
        <div class="col-xs-12 " align="center"><br>
        <!-- Notificacion de Trabajo Eliminado -->  
          <?php if (isset($_GET['exito_mod'])){
                          echo "<div class='alert alert-info alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-info'></i> El Proveedor ha sido Modificado Correctamente!</h4>
                  </div>";
                      }

                        if (isset($_GET['error'])){
                            echo "<div class='alert alert-danger alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <h4><i class='icon fa fa-info'></i> Ocurrio un Error y el no pudo Ser Eliminado!</h4>
                    </div>";
                      }
                  ?>
           <div class="box box-danger">
              <hr class="">
              <div id="tablaDatatable"></div>
          </div>
        </div>
      </div>    
    </section>
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#tablaDatatable').load('paginas/datatables/proveedores.php');
    });
  </script>