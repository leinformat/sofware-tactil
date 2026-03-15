<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<script>
  $(function() {
    // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
    $("#adicional").on('click', function() {
      $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
    });

    // Evento que selecciona la fila y la elimina 
    $(document).on("click", ".eliminar", function() {
      var parent = $(this).parents().get(0);
      $(parent).remove();
    });
  });
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Inventario
    </h1>
    <ol class="breadcrumb">
      <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="?mod=inventario"><i class=""></i>Inventario</a></li>
      <li class="active">Agregar Producto</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12 " align="center">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Agregar Producto</h3>
          </div>
          <div class="box-body">

            <form class="content-wrapper__table-container" method="post" enctype="multipart/form-data">
              <div class="modal-header">
                <a href="?mod=inventario"><button type="button" class="close fa fa-fw fa-mail-reply"></button></a>
                <h4 class="modal-title" align="center" style="color:#0066B2;">Ingrese los Datos del Producto</h4>
              </div>
              <div class="content-wrapper__table-container">
              <table class="table bg-info table-bordered content-wrapper__table-2" id="tabla">
                <thead style="background-color: #3c8dbc;color: white; font-weight: bold;">
                  <tr>
                    <td>COD</td>
                    <td>PRODUCTO</td>
                    <td>CATEGORIA</td>
                    <td>CANTIDAD</td>
                    <td>VR.COMPRA</td>
                    <td>VR.VENTA</td>
                    <td>IVA %</td>
                    <td>IMAGEN</td>
                    <td colspan="2"></td>
                  </tr>
                </thead>
                <tr class="fila-fija">
                  <div class="input-group">
                    <td>
                      <input autofocus class="form-control" required type="text" name="cod_producto[]" placeholder="Código del Producto" />
                    </td>
                    <td>
                      <input class="form-control" required type="text" name="nom_producto[]" placeholder="Nombre del Producto" />
                    </td>
                    <!-- Bucle para extraer los Datos de las tabla categoria_producto -->
                    <td>
                      <select class="form-control" name="cat_producto[]" required>
                        <?php include 'php/query.php'; ?>
                        <option value="">Categoría del Producto</option>
                        <!-- Bucle para extraer los Datos de las tabla tipo de Servicio Tecnico -->
                        <?php while ($row = mysqli_fetch_array($buscar_cat)) : ?>
                          <option value="<?php echo $row['id_categoria']; ?>"><?php echo $row['nombre_cat']; ?></option>
                        <?php endwhile; ?>
                      </select>
                    </td>

                    <td>
                      <input class="form-control" required type="number" name="cantidad_producto[]" placeholder="cantidad" />
                    </td>

                    <td>
                      <input class="form-control" type="number" name="precio_compra_producto[]" placeholder="Precio de Compra" />
                    </td>
                    <td>
                      <input class="form-control" required type="number" name="precio_producto[]" placeholder="Precio de Venta" />
                    </td>

                    <td>
                      <input class="form-control" type="number" value="0" name="iva_producto[]" placeholder="Iva del Producto" />
                    </td>

                    <!-- Image -->
                    <td>
                      <input class="form-control" type="file" name="imagen[]" placeholder="Imagen del Producto" />
                    </td>

                    <td>
                      <input class="form-control hidden" type="number" value="1" name="estado_producto[]" />
                    </td>

                    <td class="eliminar">
                      <input type="button" class="form-control btn-danger" value="Menos -" />
                    </td>
                  </div>
                </tr>
              </table>
              </div>
              <div class="btn-der">
                <input type="submit" name="nuevo_producto" value="Guardar Registros" class="btn btn-info" />
                <button id="adicional" name="adicional" type="button" class="btn btn-success"> Más + </button>
                <br><br>
              </div>
            </form>
            <?php include_once 'php/agg_producto.php' ?>
          </div>
          <!-- Notificaciones -->
          <?php
          if (isset($_GET["exito"])) {
            echo "<div class='alert alert-info alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-info'></i>Registro Satisfactorio!</h4>
                        </div>";
          }
          if (isset($_GET["error"])) {
            echo "<div class='alert alert-danger alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-info'></i>Ocurrio un Error al registrar los Datos!</h4>
                        </div>";
          }
          ?>
        </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>