<!DOCTYPE html>
<html class="backgroundImage">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <title>Sistema de Gestión &mdash; Inventario y Facturación</title>
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700|Lemon' rel='stylesheet' type='text/css'>
        <!-- Favicon -->
        <link rel="shortcut icon" href="imagenes/favicon.ico">
        <!-- CSS -->
        <link rel="stylesheet" href="mantenimiento/css2/bootstrap.min.css" />
		<link rel="stylesheet" href="mantenimiento/css2/font-awesome.min.css" />
        <link rel="stylesheet" href="mantenimiento/css2/animate.css" />
        <link rel="stylesheet" href="mantenimiento/css2/YTPlayer.css" />
        <link rel="stylesheet" href="mantenimiento/css2/supersized.css" />
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="mantenimiento/css2/styles.css" />

	

        
    </head>
    <body>

        <!-- CONTAINER -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section clearfix">
                        <h1 class="logo animated fadeInDown">Sistema de Gestión &mdash; Inventario y Facturación</h1>
                        <br>
                        <div id="text_slider">
                            <div class="slide clearfix"><h2>Ingrese sus Datos para Iniciar el Sistema</h2></div>

                            <div class="slide clearfix"><h2>¡GRACIAS!</h2></div>
                        </div>
                        
                    </div>

                   <div class="limiter">
						<div class="container-login100">
							<div class="wrap-login100">
								<form action="login/verificar.php" class="login100-form validate-form" method="post">
									<div class="wrap-input100 validate-input m-b-26">
										<span class="label-input100">Usuario</span>
										<input autocomplete="off" class="input100" type="text" autofocus name="usuario" placeholder="Ingrese su Usuario" required>
										<span class="focus-input100"></span>
									</div>

									<div class="wrap-input100 validate-input m-b-18">
										<span class="label-input100">Contraseña</span>
										<input autocomplete="off" class="input100" type="password" name="password" placeholder="Ingrese su Contraseña" required>
										<span class="focus-input100"></span>
									</div>


									<div class="container-login100-form-btn" >
										<button class="login100-form-btn">
											Login
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
							                          <strong>Exito!</strong>Session Cerrada Correctamente.
							                        </div>
							                        ";
							               }
							            ?> 
								</form>
							</div>
						</div>
					</div>

                    <div class="section clearfix animated fadeIn" id="contact">
                        <a href="#"><i class="fa fa-envelope-o"></i> leinformat@gmail.com</a>
                        <a href="#"><i class="fa fa-phone"></i> (+57) 322 8790912</a>
                    </div>


                    <div class="section clearfix">
                        <a href="#" class="btn btn-transparent btn-facebook"><i class="fa fa-facebook fa-fw"></i></a>
                        <a href="#" class="btn btn-transparent btn-twitter"><i class="fa fa-twitter fa-fw"></i></a>
                        <a href="#" class="btn btn-transparent btn-googleplus"><i class="fa fa-google-plus fa-fw"></i></a>
                        <a href="#" class="btn btn-transparent btn-youtube"><i class="fa fa-youtube fa-fw"></i></a>
                        <a href="#" class="btn btn-transparent btn-pinterest"><i class="fa fa-pinterest fa-fw"></i></a>
                        <a href="#" class="btn btn-transparent btn-instagram"><i class="fa fa-instagram fa-fw"></i></a>
                        <a href="#" class="btn btn-transparent btn-linkedin"><i class="fa fa-linkedin fa-fw"></i></a>
                    </div>

                </div>
            </div>
        </div>
        <!-- END CONTAINER -->

        <!-- FOOTER -->
        <div id="">
                <a>Diseñado por Ing. Leonardo Morales</a>
        </div>
        <!-- END FOOTER -->

		<!-- JS -->
        <script src="mantenimiento/js2/jquery.min.js"></script>
        <script src="mantenimiento/js2/jquery.plugin.js"></script>
        <script src="mantenimiento/js2/bootstrap.min.js"></script>
        <script src="mantenimiento/js2/jquery.countdown.min.js"></script>
        <script src="mantenimiento/js2/supersized.min.js"></script>
        <script src="mantenimiento/js2/jquery.cycle.min.js"></script>
        <script src="mantenimiento/js2/jquery.mb.YTPlayer.js"></script>
        <script src="mantenimiento/js2/scripts.js"></script>
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        
    </body>
</html>