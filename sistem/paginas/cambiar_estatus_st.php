<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
		<section class="content-header">
	      <h1>
	         Reporte<small>Cambiar Estatus</small>
	      </h1>
        <h2>
           <small><?php echo $_GET['nombre_cliente']."  ". $_GET['fecha_ing']; ?></small>
        </h2>
	      <ol class="breadcrumb">
	        <li><a href="?mod=inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>
	        <li class="active">Cambiar Estatus</li>
	      </ol>
	    </section>
	    <!-- Horizontal Form -->
	    <div class="col-md-12 center">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Estado del Servicio Tecnico</b></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <?php
                  $query= mysqli_query($conexion,"SELECT * FROM estatus E JOIN servicio_tec S  WHERE E.id_estatus = S.estatus AND S.id_servicio = '".$_GET['id-servicio']."' ");
                                $r=$query->fetch_array();
                                $id_estatus= $r['id_estatus'];
                                $estatus= $r['nombre_status'];
                                $id_servicio= $r['id_servicio'];
                                $monto = $r['monto_total'];
                                $descripcion =$r['descripcion'];
                                $abono =$r['abono'];
                                $equipo =$r['equipo_st'];
                                $fecha_egreso = $r['fecha_retiro'];
                              ?>                               
                            <form action="php/query.php?<?php if(isset($_GET['entregado'])){echo 'entregado';}?>" method="post">
                                <div class="col-xs-4">  
                                  <!--Id Usuario -->
                                  <input type="text" class="form-control hidden" name="id_usuario" value="<?php echo $_SESSION['id_usu']; ?>" required>
                                  <input type="text" class="form-control hidden" name="id_servicio" value="<?php echo $id_servicio; ?>" required>
                                  <span><b>Cambiar Estatus</b></span>
                                  <select class="form-control estatus" name="nuevo_status" required>
                                       <?php include 'php/query.php'; ?>
                                        <option hidden value="<?php echo $id_estatus ?>"><?php echo $estatus; ?></option>
                                         <!-- Bucle para extraer los Datos de las tabla Estatus -->
                                        <?php while ($row=mysqli_fetch_array($list_status)): ?>
                                        <option  name="" value="<?php echo $row['id_estatus']; ?>"><?php echo $row['nombre_status']; ?></option>
                                        <?php endwhile; ?>
                                  </select>
                                </div>
                                <div class="col-xs-4">
                                  <span><b>Indique el Monto Abonado por el Cliente</b></span>
                                  <input type="number" class="form-control abono" onChange="suma" name="abono_st" value="<?php echo $abono; ?>" placeholder="Abono">
                                </div>
                                <div class="col-xs-4">
                                  <span><b>Indique el Monto Total del Servicio</b></span>
                                  <input type="number" class="form-control total" name="monto_st" value="<?php echo $monto; ?>" required>
                                </div><br>
                                <br>
                                <br>
                                <br>
                                <div class="form-group col-xs-4">
                                  <span><b>Descripción</b></span>
                                  <textarea class="form-control" rows="3" name="desc_st" placeholder="Ingrese Tipo de Equipo, Accesorios y demas Caracteristicas" required><?php echo $descripcion ?></textarea>
                                </div>
                                <div class="col-xs-2">
                                  <span><b>Equipo</b></span>
                                  <input type="text" class="form-control" value="<?php echo $equipo; ?>"  name="equipo_st" required>
                                </div>
                                <div class="col-xs-4">
                                  <span><b>FECHA DE ENTREGA "INDICAR SOLO CUANDO SEA ENTREGADO"</b></span>
                                  <input type="date" value="<?php echo $fecha_egreso  ?>" class="form-control entregado" name="fecha_egreso">
                                </div>

                                <div class="col-xs-2">
                                  <span><b>Pendiente por Pagar</b></span>
                                  <input type="text" class="form-control saldo" readonly="">
                                </div>

                                  <br><br><br><br>                          
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-info" href="<?php if(isset($_GET['entregado'])){echo '?mod=equipos_entregados';}else{ echo '?mod=list_serv_tec';} ?>" >Cancelar</a>
                                    <button type="button submit" name="cambiar_estatus" class="btn btn-primary">Guardar Cambios</button>
                                </div>    
                            </form>              
          </div>
          <!-- /.box -->
       </div>
</div>
<script type="text/javascript">
    let abono = document.querySelector(".abono");
    let total = document.querySelector(".total");
    let saldo = document.querySelector(".saldo");
    let estatus = document.querySelector(".estatus");
    let entregado = document.querySelector(".entregado");
    entregado.readOnly = true;

    estatus.addEventListener("change",(e)=>{
        if(estatus.value == 3){
          entregado.readOnly = false;
        }else{
          entregado.readOnly = true;
        }
    });
    
    saldo.value = `$${total.value - abono.value}`;

    total.addEventListener("keyup", (e)=>{
        saldo.value = `$${total.value - abono.value}`;
    })
    abono.addEventListener("keyup", (e)=>{
        saldo.value = `$${total.value - abono.value}`;
    });
</script>