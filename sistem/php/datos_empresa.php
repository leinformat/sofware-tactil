<?php 
	require 'conexion.php';
	$consulta_datos = mysqli_query($conexion,"SELECT * FROM datos_empresa");
        $row =$consulta_datos->fetch_array();
            $nit_empresa=$row['nit_empresa'];
            $nombre_empresa=$row['nombre_empresa'];
            $direccion_empresa= $row['direccion_empresa'];
            $telefono_empresa= $row['telefono_empresa'];
            $email_empresa= $row['email_empresa'];
            $descripcion_empresa= $row['descripcion_empresa'];
            $logo_empresa= $row['logo_empresa'];