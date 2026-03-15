<?php 
	require 'conexion.php';
	//Datos de la Imagen
	$nombre_imagen= $_FILES['imagen']['name'];
	$tipo_imagen = $_FILES['imagen']['type'];
	$tamano_imagen= $_FILES['imagen']['size'];

	//validamos el Tamaño de la imagen Para Los Usuarios antes de Guardarla
	if ($tamano_imagen <= 2000000 && isset($_POST['edit_usuario']) )
	{
		//Validamos los Formatos Permitidos para las imagenes
		if ($tipo_imagen == 'image/jpeg' || $tipo_imagen == 'image/jpg' || $tipo_imagen == 'image/png' || $tipo_imagen == 'image/gif')
			{
				//Movemos la imagen al directorio dentro del sistema
				$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . "/imagenes/";
				//Movemos la imagen del directorio temporal al escogido
				move_uploaded_file($_FILES['imagen'] ['tmp_name'], $carpeta_destino.$nombre_imagen);

				//Actualizamos la ruta de la imagen en la Base de datos
					$sql= mysqli_query($conexion,"UPDATE usuarios SET foto_usu='$nombre_imagen' WHERE id_usuario = '".$_POST['id_usuario']."' ");

					print "<script>window.location='../?mod=datos_usuario&cambio_datos';</script>";
			}
			else
			{
				print "<script>window.location='../?mod=datos_usuario&error1';</script>";
			}
	}

	//validamos el Tamaño de la imagen Para La Empresa antes de Guardarla
	elseif ($tamano_imagen <= 2000000 && isset($_POST['edit_empresa'])  )
	{
		//Validamos los Formatos Permitidos para las imagenes
		if ($tipo_imagen == 'image/jpeg' || $tipo_imagen == 'image/jpg' || $tipo_imagen == 'image/png' || $tipo_imagen == 'image/gif')
			{
				//Movemos la imagen al directorio dentro del sistema
				$carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . "/imagenes/";
				//Movemos la imagen del directorio temporal al escogido
				move_uploaded_file($_FILES['imagen'] ['tmp_name'], $carpeta_destino.$nombre_imagen);

				//Actualizamos la ruta de la imagen en la Base de datos
					$sql= mysqli_query($conexion,"UPDATE datos_empresa SET logo_empresa='$nombre_imagen' ");

					print "<script>window.location='../?mod=datos_empresa&cambio_datos';</script>";
				
			}
			else
			{
				print "<script>window.location='../?mod=datos_empresa&error1';</script>";
			}
	}

	
	
 ?>