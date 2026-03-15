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
				<td>CANTIDAD</td>
				<td>VR.COMPRA</td>
				<td>VR.VENTA</td>
				<td>VR. TOTAL</td>
				<td>EDITAR</td>
				<td>BORRAR</td>
			</tr>
		</thead>
		<tfoot style="background-color: #ccc;color: white; font-weight: bold;">
			<tr>
				<td>COD</td>
				<td>PRODUCTO</td>
				<td>CATEGORIA</td>
				<td>CANTIDAD</td>
				<td>VR.COMPRA</td>
				<td>VR.VENTA</td>
				<td>VR. TOTAL</td>
				<td>EDITAR</td>
				<td>BORRAR</td>
			</tr> 
		</tfoot>
		<tbody >
			<?php 
			$result=mysqli_query($conexion,$inventario);
			while ($datos=mysqli_fetch_row($result)) {
				?>
				<tr >
					<td><?php echo $datos[1] ?></td>
					<td><?php echo $datos[2] ?></td>
					<td><?php echo $datos[3] ?></td>
					<td><?php echo $datos[4] ?></td>
					<td><?php echo "$ ".number_format($datos[5],0,",",".") ?></td>
					<td><?php echo "$ ".number_format($datos[6],0,",",".") ?></td>
					<td><?php echo "$ ".number_format($datos[4] * $datos[6],0,",",".") ?></td>
					<td style="text-align: center;">
						<a title="Editar" href="?mod=form_modificar_prod&editar_producto=<?php echo $datos[0]; ?>"  class="btn btn-sm icon fa fa-edit fa-lg">
                      </a>
					</td>
					<td style="text-align: center;">
						<a title="Borrar" href="#" id="del-<?php echo $datos[0];?>" class="btn btn-sm icon fa fa-trash fa-lg">                        
                      </a>
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