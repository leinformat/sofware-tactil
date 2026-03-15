<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<!-- Large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" align="center" style="color:#0066B2;" >Ingrese los Servicios Tecnicos Realizador por: <?php echo "<b>$nombre</b>"; ?></h4>
      </div>
             <table class="table bg-info"  id="tabla">
               <tr class="fila-fija">
                <div class="input-group">
                  <td class="hidden"><input class="form-control" value="<?php echo $_POST['id_empleado']; ?>" required name="id_empleado[]"/></td>
                  <td><input class="form-control" required type="date" name="fecha[]" placeholder="Fecha"/></td>
                  <!-- Bucle para extraer los Datos de las tabla nombre_empleados -->
                  <td><select class="form-control" name="servicio[]" required>
                      <?php include 'php/query.php'; ?>
                        <option value="">Seleccione Servicio Realizado</option>
                        <!-- Bucle para extraer los Datos de las tabla tipo de Servicio Tecnico -->
                        <?php while ($row=mysqli_fetch_array($tipo_st)): ?>
                        <option value="<?php echo $row['id_tipo_ser']; ?>"><?php echo $row['nombre_tst']; ?></option>
                        <?php endwhile; ?>
                    </select></td>
                  <td><input class="form-control" required name="precio[]" placeholder="Precio"/></td>
                  <td class="eliminar"><input type="button" class="form-control btn-info"  value="Menos -"/></td>
                </div>
                    </tr>
              </table>

              <div class="btn-der">
                 <input type="submit" name="insertar" value="Guardar Registros" class="btn btn-info"/>
                 <button id="adicional" name="adicional" type="button" class="btn btn-success"> Más + </button>
                 <br><br>
              </div>
          </form>
          <?php include_once 'php/trabajo.php' ?>
    </div>
  </div>
</div>




