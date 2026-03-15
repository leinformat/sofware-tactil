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
          <small>Equipos Entregados</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
          <li class="active">Equipos Entregados</li>
        </ol>
  </section>
    <!-- Main content -->
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
              <h3>Equipos Entregados</h3>
              <hr class="">
              <div id="tablaDatatable"></div>
          </div>
        </div>
      </div>    
    </section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#tablaDatatable').load('paginas/datatables/equipos_entregados.php');
    });
  </script>