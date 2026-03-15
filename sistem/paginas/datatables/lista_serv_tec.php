<?php 

require_once "../../php/datatables/query.php";
?>

<div class="content-wrapper__table-container">
	<h1></h1>
	<table class="table table-hover table-condensed table-bordered content-wrapper__table-2" id="iddatatable">
		<thead align="center" style="background-color: #3c8dbc;color: white; font-weight: bold;">
			<tr>
				<td>REFERENCIA</td>
				<td>CLIENTE</td>
				<td>NIT</td>
				<td>TEL.CLIENTE</td>
				
				<td>DESCRIPCION</td>
				<td>INGRESO</td>
				<td>ESTATUS</td>
				<td>MONTO</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</thead>
		<tfoot align="center" style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>REFERENCIA</td>
				<td>CLIENTE</td>
				<td>NIT</td>
				<td>TEL.CLIENTE</td>
				
				<td>DESCRIPCION</td>
				<td>INGRESO</td>
				<td>ESTATUS</td>
				<td>MONTO</td>
				<td></td>
				<td></td>
				<td></td>
			</tr> 
		</tfoot>
		<tbody >
			<?php 
			$result=mysqli_query($conexion,$equipos_x_entregar);
			while ($datos=mysqli_fetch_row($result)) {
				?>
				<tr >
					<td><?php echo $datos[0] ?></td>
					<td><?php echo $datos[1] ?></td>
					<td><?php echo $datos[2] ?></td>
					<td><?php echo $datos[3] ?></td>
					
					<td><?php echo $datos[4] ?></td>
					<td><?php echo $datos[5] ?></td>
					<td><?php echo $datos[6] ?></td>
					<td><?php echo $datos[7] ?></td>
					<td style="text-align: center;">
						<a href="#" id="del-<?php echo $f["id_reporte"];?>" class="btn btn-sm icon fa fa-trash fa-lg">
                      </a>
					</td>
					<td style="text-align: center;">
						<a  href="?mod=cambiar_estatus_st&id-servicio=<?php echo $datos[0];  ?>&nombre_cliente=<?php echo $datos[1]; ?>&fecha_ing=<?php echo $datos[5]; ?>" class="btn btn-sm icon fa fa-edit fa-lg"> </a>
					</td>

					<td style="text-align: center;">
						<a  target="_blank" href="php/reportesPdf/reporte_equipo.php?imprimir=<?php echo $datos[0] ?>" class="btn btn-sm icon icon fa fa-print fa-lg"> </a>
					</td>
				</tr>
				<script>
		            $("#del-"+<?php echo $datos[0];?>).click(function(e){
		                e.preventDefault();
		                p = confirm("Estas seguro? Si Acepta Toda la informacion Relacionada con el producto Sera eliminada y no podra Recuperarse");
		                    if(p){
		                       window.location="php/query.php?borrar_producto="+<?php echo $datos[0];?>;
		                       }
		                        });
		        </script>
				<?php 
			}
			?>
		</tbody>
	</table>
</div>

<script src="../js/datatable.js"></script>