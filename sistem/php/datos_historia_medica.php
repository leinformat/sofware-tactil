<?php

require '../conexion.php'; 

			//Lista de Altas Medicas 
			$query= mysqli_query($conexion, "SELECT * FROM consultas_vet CV INNER JOIN usuarios U,mascotas M, clientes C, estado_consultas EC, tipo_mascota TM WHERE CV.id_usuario = U.id_usuario AND CV.id_pry_mascota= M.id_pry_mascota AND M.id_cliente = C.id_cliente AND CV.estado_consulta_mascota = EC.id_estado_consulta AND M.id_tipo_mascota = TM.id_tipo_mascota AND M.id_pry_mascota = '".$_GET['imprimir_historia']."' ORDER BY CV.fecha_consulta_mascota DESC");
		
			$row=$query->fetch_assoc();
				$n_historia_mascota= $row['n_historia_mascota'];
				$id_mascota= $row["id_mascota"];
				