<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<?php
@session_start();

// Optener el Numero de Factura Autoincrementable //
      include 'php/query.php';
      while ($n= $num_fact->fetch_array()) {
             $num_factura = $n['factura'];
  break; }
// </ Optener el Numero de Factura Autoincrementable //
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Salida de Productos
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Salida de Productos</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="box box-info">
            <div align="center" class="box-header with-border">
              <h3 class="box-title">Ingresar Datos</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <form action="php/salida_producto.php" method="post">
                    <div class="col-xs-4">
                      
                      <input type="text" class="form-control hidden" value="<?php echo $num_factura;?>" name="num_factura" placeholder="Ingrese el Nombre">
                      <span><b>Nombre o Razon Social</b></span>
                      <input type="text" class="form-control" value="<?php if (isset($_SESSION['nombre_cliente'])){ echo $_SESSION['nombre_cliente']; } ?>" name="nombre_cliente" placeholder="Ingrese el Nombre"  required>
                    </div>
                    <div class="col-xs-4">
                      <span><b>Nit-CC</b></span>
                      <input type="text" class="form-control" value="<?php if (isset($_SESSION['nit_cliente'])){ echo $_SESSION['nit_cliente']; } ?>" name="nit_cliente" placeholder="Ingrese Nit o Cedula de Ciudadania"  required>
                    </div>
                    <div class="col-xs-4">
                      <span><b>Fecha</b></span>
                      <input type="date" class="form-control" value="<?php if (isset($_SESSION['fecha_sal'])){ echo $_SESSION['fecha_sal'];}else{echo date('Y-m-d');}?>" name="fecha_sal" placeholder="Proveedor" required>
                    </div>
                    <br><br><br><br>
                    <div class="col-xs-7">
                      <span><b>Direccion</b></span>
                      <input type="text" class="form-control" value="<?php if (isset($_SESSION['dir_cliente'])){ echo $_SESSION['dir_cliente']; } ?>" name="dir_cliente" placeholder="Ingrese la Dirección">
                    </div>
                    <div class="col-xs-5">
                      <span><b>Telefono</b></span>
                      <input type="text" class="form-control" value="<?php if (isset($_SESSION['tel_cliente'])){ echo $_SESSION['tel_cliente']; } ?>" name="tel_cliente" placeholder="Ingrese Numero Telefónico">
                    </div>
                      <br><br><br><br>
                    <div class="col-xs-5">
                      <span><b>Producto</b></span>
                        <select class="form-control"  name="nom_producto"  required>
                           <?php include 'php/query.php'; ?>
                            <option value="">Seleccione un Producto</option>
                             <!-- Bucle para extraer los Datos de las tabla tipo de Servicio Tecnico -->
                            <?php while ($row=mysqli_fetch_array($buscar_prod1)): ?>
                            <option title="<?php echo $row['cantidad'].' Unidades en Stock';?>" name="" value="<?php echo $row['id_producto']; ?>"><?php echo $row['nombre_producto']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <span><b>Cantidad</b></span>
                        <input class="form-control" type="number" name="cant_producto" placeholder="Cantidad" required/>
                    </div><br>
                    <div class="col-xs-2">
                        <input type="submit" name="agregar_producto" value="Agregar" class="btn btn-success"/>
                        <br><br>
                    </div>
                </form>          
            </div>

            <!-- /.box-body -->
          </div>
          <!-- Notificaciones -->
              </div>
              <?php if(isset($_GET["poca-cantidad-en-inventario"])){
                            echo "<div class='alert alert-danger alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-info'></i>Actualmente no Contamos con esta cantidad, por favor verifique la Existencia en Inventario </h4>
                            </div>";
                         } ?>
        </div>
      </section>
            <!-- Carrito-->
             <?php 
                include 'php/query.php';
                $n=1;
                $query= $salida_producto;
                if($query->num_rows>0):
             ?>
            <section class="content carrito">
              <div class="row">
                <div class="col-xs-12 " align="center">
                  <div class="box box-default">
                      <table class="table table-striped">
                        <thead> 
                        
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre de Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio Unitario</th>
                            <th scope="col">Precio Total</th>
                            <th scope="col">Acciones</th>
                          </tr>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $precio_unit = 0  ;
                                $precio_total = 0;
                          ?>
                          <?php while ($f=$query->fetch_array()):?>
                          
                          <tr>
                            <th scope="row"><?php echo $n++;?></th>
                            <td><?php echo $f['nombre_producto'];?></td>
                            <td align="center"><?php echo $f['cantidad'];?></td>
                            <td><?php echo number_format($f['precio_unid'],2)." $";?></td>
                            <td><?php echo number_format($f['precio_unid'] * $f['cantidad'], 2)." $";?></td>
                                <?php 
                                  $precio_unit += $f['precio_unid'];
                                  $precio_total += $f['precio_unid'] * $f['cantidad']; 

                                ?>
                            <td>
                              <a href="#" id="del-<?php echo $f["id_producto"];?>" class="btn btn-sm icon fa fa-trash fa-lg"></a>
                            </td>
                            <script>
                                $("#del-"+<?php echo $f["id_producto"];?>).click(function(e){
                                    window.location="php/query.php?carrito_salida="+<?php echo $f["id_producto"];?>;
                                });
                            </script>
                            <?php  endwhile;?>
                            
                          </tr>     
                        </tbody>
                        <thead>
                          <tr>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"><?php echo number_format($precio_unit, 2) . " $"; ?></th>
                            <th scope="col"><?php echo number_format($precio_total,2)." $";?></th>
                            <form action="php/salida_producto.php" method="POST">
                              <th><input type="submit" name="guardar_salida" value="Guardar" class="btn btn-info"/> 
                              <a title="Imprimir Factura" target="_blank" href="php/reportesPdf/reporte_venta.php?imprimir_venta"  class="btn btn-sm icon fa fa-print fa-2x fa-lg">
                              </a></th>
                            
                            </form>
                            
                          </tr>
                        </thead>
                      </table>
                    </div>
                </div>

              </div> 
              <?php else:?>           
              <?php endif;?> 

              <?php 
                        if(isset($_GET["exito"])){
                                    echo "<div class='alert alert-info alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h4><i class='icon fa fa-info'></i>Registro Satisfactorio!</h4>
                                    </div>";
                                 }
                        if(isset($_GET["error"])){
                                    echo "<div class='alert alert-danger alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        <h4><i class='icon fa fa-info'></i>Ocurrio un Error al registrar los Datos!</h4>
                                    </div>";
                                 }
                        ?>             
    </section>
    <!-- /.content -->
  </div>