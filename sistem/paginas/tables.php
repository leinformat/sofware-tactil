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
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Mesas</li>
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

              <a href="?mod=agg_table"><button type="button" class="btn btn-info">
                Agregar Nueva Mesa
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
           <div class="box box-danger">
              <table class="table table-hover">
                <thead> 
                  <?php 
                  include 'php/query.php';
                  $n=1;
                  $query= $getTables;
                  if($query->num_rows>0):
                ?>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre de Mesa</th>
                  </tr>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php while ($f=$query->fetch_array()):?>
                  <tr>
                    <th scope="row"><?php echo $n++;?></th>
                      <td><?php echo $f['name'];?></td>
                    <td>
                      <a title="Eliminar" href="#" id="del-<?php echo $f["id"];?>" class="btn btn-sm icon fa fa-trash fa-lg"></a>
                      <a href="#" id="del-<?php echo $f["id"];?>" class="btn btn-sm icon fa fa-edit fa-lg"></a>
                    </td>
                    <script>
                        $("#del-"+<?php echo $f["id"];?>).click(function(e){
                          e.preventDefault();
                          p = confirm("Estas seguro? Si Acepta Toda la informacion Relacionada Sera eliminada y no podra Recuperarse");
                          if(p){
                            window.location="php/query.php?delete_table="+<?php echo $f["id"];?>;
                          }

                        });
                    </script>
                    <?php  endwhile;?>
                    
                  </tr>     
                </tbody>
                <thead>
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