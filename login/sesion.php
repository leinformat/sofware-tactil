<?php 
	@session_start();
	if($_SESSION["usuario"]==''){
		header("location:../index.php?error1");
	}

	$sql= mysqli_query($conexion,"SELECT sid FROM usuarios WHERE id_usuario = '".$_SESSION['id_usu']."' && sid != '".$_SESSION['sid']."' ");

	$num= mysqli_num_rows($sql);
		if ($num > 0) {
			header("location:../index.php?error3");
		}
 ?>