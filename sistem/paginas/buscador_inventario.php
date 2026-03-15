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
        <li class="active">Inventario</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 " align="center">
          <div class="box box-info">
            <div class="box-header with-border">
              <!-- PRODUCTOS AGOTADOS O DISPONIBLES -->
              <a href="<?php if(isset($_GET['agotado'])){echo '?mod=productos_agotados';} elseif(isset($_GET['disponible'])){echo '?mod=inventario';}?>"><button  type="button" class="close fa fa-lg fa-reply-all"></button></a>
              <h3 class="box-title">Inventario</h3>
            </div>
            <div class="box-body">
              <form method="POST" action="?mod=buscador_inventario&<?php if(isset($_GET['agotado'])){echo 'agotado';} elseif(isset($_GET['disponible'])){echo 'disponible';}?>">
                <div class="input-group input-group-sm col-md-6">
                  <input type="text" class="form-control" name="buscar-producto" required placeholder="Ingrese CODIGO, NOMBRE O CATEGORIA DEL PRODUCTO a Buscar!">
                      <span class="input-group-btn">
                        <button type="button submit" class="btn btn-info btn-flat">Buscar!</button>
                      </span>
                </div>
               </form><br>
              <!-- /input-group -->
        
            <!-- /.box-body -->

              <a href="?mod=agg_producto"><button type="button" class="btn btn-info">
                Agregar Nuevo Producto
              </button></a>
              <a title="Imprimir Inventario" target="_blank" href="php/reportesPdf/reporte_inv.php?imprimir_inv"  class="btn btn-sm icon fa fa-print fa-3x fa-lg">
                      </a>             
            </div>
          </div>
          <div class="box box-info">
              <table class="table table-striped table-hover">
                <thead> 
                  <?php 
                  include 'php/query.php';
                  //echo ceil($paginas);
                  $query= $inventario_inc;
                  if($query->num_rows>0):
                ?>
                  <tr>
                    <th scope="col">Cod.</th>
                    <th scope="col">PRODUCTO</th>
                    <th scope="col">CATEGORIA</th>
                    <th scope="col">STOCK</th>
                    <th scope="col">VR. COMPRA</th>
                    <th scope="col">VR. VENTA</th>
                    <th scope="col">VR. TOTAL</th>
                    <th scope="col">ACCIONES</th>
                  </tr>
                  </tr>
                </thead>
                <tbody>
                  <?php 

                      /*PRODUCTOS AGOTADOS*/
                      if (isset($_GET['agotado'])) 
                      {
                        $inv= mysqli_query($conexion, "SELECT * FROM productos JOIN categorias WHERE productos.id_categoria = categorias.id_categoria AND productos.cantidad = 0 AND productos.id_categoria != 9 AND productos.cod_producto LIKE '%".$_POST['buscar-producto']."%' OR productos.id_categoria = categorias.id_categoria AND productos.cantidad = 0 AND productos.id_categoria != 9 AND productos.nombre_producto LIKE '%".$_POST['buscar-producto']."%' OR productos.id_categoria = categorias.id_categoria AND productos.cantidad = 0 AND productos.id_categoria != 9 AND categorias.nombre_cat LIKE '%".$_POST['buscar-producto']."%' ORDER BY nombre_producto ASC ");
                      }
                      /*PRODUCTOS DISPONIBLES*/
                      if (isset($_GET['disponible']))
                      {
                        $inv= mysqli_query($conexion, "SELECT * FROM productos JOIN categorias WHERE productos.id_categoria = categorias.id_categoria AND productos.cantidad > 0 AND productos.id_categoria != 9 AND productos.cod_producto LIKE '%".$_POST['buscar-producto']."%' OR productos.id_categoria = categorias.id_categoria AND productos.cantidad > 0 AND productos.id_categoria != 9 AND productos.nombre_producto LIKE '%".$_POST['buscar-producto']."%' OR productos.id_categoria = categorias.id_categoria AND productos.cantidad > 0 AND productos.id_categoria != 9 AND categorias.nombre_cat LIKE '%".$_POST['buscar-producto']."%' ORDER BY nombre_producto ASC ");
                      }
                  ?>

                  <?php while ($f=$inv->fetch_array()):?>
                  
                  <tr>
                    <td><?php echo $f['cod_producto'];?></td>
                    <td title="<?php echo $f['id_producto']; ?>"><?php echo $f['nombre_producto'];?></td>
                    <td><?php echo $f['nombre_cat'];?></td>
                    <td align="center"><?php echo $f['cantidad'];?></td>
                    <td align="center"><?php echo "$ ". number_format($f['precio_compra']) ;?></td>
                    <td><?php echo " $ ". number_format($f['precio_unid']);?></td>
                    <td><?php echo " $ ". number_format($f['precio_unid'] * $f['cantidad']);?></td>
                    <td>
                      <a title="Borrar" href="#" id="del-<?php echo $f["id_producto"];?>" class="btn btn-sm icon fa fa-trash fa-lg">                        
                      </a>
                      <a title="Editar" href="?mod=form_modificar_prod&editar_producto=<?php echo $f['id_producto']; ?>"  class="btn btn-sm icon fa fa-edit fa-lg">
                      </a>
                    </td>
                    <script>
                        $("#del-"+<?php echo $f["id_producto"];?>).click(function(e){
                          e.preventDefault();
                          p = confirm("Estas seguro? Si Acepta Toda la informacion Relacionada con el producto Sera eliminada y no podra Recuperarse");
                          if(p){
                            window.location="php/query.php?borrar_producto="+<?php echo $f["id_producto"];?>;
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
                      <h4><i class='icon fa fa-info'></i> Ocurrio un Error y el Producto no pudo Ser Eliminado!</h4>
                    </div>";
                      }
                  ?>
                    </tr>
                </thead>
              </table>
              
          </div>
        </div>
      </div>    
    </section>
    <!-- /.content -->
  </div>