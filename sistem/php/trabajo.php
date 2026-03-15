<!--
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
 -->
<?php include_once 'conexion.php'?>

			<?php

				//////////////////////// PRESIONAR EL BOTÓN //////////////////////////
				if(isset($_POST['insertar']))

				{


				$items1 = ($_POST['id_empleado']);
				$items2 = ($_POST['servicio']);
				$items3 = ($_POST['fecha']);
				$items4 = ($_POST['precio']);
				 
				///////////// SEPARAR VALORES DE ARRAYS////////////
				while(true) {

				    //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
				    $item1 = current($items1);
				    $item2 = current($items2);
				    $item3 = current($items3);
				    $item4 = current($items4);
				    
				    ////// ASIGNARLOS A VARIABLES ///////////////////
				    $id=(( $item1 !== false) ? $item1 : ", &nbsp;");
				    $nom=(( $item2 !== false) ? $item2 : ", &nbsp;");
				    $carr=(( $item3 !== false) ? $item3 : ", &nbsp;");
				    $gru=(( $item4 !== false) ? $item4 : ", &nbsp;");

				    //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
				    $valores='('.$id.',"'.$nom.'","'.$carr.'","'.$gru.'"),';

				    //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
				    $valoresQ= substr($valores, 0, -1);
				    
				    ///////// QUERY DE INSERCIÓN ////////////////////////////
				    $sql = "INSERT INTO reportes(id_empleado, id_servicio_tec ,fecha, monto) 
					VALUES $valoresQ";

					
					$sqlRes=$conexion->query($sql) or mysql_error();

				    
				    // Up! Next Value
				    $item1 = next( $items1 );
				    $item2 = next( $items2 );
				    $item3 = next( $items3 );
				    $item4 = next( $items4 );
				    
				    // Check terminator
				    if($item1 === false && $item2 === false && $item3 === false && $item4 === false) break;
    
				}

				}

			?>