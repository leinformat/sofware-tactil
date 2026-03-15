<!--
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
-->
<?php include_once 'conexion.php'; ?>

<?php

if (isset($_POST['nuevo_producto'])) {

	$items1 = $_POST['cod_producto'];
	$items2 = $_POST['nom_producto'];
	$items3 = $_POST['cat_producto'];
	$items4 = $_POST['cantidad_producto'];
	$items5 = $_POST['precio_producto'];
	$items6 = $_POST['precio_compra_producto'];
	$items7 = $_POST['iva_producto'];
	$items8 = $_POST['estado_producto'];

	$itemsImgs = $_FILES['imagen']; // ← aquí vienen todas las imágenes

	while (true) {

		$item1 = current($items1);
		$item2 = addslashes(current($items2));
		$item3 = current($items3);
		$item4 = current($items4);
		$item5 = current($items5);
		$item6 = current($items6);
		$item7 = current($items7);
		$item8 = current($items8);

		$cod = ($item1 !== false) ? $item1 : "";
		$nom = ($item2 !== false) ? $item2 : "";
		$cat = ($item3 !== false) ? $item3 : "";
		$can = ($item4 !== false) ? $item4 : "";
		$pre = ($item5 !== false) ? $item5 : "";
		$pre_compra = ($item6 !== false) ? $item6 : "";
		$iva_prod = ($item7 !== false) ? $item7 : "";
		$est_prod = ($item8 !== false) ? $item8 : "";

		// =============================
		// UPLOAD DE IMAGEN x PRODUCTO
		// =============================
		$index = key($items1);
		$imgRuta = "";

		if (isset($itemsImgs['name'][$index]) && $itemsImgs['name'][$index] !== '') {

			$name = $itemsImgs['name'][$index];
			$tmp = $itemsImgs['tmp_name'][$index];

			// Validar tipo MIME
			$imgInfo = @getimagesize($tmp);
			if ($imgInfo !== false) {
				$tipo_imagen = $imgInfo['mime'];

				if ($tipo_imagen == 'image/jpeg' || 
					$tipo_imagen == 'image/jpg' || 
					$tipo_imagen == 'image/png' || 
					$tipo_imagen == 'image/gif') {

					$destDir = "uploads/products/";
					
					if (!file_exists($destDir)) {
						mkdir($destDir, 0777, true);
					}

					$fileName = time()."_". $index . "_" . basename($name);
					$destPath = $destDir . $fileName;

					if (move_uploaded_file($tmp, $destPath)) {
						$imgRuta = $destPath;
					}
				}
			}
		}

		// =============================
		// INSERT
		// =============================

		$sql = "INSERT INTO productos(
					cod_producto,
					nombre_producto,
					id_categoria,
					cantidad,
					precio_unid,
					precio_compra,
					iva_producto,
					estado_producto,
					img
				) VALUES (
					'$cod',
					'$nom',
					'$cat',
					'$can',
					'$pre',
					'$pre_compra',
					'$iva_prod',
					'$est_prod',
					'$imgRuta'
				)";

		$sqlRes = $conexion->query($sql);
		
		// =============================
		// NEXT VALUES
		// =============================
		$item1 = next($items1);
		$item2 = next($items2);
		$item3 = next($items3);
		$item4 = next($items4);
		$item5 = next($items5);
		$item6 = next($items6);
		$item7 = next($items7);
		$item8 = next($items8);

		if ($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false && $item7 === false && $item8 === false) break;
	}

	if ($sqlRes != null) {
		print "<script>window.location='?mod=agg_producto&exito';</script>";
	} else {
		print "<script>window.location='?mod=agg_producto&error';</script>";
	}
}