<!--
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
 -->
<?php 
	//Prestamos
	if (isset($_POST['prestamo'])) {
		$prestamo= mysqli_query($conexion, "INSERT INTO prestamos(id_empleado, fecha, monto) VALUES('".$_POST['id_empleado']."', '".$_POST['fecha']."','".$_POST['monto']."')");
		echo "<div class='alert alert-info alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-info'></i> Registro Satisfactorio!</h4>
              </div>";
	}
 ?>