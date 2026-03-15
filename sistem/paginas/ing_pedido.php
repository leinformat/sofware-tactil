<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<?php
@session_start();

//Mostrar el Nombre del Cliente
if (isset($_SESSION['nombre_proveedor'])) {
  $sql=mysqli_query($conexion,"SELECT nombre_proveedor,id_proveedor,nit_proveedor FROM proveedores WHERE id_proveedor = '".$_SESSION['nombre_proveedor']."' ");
  $row=mysqli_fetch_array($sql);
  $proveedor= $row['nombre_proveedor'];
  $id_proveedor=$row['id_proveedor'];
  $nit= $row['nit_proveedor'];
}
?>

<style>
  /* Custom  */
  .pago__credito{
    display:none;
  }

  .pago__credito.active{
    display:block;
  }
</style>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ingreso de Pedidos
      </h1>
      <ol class="breadcrumb">
        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Ingresos</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="box box-info">
            <div align="center" class="box-header with-border">
              <a href="?mod=agg_proveedor"><button  type="button" class="close fa fa-lg fa-user-plus">Nuevo Proveedor</button></a>
              <br><br>
              <a href="?mod=agg_producto"><button  type="button" class="close fa fa-lg fa-shopping-cart"> Nuevo Producto</button></a>
              <h1 class="box-title">Ingresar Factura</h1>
            </div>
            <div class="box-body">
              <div class="row">
                <form action="php/ing_pedido.php" method="post">
                    <div class="col-sm-6 col-lg-3 content-wrapper__field-row">
                      <!-- ID DEL USUARIO QUE TIENE LA SESION ABIERTA  -->
                      <input type="text" class="form-control hidden" value="<?php echo $_SESSION['id_usu'];?>" name="id_usuario" placeholder="Ingrese el Nombre">
                      <!-- ///////////////////////////////////////////// -->
                      
                      <span><b>Numero de Factura</b></span>
                      <input type="number" class="form-control" value="<?php if (isset($_SESSION['nro_factura'])){ echo $_SESSION['nro_factura']; } ?>" name="nro_factura" placeholder="Numero de Factura"  required>
                    </div>
                    <div class="col-sm-6 col-lg-3 content-wrapper__field-row">
                      <span><b>Proveedor</b></span>
                      <select class="form-control"  name="nombre_proveedor"  required>
                           <?php include 'php/query.php'; ?>
                            <option value="<?php if (isset($_SESSION['nombre_proveedor'])){ echo $id_proveedor;}?>"><?php if (isset($_SESSION['nombre_proveedor'])){ echo $proveedor ." Nit/CC: ".$nit;}else{echo "Selecione un Proveedor";}?></option>
                             <!-- Bucle para extraer los Datos de las tabla Cliente -->
                            <?php while ($row=mysqli_fetch_array($list_proveedores)): ?>
                            <option  name="" value="<?php echo $row['id_proveedor']; ?>"><?php echo $row['nombre_proveedor']." Nit/CC: ".$row['nit_proveedor']; ?></option>
                            <?php endwhile; ?>
                      </select>
                    </div>
                    <div class="col-sm-6 col-lg-2 content-wrapper__field-row">
                      <span><b>Fecha de Ingreso</b></span>
                      <input type="date" name="fecha_ing" class="form-control" value="<?php if (isset($_SESSION['fecha_ing'])){ echo $_SESSION['fecha_ing']; } ?>" required>
                    </div>
                    <div class="col-sm-6 col-lg-2 content-wrapper__field-row">
                      <span><b>Forma de Pago</b></span>
                      <select class="form-control pay-method"  name="forma_pago"  required>
                            <option value="<?php if (isset($_SESSION['forma_pago'])){ echo $_SESSION['forma_pago'];}?>"><?php if (isset($_SESSION['forma_pago'])){ echo $_SESSION['forma_pago'];}else{echo "Selecione una Forma de Pago";}?></option>
                             <!-- Forma de Pago Disponibles -->
                            <option  name="" value="Al contado">Al Contado</option>
                            <option  name="" value="A credito">A Credito</option>                            
                      </select>
                    </div>
                    <div class="pago__credito col-sm-6 col-lg-2 content-wrapper__field-row">
                      <span><b>Vencimiento</b></span>
                      <input type="date" name="plazo" class="form-control" value="<?php if (isset($_SESSION['plazo'])){ echo $_SESSION['plazo']; } ?>" >
                    </div>
                    <div class="col-sm-6 col-lg-4 content-wrapper__field-row">
                      <span><b>Producto o Servicio Realizado</b></span>
                      <input hidden type="text" name="nom_producto" value="<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>" required>
                      <input type="text" value="<?php if(isset($_GET['producto'])){echo $_GET['producto'];} ?>" class="form-control" id="search_ingreso" required>

                      <!--Lugar donde se Muestra la busquedad -->
                      <div class="content-wrapper__search-result" id="result">
                      </div>
                      <!-- End Lugar donde se Muestra la busquedad /> -->
                    </div>
                    <div class="col-sm-6 col-lg-3 content-wrapper__field-row content-wrapper__field-submit">
                        <input class="form-control" required type="number" name="cant_producto" placeholder="Cantidad"/>
                    </div>
                    <div class="col-sm-6 col-lg-3 content-wrapper__field-row content-wrapper__field-submit">
                        <input class="form-control" required type="number" name="precio_producto" placeholder="Precio Unitario"/>
                    </div>
                    <div class="col-sm-6 col-lg-2 content-wrapper__field-row content-wrapper__field-submit">
                        <input type="submit" name="agregar_producto" value="Agregar" class="btn btn-success"/>
                        <br><br>
                    </div>
                </form>          
            </div>
            <!-- Notificaciones -->
              </div>
            <!-- /.box-body -->
          </div>
        </div>
    </section>

    <!-- Carrito-->

     <?php 
        include 'php/query.php';
        $n=1;
        $query= $ingreso_factura;
        if($query->num_rows>0):
     ?>
    <section class="content carrito">
      <div class="row">
        <div class="col-xs-12 " align="center">
          <div class="box box-default content-wrapper__table-container">
              <table class="table table-striped content-wrapper__table-2">
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
                  <?php 
                        $n=1;
                        $precio_unit = 0  ;
                        $precio_total = 0;
                  ?>
                  <?php while ($f=$query->fetch_array()):?>
                  
                  <tr>
                    <th scope="row"><?php echo $n++;?></th>
                    <td><?php echo $f['nombre_producto']." ".$f['cod_producto'];?></td>
                    <td align="center"><?php echo $f['cantidad'];?></td>
                    <td><?php echo number_format($f['precio'],2)." $";?></td>
                    <td><?php echo number_format($f['precio'] * $f['cantidad'], 2)." $";?></td>
                        <?php 
                          $precio_unit += $f['precio'];
                          $precio_total += $f['precio'] * $f['cantidad']; 

                        ?> 
                    <td>
                      <a href="php/query.php?carrito_entrada=<?php echo $f["id_producto"];?>&id_usuario=<?php echo $_SESSION['id_usu'];?>" class="btn btn-sm icon fa fa-trash fa-lg">
                        
                      </a>
                    </tr>
                    <?php  endwhile;?>           
                </tbody>
                <thead>
                  <tr>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"><?php echo number_format($precio_unit, 2) . " $"; ?></th>
                    <th scope="col"><?php echo number_format($precio_total,2)." $";?></th>
                    <form action="php/ing_pedido.php?id_usuario=<?php echo $_SESSION['id_usu'] ?>" method="POST">
                      <th><input type="submit" name="guardar_pedido" value="Guardar" class="btn btn-info"/></th>
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
