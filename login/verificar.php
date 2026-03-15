<?php 
	include("../sistem/php/conexion.php");
	$sql="SELECT * FROM usuarios u, roles r WHERE u.id_rol = r.id_rol && u.nick = '".$_POST['usuario']."' && u.password = '".$_POST['password']."'  ";
	$sql2="SELECT sid FROM usuarios WHERE sid >= 0 && nick = '".$_POST['usuario']."' &&
			password = '".$_POST['password']."' ";
	$ejecutar=$conexion->query($sql);
	$ejecutar_sql2=$conexion->query($sql2);
	$contar_resultado=mysqli_num_rows($ejecutar);
	$session_act=mysqli_num_rows($ejecutar_sql2);
	$rand = rand(1,10000);

	//validammos si Contraseña y Usuario son Correctos
	if ($contar_resultado>0) 
	{	
		$otro = mysqli_query($conexion, $sql);
		$datos = $otro->fetch_all(MYSQLI_ASSOC);
		var_dump($datos);
		//Validamos si el usuario tiene una Session Activa y agregamos un numero de SID aleatorio con la Funcion rand()
		if ($session_act >=1) 
		{
			$query=mysqli_query($conexion,"UPDATE usuarios SET sid = $rand WHERE nick = '".$_POST['usuario']."' && password = '".$_POST['password']."' ");
			$arreglo=mysqli_fetch_array($ejecutar);
			setcookie("id_usu",$arreglo['id_usuario']);
			setcookie("nick",$arreglo['nick']);
			setcookie("usuario",$arreglo['nombre_usu']);
			setcookie("foto",$arreglo['foto_usu']);
			setcookie("sid",$arreglo['sid']);
			setcookie("rol",$arreglo['nombre_rol']);
			session_start();
			$_SESSION["id_usu"]=$arreglo['id_usuario'];
			$_SESSION["usuario"]=$arreglo['nombre_usu'];
			$_SESSION["foto"]=$arreglo['foto_usu'];
			$_SESSION["sid"] = $rand;
			$_SESSION["rol"] = $arreglo['nombre_rol'];
			$_SESSION["id_rol"] = $arreglo['id_rol'];
			if ($query != NULL) {
				header("location:../sistem/");
			}else{
				echo "error";
			}
		}

	}else{
		header("location:../index.php?error2");
	}
 ?>