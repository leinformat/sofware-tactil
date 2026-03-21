<?php 

require_once "../../php/datatables/query.php";
?>

<div class="content-wrapper__table-container">
	<table class="table table-hover table-condensed table-bordered content-wrapper__table-2" id="iddatatable">
		<thead style="background-color: #3c8dbc;color: white; font-weight: bold;">
			<tr>
				<td>COD</td>
				<td>PRODUCTO</td>
				<td>CATEGORIA</td>
				<td>Restaurar</td>
			</tr>
		</thead>
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>COD</td>
				<td>PRODUCTO</td>
				<td>CATEGORIA</td>
				<td>Restaurar</td>
			</tr>
		</tfoot>
		<tbody >
			<?php 
			$result=mysqli_query($conexion,$deltedProducts);
			while ($datos=mysqli_fetch_row($result)) {
				?>
				<tr >
					<td><?php echo $datos[1] ?></td>
					<td><?php echo $datos[2] ?></td>
					<td><?php echo $datos[3] ?></td>

					<td style="text-align: center;">
						<a title="Restaurar" href="#" id="del-<?php echo $datos[0];?>" class="btn btn-sm icon fa fa-undo fa-lg">                        
                      </a>
					</td>
				</tr>
				<script>
		            $("#del-"+<?php echo $datos[0];?>).click(function(e){
		                e.preventDefault();
		                p = confirm("Estas seguro? Este producto sera devuelto al Inventario");
		                    if(p){
		                       window.location="php/query.php?restore-product="+<?php echo $datos[0];?>;
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