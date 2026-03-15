<?php 

require_once "../../php/datatables/query.php";
?>

<div class="content-wrapper__table-container">
	<table class="table table-hover table-condensed table-bordered content-wrapper__table-2" id="iddatatable">
		<thead style="background-color: #3c8dbc;color: white; font-weight: bold;">
			<tr>
				<td>NUM.FACTURA</td>
				<td>CLIENTE</td>
				<td>NIT</td>
				<td>FECHA</td>
				<td>TICKET</td>
				<td>IMPRIMIR</td>
			</tr>
		</thead>
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>NUM.FACTURA</td>
				<td>CLIENTE</td>
				<td>NIT</td>
				<td>FECHA</td>
				<td>TICKET</td>
				<td>IMPRIMIR</td>
			</tr> 
		</tfoot>
		<tbody >
			<?php
			$n= 1;
			$result=mysqli_query($conexion,$facturas_venta);
			while ($datos=mysqli_fetch_row($result)) {
				?>
				<tr>
					<td><?php echo str_pad($datos[0], 5,"0", STR_PAD_LEFT) ?></td>
					<td><?php echo $datos[1] ?></td>
					<td><?php echo $datos[2] ?></td>
					<td><?php echo $datos[3] ?></td>
					<td style="text-align: center;">
						<a target="_blank" title="IMPRESION POST" href="php/reportesPdf/reporte_venta_post.php?imprimir_venta2&num_fact=<?php echo $datos[0]; ?>" id="" class="btn btn-sm icon fa fa-print  fa-lg"></a>
					</td>
					<td style="text-align: center;">
						<a target="_blank" title="IMPRESION" href="php/reportesPdf/reporte_venta.php?imprimir_venta2&num_fact=<?php echo $datos[0]; ?>" id="" class="btn btn-sm icon fa fa-print fa-2x fa-lg"></a>
					</td>
				</tr>
				<?php 
			}
			?>
		</tbody>
	</table>
</div>

<script src="../js/datatable.js"></script>