<?php

	$server = Route::ctrRouteServer();

	$url = Route::ctrRoute();

	/*=============================================
	INICIO DE SECCION DEL USUARIO
	=============================================*/
	if(isset($_SESSION["validarSession"])){


		if($_SESSION["validarSession"]=="ok"){

			echo '<script>

					localStorage.setItem("user", "'.$_SESSION["id"].'");

				</script>';

		}

	}



	/*=============================================
	API DE GOOGLE
	=============================================*/

	// https://console.developers.google.com/apis
	// https://github.com/google/google-api-php-client

	/*=============================================
	CREAR EL OBJETO DE LA API GOOGLE
	=============================================*/

	$cliente = new Google_Client();
	$cliente->setAuthConfig('model/client_secret.json');
	$cliente->setAccessType("offline");
	$cliente->setScopes(['profile','email']);


	/*=============================================
	RUTA PARA EL LOGIN DE GOOGLE
	=============================================*/

	$rutaGoogle = $cliente->createAuthUrl();

	/*=============================================
	RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE
	=============================================*/

	if(isset($_GET["code"])){

		$token = $cliente->authenticate($_GET["code"]);

		$_SESSION['id_token_google'] = $token;

		$cliente->setAccessToken($token);

	}

	/*=============================================
	RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
	=============================================*/

	if($cliente->getAccessToken()){

		$item = $cliente->verifyIdToken();

		

		$datos = array("nombre"=>$item["name"],
				   "email"=>$item["email"],
				   "foto"=>$item["picture"],
				   "password"=>"null",
				   "modo"=>"google",
				   "verificacion"=>0,
				   "emailEncriptado"=>"null");

		$answer = ControllerUser::ctrSocialNetworksReg($datos);

		

		echo '<script>
		
			setTimeout(function(){

				window.location = localStorage.getItem("rutaActual");

			},1000);

		 	</script>';

	


	}


?>


<!--=========================
=            Top            =
==========================-->

<div class="container-fluid barraSuperior" id="top">

	<div class="container">

		<div class="row">
			 
			 <!--=========================
			  =         SOCIALES        =
			  ==========================-->	
			 <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social">
			 	<ul>
			 			
					<?php

						$social = ControllerTemplate::ctrStyleTemplate();

						if(is_array($social)){

							$jsonRedesSociales=json_decode($social["redesSociales"],true);

						}
					

						
						foreach ($jsonRedesSociales as $key => $value) {

							if($value["activo"] !=0){

								echo '<li>
											<a href="'.$value["url"].'" target="_blank">
												<i class="fa '.$value["red"].' redSocial '.$value["estilo"].'" aria-hidden="true"></i>
											</a>
										</li>';




							}

							

							
						}

					?>


					

			 	</ul>
			 	
			 </div>	
			
			 <!--=========================
			  =          Registro      =
			  ==========================-->	
  			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro">

				<ul>

					<?php

						if(isset($_SESSION["validarSession"])){


							if($_SESSION["validarSession"]=="ok"){


								//var_dump($_SESSION["modo"]);

								if($_SESSION["modo"]=="directo"){

									//var_dump($_SESSION["photo"]);

									if($_SESSION["photo"]!=""){

										echo '<li>

											<img class="img-circle" src="'.$url.$_SESSION["photo"].'" width="10%"></img>
									
										</li>';


									}else{

										echo '<li>

											<img class="img-circle" src="'.$server.'views/img/usuarios/default/anonymous.png" width="10%"></img>
										</li>';


									}

									echo '  <li>|</li>

											<li><a href="'.$url.'profile">Ver perfil</a></li>

											<li>|</li>
											
											<li><a href="'.$url.'logOut">Salir</a></li>

											

									';


								}

								if($_SESSION["modo"] =="facebook"){

									echo '<li>	
											<img class="img-circle" src="'.$_SESSION["photo"].'" width="10%"></img>
										  </li>

										  <li>|</li>

										  <li><a href="'.$url.'profile">Ver perfil</a></li>

										  <li>|</li>
											
										  <li><a href="'.$url.'logOut" class="salir">Salir</a></li>


									';

								}

								if($_SESSION["modo"] =="google"){

									echo '<li>	
											<img class="img-circle" src="'.$_SESSION["photo"].'" width="10%"></img>
										  </li>

										  <li>|</li>

										  <li><a href="'.$url.'profile">Ver perfil</a></li>

										  <li>|</li>
											
										  <li><a href="'.$url.'logOut">Salir</a></li>


									';

								}


							}	


						}else{

							echo '	<li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
									<li>|</li>
									<li><a href="#modalRegistro" data-toggle="modal">Crear una cuenta</a></li>';

						}



					?>
					
					

				</ul>


			</div>	


		</div>
		
	</div>
	

</div>

<!--====  End of Top  ====-->

<!--=====================================
=           HEADER                      =
======================================-->

<header class="container-fluid">

	<div class="container">
		
		<div class="row" id="cabezote">
			 	
			<!--=====================================
			=          LOGOTIPO                     =
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo">
				<a href="<?php echo $url;  ?>">
					
					<img src="<?php echo $server.$social["logo"]; ?>" class="img-responsive">
				

				</a>
				
			</div>

			<!--=====================================
			=          CATEGORIA Y BUSCADOR       =
			======================================-->
			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">

				<!-- BOTON DE CATEGORIA -->
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">
					<p>CATEGORÍAS
						<span class="pull-right"><i class="fa fa-bars" aria-hidden="true"></i></span>
					</p>	
					
				</div>


				<!-- BUSCADOR -->

				<div class="input-group col-lg-8 col-md-8 col-sm-8 col-xs-12" id="buscador">
					
					<input type="search" name="buscar" class="form-control input-lg" placeholder="Buscar...">

					<span class="input-group-btn">
						
						<a href="<?php echo $url; ?>searcher/1/recientes">
							
							<button class="btn btn-default backColor" type="submit">

								<i class="fa fa-search"></i>
								
							</button>

						</a>

					</span>


				</div>
				
			</div>
			<!--====  End of CATEGORIA Y BUSCADOR  ====-->


			<!--=====================================
			=      Section CARRITO DE COMPRAS       =
			======================================-->
			
			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carrito">
				
				<a href="<?php echo $url;?>carrito-de-compras">
							
					<button class="btn btn-default pull-left backColor">

						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
								
					</button>

				</a>
				
				<p>TU CESTA <span class="cantidadCesta"></span><br>USD $ <span class="sumaCesta"></span></p>

			</div>
			<!--====  End of Section CARRITO  ====-->

		</div>	


		<!--=====================================
		=            Section CATEGORIAS            =
		======================================-->
		<div class="col-xs-12 backColor" id="categorias">


			<?php

					$item  = null;

					$value = null;


					$categories = ControllerProduct::ctrViewCategories($item, $value);

					if (is_array($categories)) {
						# code...
						foreach ($categories as $key => $value) {
							
							if($value["state"] !=0){


							# code...
								echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
						
										<h4>
											<a href="'.$url.$value["route"].'" class="pixelCategorias" titulo="'.$value["categories"].'">'.$value["categories"].'</a>
										</h4>
										
										<hr>

										<ul>';


										$item = "id_categories"; 

										$v = $value["id"]; 

										
										$subcategory = ControllerProduct::ctrViewSubcategory($item, $v);

										

										foreach ($subcategory as $key => $value) {
											# code...
											if($value["state"] !=0){

												echo '<li><a href="'.$url.$value["route"].'" class="pixelSubCategorias" titulo="'.$value["subcategory"].'">'.$value["subcategory"].'</a></li>';
										

											}

										}



										echo '</ul>

							
								</div>';

							}
						}

						
					}
					

					


			?>			
			
	
		</div>
			
		<!--====  End of Section CATEGORIAS    ====-->
		

	</div>

</header>

<!--====  End of Section header  ====-->

<!--====================================================
=            Ventana Modal para el Registro            =
=====================================================-->

<div class="modal fade modalFormulario" id="modalRegistro" role="dialog">

    <div class="modal-dialog modal-content">
    

        <div class="modal-body modalTitulo">

			<h3 class="backColor">REGISTRARSE</h3>

        	<button type="button" class="close" data-dismiss="modal">&times;</button>

        	<!--====================================================
			=          Registro Facebook                          =
			=====================================================-->
			<div class="col-md-6 col-xs-12 facebook" >
				
				<p>
					<i class="fa fa-facebook"></i>
					Registro con FaceBook
				</p>	


			</div>

			<!--====================================================
			=      Registro   Google					       =
			=====================================================-->
			<a href="<?php echo $rutaGoogle; ?>">
				<div class="col-md-6 col-xs-12 google">
					
					<p>
						<i class="fa fa-google"></i>
						Registro con Google
					</p>	


				</div>
			</a>
			<!--====================================================
			=      Registro  local					       =
			=====================================================-->

			<form method="post" onsubmit="return registroUsuario()">
				
				<hr>

				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-user"></i>
						</span>

						<input type="text" class="form-control input-lg text-uppercase" id="regUsuario" name="regUsuario" placeholder="Nombre Completo" required>

					</div>
				</div>

				
				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-envelope"></i>
						</span>

						<input type="email" class="form-control input-lg" id="regEmail" name="regEmail" placeholder="Correo Electronico" required>

					</div>
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-lock"></i>
						</span>

						<input type="password" class="form-control input-lg" id="regPassword" name="regPassword" placeholder="Contraseña" required>

					</div>
				</div>

				<!--=====================================
				https://www.iubenda.com/ CONDICIONES DE USO Y POLÍTICAS DE PRIVACIDAD
				======================================-->

				<div class="checkBox">
					
					<label>
						
						<input id="regPoliticas" type="checkbox">
					
							<small>
								
								Al registrarse, usted acepta nuestras condiciones de uso y políticas de privacidad

								<br>

								<a href="//www.iubenda.com/privacy-policy/8146355" class="iubenda-white iubenda-embed" title="condiciones de uso y políticas de privacidad">Leer más</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>

							</small>

					</label>

				</div>


				<?php

					$ingreso = new ControllerUser();
					$ingreso -> ctrUserRegister();

				?>

				
				<input type="submit" class="btn btn-default backColor btn-block" value="ENVIAR">	


			</form>
		  
        </div>

        <div class="modal-footer">
        	
          ¿Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>

        </div>
    
    </div>
  </div>
  



<!--====  End of Ventana Modal para el Ingreso  ====-->

<!--====================================================
=            Ventana Modal para el Ingreso            =
=====================================================-->

<div class="modal fade modalFormulario" id="modalIngreso" role="dialog">

    <div class="modal-dialog modal-content">
    

        <div class="modal-body modalTitulo">

			<h3 class="backColor">INGRESAR</h3>

        	<button type="button" class="close" data-dismiss="modal">&times;</button>

        	<!--====================================================
			=          Ingreso Facebook                          =
			=====================================================-->
			<div class="col-md-6 col-xs-12 facebook" >
				
				<p>
					<i class="fa fa-facebook"></i>
					Ingreso con FaceBook
				</p>	


			</div>

			<!--====================================================
			=      Ingreso   Google					       =
			=====================================================-->
			<a href="<?php echo $rutaGoogle; ?>">
				<div class="col-md-6 col-xs-12 google">
					
					<p>
						<i class="fa fa-google"></i>
						Ingreso con Google
					</p>	


				</div>
			</a>
			<!--====================================================
			=      Ingreso  local					       =
			=====================================================-->

			<form method="post" >
				
				<hr>

				
				
				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-envelope"></i>
						</span>

						<input type="email" class="form-control input-lg " id="ingEmail" name="ingEmail" placeholder="Correo Electronico" required>

					</div>
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-lock"></i>
						</span>

						<input type="password" class="form-control input-lg" id="ingPassword" name="ingPassword" placeholder="Contraseña" required>

					</div>
				</div>

				

				<?php

					$ingreso = new ControllerUser();
					$ingreso -> ctrUserLogin();

				?>

				
				<input type="submit" class="btn btn-default backColor btn-block btnIngreso" value="ENVIAR">

				<br>

				<center>
					
					<a href="#modalPassword" data-dismiss="modal" data-toggle="modal">¿Olvidaste tu contraseña?</a>


				</center>	


			</form>
		  
        </div>

        <div class="modal-footer">
        	
          ¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>

        </div>
    
    </div>
  </div>
  



<!--====  End of Ventana Modal para el Registro  ====-->

<!--====================================================
=       Ventana Modal para solicitar contraseña          =
=====================================================-->

<div class="modal fade modalFormulario" id="modalPassword" role="dialog">

    <div class="modal-dialog modal-content">
    

        <div class="modal-body modalTitulo">

			<h3 class="backColor">SOLICITAR NUEVA CONTRASEÑA</h3>

        	<button type="button" class="close" data-dismiss="modal">&times;</button>

        	<!--====================================================
			=          Olvido de contraseña                       =
			=====================================================-->
			

			<form method="post" >
				
				<label class="text-muted">Escribe el correo electrónico con el que estás registrado y allí te enviaremos una nueva contraseña</label>

				
				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-envelope"></i>
						</span>

						<input type="email" class="form-control input-lg" id="passEmail" name="passEmail" placeholder="Correo Electronico" required>

					</div>
				</div>
				
				

				<?php

					$password = new ControllerUser();
					$password -> ctrForgetPassword();

				?>

				
				<input type="submit" class="btn btn-default backColor btn-block" value="ENVIAR">

				

			</form>
		  
        </div>

        <div class="modal-footer">
        	
          ¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>

        </div>
    
    </div>
  </div>
  



<!--====  End of Ventana Modal para el Registro  ====-->
