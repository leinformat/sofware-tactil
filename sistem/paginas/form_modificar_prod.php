<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Producto
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Editar Producto</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="box box-info">
            <div align="center" class="box-header with-border">
              <h3 class="box-title">Ingresar Nuevos Datos</h3>
            </div>
            <div class="box-body">
              <div class="row">


			<?php
				include "php/conexion.php";

				$id_producto=null;
				$sql1= "SELECT * FROM productos p JOIN categorias cat WHERE p.id_categoria = cat.id_categoria AND  id_producto = '".$_GET['editar_producto']."' ";
				$query = $conexion->query($sql1);
				$producto = null;
				if($query->num_rows>0){
				while ($r=$query->fetch_object()){
				  $producto=$r;
				  break;
				}

				  }
				?>
				<?php if($producto!=null):?>
                <form action="php/query.php" method="post" enctype="multipart/form-data">
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Codigo de Producto</b></span>
                      <input type="text" class="form-control" value="<?php echo $producto->cod_producto; ?>" name="cod_producto" placeholder="Numero de Factura"  required>
                      <input type="text" class="form-control hidden" value="<?php echo $producto->id_producto; ?>" name="id_producto" placeholder="Numero de Factura"  required>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Nombre de Producto</b></span>
                      <input type="text" class="form-control" value="<?php echo $producto->nombre_producto; ?>"name="nom_producto" placeholder="Producto" required>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                    	<span><b>Categoria</b></span>
                        <select class="form-control"  name="cat_producto"  required>
                           <?php include 'php/query.php'; ?>
                            <option class="hidden" value="<?php echo $producto->id_categoria; ?>"><?php echo $producto->nombre_cat; ?></option>
                             <!-- Bucle para extraer los Datos de las tabla tipo de Servicio Tecnico -->
                            <?php while ($row=mysqli_fetch_array($buscar_cat)): ?>
                            <option value="<?php echo $row['id_categoria']; ?>"><?php echo $row['nombre_cat'];
                            $r=$row['nombre_cat']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>                    
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                    	<span><b>Cantidad</b></span>
                        <input class="form-control" required type="number" name="cant_producto" value="<?php echo $producto->cantidad; ?>"/>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                    	<span><b>Precio de Compra</b></span>
                        <input class="form-control" required type="number" name="precio_compra" value="<?php echo $producto->precio_compra; ?>" required/>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Precio de Venta</b></span>
                        <input class="form-control" required type="number" name="precio_unitario" value="<?php echo $producto->precio_unid; ?>" required/>
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Imagen</b></span>
                        <input name="imagen" type="file" id="exampleInputFile" name="imagen" placeholder="Imagen del Producto">
                        <img width="100px" src="./<?php echo $producto->img; ?>" class="img-circle img-responsive" alt="User Image">
                    </div>
                    <div class="col-sm-12 col-lg-12 content-wrapper__field-row">
                        <input type="submit" name="modificar_producto" value="Guardar Cambios" class="btn btn-success"/>
                        <a href="?mod=inventario" type="button" class="btn btn-primary"/>Cancelar</a>
                    </div>
                </form>
                <?php else:?>
				  <p class="alert alert-danger">404 No se encuentra</p>
				<?php endif;?>          
            </div>
          <?php include "php/query.php"; ?>
            <!-- Notificaciones -->
              </div>
            <!-- /.box-body -->
          </div>
        </div>
    </section>

    </section>
    <!-- /.content -->
  </div>