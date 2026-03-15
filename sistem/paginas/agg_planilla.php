<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<?php
@session_start();

//Mostrar el Nombre del Cliente
if (isset($_GET['id_cliente'])) {
  $_SESSION['cliente'] = $_GET['id_cliente'];
  $sql=mysqli_query($conexion,"SELECT nombre_cliente, nit_cliente FROM clientes WHERE id_cliente = '".$_SESSION['cliente']."' ");
  $row=mysqli_fetch_array($sql);
  $_SESSION['nombre_cliente'] = $row['nombre_cliente'];
  $_SESSION['nit_cliente'] = $row['nit_cliente'];
}

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Agregar Productos a la Planilla
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Agregar Productos a la Planilla</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="box box-info">
            <div align="center" class="box-header with-border">
              <button  type="button" class="close fa fa-lg fa-user-plus"><?php echo $_SESSION['nombre_cliente']." - Nit: ".$_SESSION['nit_cliente']; ?></button>
              <h3 class="box-title">Ingresar Datos</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <form action="php/salida_planilla.php" method="post">
                      <!-- ID DEL USUARIO QUE TIENE LA SESION ABIERTA  -->
                      <input type="text" class="form-control hidden" value="<?php echo $_SESSION['id_usu'];?>" name="id_usuario" placeholder="Ingrese el Nombre">
                      <!-- ID DEL CLIENTE  -->
                      <input type="text" class="form-control hidden" value="<?php echo $_SESSION['cliente'];?>" name="id_cliente" placeholder="Ingrese el Nombre">
                      <!-- ///////////////////////////////////////////// -->
                    <div class="col-xs-2">
                      <span><b>Fecha</b></span>
                      <input type="date" class="form-control" value="<?php if (isset($_SESSION['fecha_sal'])){ echo $_SESSION['fecha_sal'];}else{echo date('Y-m-d');}?>" name="fecha" placeholder="Proveedor" required>
                    </div>
                    <div class="col-xs-4">
                      <span><b>Producto</b></span>
                      <input hidden type="text" name="nom_producto" value="<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>" required>
                      <input type="text" value="<?php if(isset($_GET['producto'])){echo $_GET['producto'];} ?>" class="form-control" id="search_planilla" required>

                      <!--Lugar donde se Muestra la busquedad -->
                      <div style="position:relative; width:100%;height:110px;overflow:auto;" id="result">
                      </div>
                      <!--Lugar donde se Muestra la busquedad -->

                    </div>

                    <div class="col-xs-2">
                        <span><b>Precio</b></span>
                        <input class="form-control" value="<?php if(isset($_GET['precio'])){echo $_GET['precio'];}?>" type="number"  name="precio" placeholder="Precio" required />
                    </div>
                    <div class="col-xs-1">
                        <span><b>Cantidad</b></span>
                        <input class="form-control" type="number" value="1" name="cantidad" placeholder="Cantidad" required/>
                    </div><br>
                    <div class="col-xs-3">
                        <input type="submit" name="agregar_pd_planilla" value="Agregar" class="btn btn-success"/>
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
                $query=$salida_planilla;
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
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col"></th>
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
                            <td><?php echo number_format($f['monto'],2)." $";?></td>
                            <td><?php echo number_format($f['monto'] * $f['cantidad'], 2)." $";?></td>
                                <?php 

                                  $precio_total += $f['monto'] * $f['cantidad']; 
 
                                ?>
                            <td>
                              <a href="php/query.php?borrar_producto_planilla=<?php echo $f["id_producto"];?>&id_cliente=<?php echo $_SESSION['cliente'];?>" class="btn btn-sm icon fa fa-trash fa-lg"></a>
                            </td>
                            <?php  endwhile;?>
                            
                          </tr>     
                        </tbody>
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">SUB-TOTAL</th>
                            <th scope="col"><?php echo number_format($precio_total,2)." $";?></th>
                          </tr>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">RET-6%</th>
                            <th scope="col"><?php echo number_format($precio_total*0.06,2)." $";?></th>
                          </tr>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th style="font-size: 125%;" scope="col">TOTAL</th>
                            <th style="color:red; font-size: 125%" scope="col"><?php echo number_format($precio_total-$precio_total*0.06,2)." $";?></th>

                            <form action="php/salida_planilla.php?id_cliente=<?php echo $_SESSION['cliente'] ?>" method="POST">
                              <th><input type="submit" name="liquidar_planilla" value="Liquidar Factura" class="btn btn-info"/> 
                              <a title="Imprimir Factura" target="_blank" href="php/reportesPdf/reporte_planilla.php?imprimir_planilla&id_cliente=<?php echo $_SESSION['cliente'] ?>"  class="btn btn-sm icon fa fa-print fa-2x fa-lg">
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
  