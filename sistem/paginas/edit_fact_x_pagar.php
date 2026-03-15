<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<?php
@session_start();

//Mostrar el Nombre del Cliente
if (isset($_GET['fact_por_pagar'])) {
  
  $sql=mysqli_query($conexion,"SELECT IP.numero_factura, IP.fecha_pedido, IP.plazo, IP.forma_pago,IP.estado, PV.nombre_proveedor, PV.nit_proveedor FROM ing_productos IP JOIN proveedores PV WHERE IP.id_proveedor = PV.id_proveedor AND IP.numero_factura = '".$_GET['fact_por_pagar']."' ");
  $row=mysqli_fetch_array($sql);
  
}

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Facturas por Pagar
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Facturas por Pagar</li>
      </ol>
    </section><br><br>
    <!-- Main content -->
    <section class="">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="box box-info">
            <div align="center" class="box-header with-border">
              <button  type="button" class="close fa fa-lg fa-user-plus"><?php echo $row['nombre_proveedor']." - Nit: ".$row['nit_proveedor']; ?></button>
              <h3 class="box-title">Datos de La Compra</h3>
            </div>
            <style>
                .description-block .fa{
                  color:#3C8DBC;
                }
            </style>
            <div class="description-block row">
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-file-text fa-lg"></i>
                    <span><?php echo "<b>Factura:</b> #". $row['numero_factura'] ?></span>
                    <span class="pull-right-container">
                    </span>
                </div>

                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-truck fa-lg"></i>
                    <span><?php echo "<b>Ingreso: </b>". $row['fecha_pedido'] ?></span>
                    <span class="pull-right-container">
                    </span>
                </div>

                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-hourglass-end fa-lg"></i>
                    <span><?php echo "<b>Vence: </b> ". $row['plazo'] ?></span>
                    <span class="pull-right-container">
                    </span>
                </div>

                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-credit-card fa-lg"></i>
                    <span><?php echo "<b>Pago:</b> ". $row['forma_pago'] ?></span>
                    <span class="pull-right-container">
                    </span>
                </div>
                
                <div class="col-md-2">
                    <span class="description-text"></span>
                    <i class="fa fa-money fa-lg"></i>
                    <span><?php echo "<b>Estado:</b> ". $row['estado'] ?></span>
                    <span class="pull-right-container">
                    </span>
                </div>

                <br><br>
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
                $query=$edit_fact_por_pagar;
                if($query->num_rows>0):
             ?>
            <section class="content carrito">
              <div class="row">
                <div class="col-xs-12 " align="center">
                  <div class="box box-default">
                      <table class="table table-striped">
                        <thead> 
                        
                          <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio Unitario</th>
                            <th scope="col">Precio Total</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php $precio_unit = 0  ;
                                $precio_total = 0;
                          ?>
                          <?php while ($f=$query->fetch_array()):?>
                          
                          <tr>
                            <td><?php echo $f['nombre_producto']." ".$f['cod_producto'];?></td>
                            <td align="center"><?php echo $f['cantidad'];?></td>
                            <td><?php echo number_format($f['precio'],2)." $";?></td>
                            <td><?php echo number_format($f['precio'] * $f['cantidad'], 2)." $";?></td>
                                <?php 
                                  $precio_total += $f['precio'] * $f['cantidad']; 
                                ?>
                            <td>
                            </td>
                            <?php  endwhile;?>
                            
                          </tr>     
                        </tbody>
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">TOTAL</th>
                            <th scope="col"><?php echo number_format($precio_total,2)." $";?></th>
                          </tr>
                          
                            

                            <form action="php/pagar_factura.php?factura=<?php echo $_GET['fact_por_pagar'] ?>" method="POST">
                              <th><input type="submit" name="pagar_factura" value="Pagar Factura" class="btn btn-info"/> 
        
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
  