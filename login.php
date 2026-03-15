<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>InfoLm</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
  <link rel="shortcut icon" href="imagenes/favicon.ico">
  <!-- Ionicons -->
<!--===============================================================================================-->	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="container-login100" style="background-image: url('login/images/bg-01.jpg');">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<form class="login100-form validate-form" action="login/verificar.php" method="post">
				<span class="login100-form-title p-b-37">
					Inicio de Sesion
				</span>

				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
					<input autocomplete="off" class="input100" type="text" name="usuario" placeholder="Nombre de Usuario">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 m-b-25" data-validate = "Enter password">
					<input autocomplete="off" class="input100" type="password" name="password" placeholder="Contraseña">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn">
						Ingresar
					</button>
				</div>

				<!-- Errores -->
									<?php 

							            if (isset($_GET["error1"])){

							                  echo "<div  class='error'>
							                          <strong>Error!</strong> Para Poder Ingresar al Sistema debe Iniciar Session .
							                        </div>
							                        ";
							               }

							            elseif (isset($_GET["error2"])){

							                  echo "<div class='error'>
							                          <strong>Error!</strong> Usuario y/o Contraseña incorrectos.
							                        </div>
							                        ";
							               }

							            elseif (isset($_GET["error3"])){

							                  echo "<div class='error'>
							                          <strong>Error!</strong> Han Ingresado Con Tu mismo Usuario y Contraseña Desde otro Dispositivo.
							                        </div>
							                        ";
							               }

							            elseif (isset($_GET["alert_logout"])){

							                  echo "<div class='error exito'>
							                          <strong>Exito!</strong>Sesion Cerrada Correctamente.
							                        </div>
							                        ";
							               }
							            ?> 
			</form>

			
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/daterangepicker/moment.min.js"></script>
	<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="login/js/main.js"></script>

</body>
</html>