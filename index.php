<?php
	// CAMBIAR A  1 PARA REALIZAR MANTENIMIENTO DE EL SISTEMA
	$mantenimiento = 0;
	/////////////////////////////////////////////////////////

	if ($mantenimiento == 1) 
	{
		include 'mantenimiento.php';
	}
	else
	{
		include 'login.php';	
	}
