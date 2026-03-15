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

//Mostrar el Nombre del Cliente
if (isset($_SESSION['nombre_cliente'])) {
  $sql=mysqli_query($conexion,"SELECT nombre_cliente,id_cliente, nit_cliente FROM clientes WHERE id_cliente = '".$_SESSION['nombre_cliente']."' ");
  $row=mysqli_fetch_array($sql);
  $cliente= $row['nombre_cliente'];
  $id_cliente=$row['id_cliente'];
  $nit_cliente=$row['nit_cliente'];
}

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
              <a href="?mod=rep_facturas_venta"><button  type="button" class="close fa fa-lg fa-print">Ir a Imprimir Factura</button></a><br><br>
              <a href="?mod=agg_cliente"><button  type="button" class="close fa fa-lg fa-user-plus">Nuevo Cliente</button></a>
              <h3 class="box-title">Ingresar Datos</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <form action="php/salida_fact_empresa.php" method="post">
                    <div class="col-sm-6 col-lg-6 content-wrapper__field-row">
                      <!-- NUMERO DE LA FACTURA  -->
                      <input type="text" class="form-control hidden" value="<?php echo $num_factura;?>" name="num_factura" placeholder="Ingrese el Nombre">

                      <!-- ID DEL USUARIO QUE TIENE LA SESION ABIERTA  -->
                      <input type="text" class="form-control hidden" value="<?php echo $_SESSION['id_usu'];?>" name="id_usuario" placeholder="Ingrese el Nombre">
                      <!-- ///////////////////////////////////////////// -->
                      
                      <span><b>Nombre o Razon Social</b></span>
                      <select class="form-control"  name="nombre_cliente"  required>
                           <?php include 'php/query.php'; ?>
                            <option value="<?php if (isset($_SESSION['nombre_cliente'])){ echo $id_cliente;}?>"><?php if (isset($_SESSION['nombre_cliente'])){ echo $cliente." Nit/CC: ".$nit_cliente;}else{echo "Selecione un Cliente";}?></option>
                             <!-- Bucle para extraer los Datos de las tabla Cliente -->
                            <?php while ($row=mysqli_fetch_array($buscar_cliente)): ?>
                            <option  name="" value="<?php echo $row['id_cliente']; ?>"><?php echo $row['nombre_cliente']." Nit/CC: ".$row['nit_cliente']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-sm-6 col-lg-6 content-wrapper__field-row">
                      <span><b>Fecha</b></span>
                      <input type="date" class="form-control" value="<?php if (isset($_SESSION['fecha_sal'])){ echo $_SESSION['fecha_sal'];}else{echo date('Y-m-d');}?>" name="fecha_sal" placeholder="Proveedor" required>
                    </div>
                    <div class="col-sm-6 col-lg-5 content-wrapper__field-row">
                      <span><b>Producto o Servicio</b></span>
                      <input hidden type="text" name="nom_producto" value="<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>" required>
                      <input type="text" value="<?php if(isset($_GET['producto'])){echo $_GET['producto'];} ?>" class="form-control" id="search" required>
                      <!--Lugar donde se Muestra la busquedad -->
                      <div class="content-wrapper__search-result" id="result">
                      </div>
                      <!--Lugar donde se Muestra la busquedad -->
                    </div>
                    <div class="col-sm-6 col-md-2 col-lg-2 content-wrapper__field-row">
                        <span><b>Precio</b></span>
                        <input class="form-control" value="<?php if(isset($_GET['precio'])){echo $_GET['precio'];}?>" type="number"  name="precio_st_pr" placeholder="Precio" required />
                    </div>
                    <div class="col-sm-6 col-md-1 col-lg-2 content-wrapper__field-row">
                        <span><b>Desc %</b></span>
                        <input class="form-control" value="0" type="number"  name="desc_pr" placeholder="Descuento" />
                    </div>
                    <div class="col-sm-6 col-md-1 col-lg-2 content-wrapper__field-row">
                        <span><b>Cantidad</b></span>
                        <input class="form-control" type="number" value="1" name="cant_st_pr" placeholder="Cantidad" required/>
                    </div>
                    <div class="col-sm-12 col-md-1 col-lg-1 content-wrapper__field-row content-wrapper__field-submit">
                        <input type="submit" name="agregar_st_pr" value="Agregar" class="btn btn-success"/>
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
                $query=$salida_producto;
                if($query->num_rows>0):
             ?>
            <section class="content carrito"> 
              <div class="row">
                <div class="col-xs-12 " align="center">
                  <div class="box box-default content-wrapper__table-container">
                      <table class="table table-striped content-wrapper__table">
                        <thead> 
                        
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre de Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio Unitario</th>
                            <th scope="col">Desc %</th>
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
                            <td><?php echo $f['nombre_producto']." ".$f['cod_producto'];?></td>
                            <td align="center"><?php echo $f['cantidad'];?></td>
                            <td><?php echo "$ ".number_format($f['monto'],0,",",".");?></td>
                            <td><?php echo "% ".number_format($f['desc_product'],0,",","."); ?></td>
                          <?php 
                                //  IF Descount
                                $montoDescuento = ($f['monto'] * $f['cantidad']) - ($f['monto'] * $f['cantidad'] * $f['desc_product'] / 100); 

                              ?>
                            <td><?php echo "$ ".number_format( $montoDescuento ,0,",",".");?></td>
                                <?php 
                                  // Total Price
                                  $precio_total += $montoDescuento; 
 
                                ?>
                            <td>
                              <a href="php/query.php?carrito_salida_empresa=<?php echo $f["id_salida"];?>&id_usuario=<?php echo $_SESSION['id_usu'];?>" class="btn btn-sm icon fa fa-trash fa-lg"></a>
                            </td>
                            <?php  endwhile;?>
                            
                          </tr>     
                        </tbody>
                        <thead>
                          <tr>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"><?php echo "$ ".number_format($precio_total,0,",",".");?></th>
                            <form action="php/salida_fact_empresa.php?id_usuario=<?php echo $_SESSION['id_usu'] ?>" method="POST">
                              <th>
                                <input type="submit" name="guardar_fact_empresa" value="Guardar" class="btn btn-info"/> 
                                <!-- <a title="Imprimir Factura" target="_blank" href="php/reportesPdf/reporte_venta.php?imprimir_venta&id_usuario=<?php echo $_SESSION['id_usu'] ?>"  class="btn btn-sm icon fa fa-print fa-2x fa-lg"></a> -->
                              </th>
                            
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
  