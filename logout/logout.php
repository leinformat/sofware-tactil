<?php 
//Iniciamos una Session Vacia 
session_start(); 
$_SESSION = array(); 

// Destruimmos la Session
session_destroy(); 

// Redirigimos  la Pagina de Login 
print "<script>window.location='../index.php?alert_logout';</script>";

 ?>