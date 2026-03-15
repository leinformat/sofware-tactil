
<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Usuarios
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Usuarios</li>
      </ol>
    </section>
    <!-- Main content -->
    <section style="margin-bottom: -160px;" class="content">
      <div class="row">
        <div class="col-xs-12 " align="center">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar</h3>
            </div>
            <div class="box-body">

              <a href="?mod=agg_usuario"><button type="button" class="btn btn-info">
                Agregar Nuevo Usuario
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
          <?php if (isset($_GET['exito']))
                    {
                      echo "<div class='alert alert-info alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4><i class='icon fa fa-info'></i> Ha Sido eliminado Correctamente!</h4>
                            </div>";
                    }

              if (isset($_GET['error']))
                    {
                            echo "<div class='alert alert-danger alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <h4><i class='icon fa fa-info'></i> Ocurrio un Error y el no pudo Ser Eliminado!</h4>
                    </div>";
                    }
                  ?>
           <div class="box box-info content-wrapper__table-container">
              <table class="table table-hover content-wrapper__table">
                <thead> 
                  <?php 
                  include 'php/query.php';
                  $n=1;
                  $query= $list_usuarios;
                  if($query->num_rows>0):
                ?>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nick</th>
                      <th scope="col">Nombre de Usuario</th>
                      <th scope="col">Telefono</th>
                      <th scope="col">Correo</th>
                      <th scope="col">Rol del Usuario</th>
                      <th scope="col">Estado</th>
                  </tr>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php while ($f=$query->fetch_array()):?>
                  <tr>
                    <th scope="row"><?php echo $n++;?></th>
                    <td><?php echo $f['nick'];?></td>
                    <td><?php echo $f['nombre_usu'];?></td>                    
                    <td><?php echo $f['telefono'];?></td>
                    <td><?php echo $f['email'];?></td>
                    <td><?php echo $f['nombre_rol'];?></td>
                    <td>
                      <a title="Eliminar" href="#" id="del-<?php echo $f["id_usuario"];?>" class="btn btn-sm icon fa fa-trash fa-lg"></a>
                      <a title="Editar" href="?mod=form_modificar_usuario&editar_usuario=<?php echo $f['id_usuario']; ?>"  class="btn btn-sm icon fa fa-edit fa-lg">
                      </a>
                    </td>
                    <script>
                        $("#del-"+<?php echo $f["id_usuario"];?>).click(function(e){
                          e.preventDefault();
                          p = confirm("Estas seguro? Si Acepta Toda la informacion Relacionada Sera eliminada y no podra Recuperarse");
                          if(p){
                            window.location="php/query.php?eliminar-usuario="+<?php echo $f["id_usuario"];?>;
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
                        <p class="alert alert-success">No hay Usuarios Creados</p>
                      </td>
                  
                    <?php endif;?>
                 </tr>
                </thead>
              </table>
          </div>
          <!-- Notificacion -->
          <?php 
              if(isset($_GET["usuario-agregado"]))
                    {
                        echo "<div class='alert alert-info alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-info'></i>Usuario Agregado Correctamente </h4>
                            </div>";
                    }
           ?>
        </div>
      </div>    
    </section>
  </div>