<!--
	DEVELOPER: ING. LEONARDO MORALES
	EMAIL: LEINFORMAT@GMAIL.COM
	PHONE: +57 322 879 0912
 -->
<?php 
$mod = isset($_GET['mod']) ? str_replace('.', '', $_GET['mod']) : '';


if($mod) {
	$dir = "paginas/{$mod}.php";
	
	if($dir) {	
			include($dir);
		
	} else {
		echo('El modulo no existe');
	}
	
	} else {
		
		include 'paginas/inicio.php';
} 

//$swphp_contenido = ob_get_clean();                                                                                                                         