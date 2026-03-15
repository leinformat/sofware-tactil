<?php 

require_once "../../php/datatables/query.php";
?>

<div class="content-wrapper__table-container">
	<table class="table table-hover table-condensed table-bordered content-wrapper__table-2" id="iddatatable">
		<thead style="background-color: #3c8dbc;color: white; font-weight: bold;">
			<tr>
				<td>#</td>
				<td>NOMBRE DEL CLIENTE</td>
				<td>NIT</td>
				<td>TELEFONO</td>
				<td>CORREO</td>
				<td>DIRECCION</td>
				<td>EDITAR</td>
			</tr>
		</thead>
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>#</td>
				<td>NOMBRE DEL CLIENTE</td>
				<td>NIT</td>
				<td>TELEFONO</td>
				<td>CORREO</td>
				<td>DIRECCION</td>
				<td>EDITAR</td>
			</tr> 
		</tfoot>
		<tbody >
			<?php
			$n= 1;
			$result=mysqli_query($conexion,$clientes);
			while ($datos=mysqli_fetch_row($result)) {
				?>
				<tr>
					<td><?php echo $n++; ?></td>
					<td><?php echo $datos[1] ?></td>
					<td><?php echo $datos[2] ?></td>
					<td><?php echo $datos[3] ?></td>
					<td><?php echo $datos[4] ?></td>
					<td><?php echo $datos[5] ?></td>
					<td style="text-align: center;">
						<a title="Editar" href="?mod=form_modificar_cliente&editar_cliente=<?php echo $datos[0]; ?>"  class="btn btn-sm icon fa fa-edit fa-lg">
                      </a>
					</td>
				</tr>
				<?php 
			}
			?>
		</tbody>
	</table>
</div>

<script src="../js/datatable.js"></script>