

<?php

	$server = Route::ctrRouteServer();

	$url = Route::ctrRoute();

?>

<div class="container-fluid well well-sm">
	

	<div class="container">
		
		<div class="row" >

			<!--=============================================
			=            Breadcrumb de Product            =
			============================================= -->

			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">INICIO</a></li>

				<li class="active pagActiva"><?php echo $routes[0]  ?></li>
				
			</ul>

			<!-- end Breadcrumb de Product--->

		</div>

	</div>


</div>

<!--=============================================
=            Info-Product            =
=============================================*/ -->

<div class="container-fluid infoproducto">
	
	<div class="container">
		
		<div class="row">

			<?php

				$item = "route";

				$value = $routes[0]; 

				$infoProduct = ControllerProduct::ctrViewInfProduct($item, $value);

				if (is_array($infoProduct)) {

					$multimedia = json_decode($infoProduct["multimedia"],true);



				}

				
				
				
				if($infoProduct["type"]=="fisico"){

					/*=============================================
					=    Visor de Imagenes de Productos          =
					=============================================*/
					echo  
					'<div class="col-md-5 col-sm-6 col-xs-12 visorImg"> ';
				
						

						if($multimedia != null) {


							echo

							'<figure class="visor">';

							for ($i=0; $i <  count($multimedia); $i++) { 


								echo '<img id="lupa'.($i+1).'" class="img-thumbnail" src="'.$server.$multimedia[$i]["foto"].'" alt="'.$infoProduct["title"].'">';

								
							}


							echo '
								
							</figure>


							<div class="flexslider carousel">
							  <ul class="slides"> ';

							  for ($i=0; $i < count($multimedia) ; $i++) { 

							  	 echo '<li>
							      			<img value="'.($i+1).'" class="img-thumbnail" src="'.$server.$multimedia[$i]["foto"].'" alt="'.$infoProduct["title"].'">
							           </li>';

							  }

								  echo'
							   
							  </ul>
							</div>';


						}else{

							echo

							'<figure>';

							


							echo '<img id="lupa'.($i+1).'" class="img-thumbnail imgDefault" src="'.$server.'views/img/productos/default/foto-no-disponible.jpg" alt="'.$infoProduct["title"].'">';
						
								
							

							echo '
								
							</figure>';


						}



					
					echo '
					</div>';



				}else{

					/*=============================================
					=    Visor de Videos de Productos         =
					=============================================*/
					echo  
					'<div class="col-sm-6 col-xs-12">

					<iframe class="videoPresentacion" src="https://www.youtube.com/embed/'.$infoProduct["multimedia"].'?rel=0&autoplay=0" width="100%" frameborder="0" allowfullscreen></iframe>



					</div>	
					';

				}
				
			

			?>
			
		

			<!--=============================================
			=          PRODUCTO				          =
			=============================================*/ -->
			
			<?php

				if ($infoProduct["type"]=="fisico"){

					echo '<div class="col-md-7 col-sm-6 col-xs-12">';


				}else{


					echo '<div class="col-sm-6 col-xs-12">';



				}



			?>


				<div class="col-xs-6">

					<h6>
						
						<a href="javascript:history.back()" class="text-muted">

							<i class="fa fa-reply"> Continuar Comprando</i>


						</a>

					</h6>


				</div>

				<div class="col-xs-6">

						<!--=============================================
							=          Compartir en redes	          =
						=============================================*/ -->

					<h6>
						
						<a class="dropdown-toggle pull-right text-muted" data-toggle="dropdown" href="#">

							<i class="fa fa-plus"></i> Compartir

						</a>

						<ul class="dropdown-menu pull-right compartirRedes">

							<li>
								<p class="btnFacebook">
									<i class="fa fa-facebook"></i>
									Facebook
								</p>
							</li>
												
							<li>
								<p class="btnGoogle">
									<i class="fa fa-google"></i>
									Google
								</p>
							</li>



						</ul>

					</h6>
					
					
				</div>

				<div class="clearfix"></div>

				<!--=============================================
				=           Espacio para el producto	          =
				=============================================*/ -->
				
				<?php 

					echo '<div class="comprarAhora" style="display:none">

							<button class="btn btn-default backColor quitarItemCarrito" idProducto="'.$infoProduct["id"].'" peso="'.$infoProduct["weight"].'"><i class="fa fa-times"></i></button>

							<p class="tituloCarritoCompra text-left">'.$infoProduct["title"].'</p>';

							if($infoProduct["offer"]==0){

								echo '<input  class="cantidadItem" value="1" tipo="'.$infoProduct["type"].'" precio="'.$infoProduct["price"].'" idProducto="'.$infoProduct["id"].'">

									<p class="subTotal'.$infoProduct["id"].' subtotales"><strong>USD $<span>'.$infoProduct["price"].'</span></strong></p>

									<div class="sumaSubTotal"><span>'.$infoProduct["price"].'</span></div>';


							}else{

								echo '<input  class="cantidadItem" value="1" tipo="'.$infoProduct["type"].'" precio="'.$infoProduct["priceOffer"].'" idProducto="'.$infoProduct["id"].'">

									<p class="subTotal'.$infoProduct["id"].' subtotales"><strong>USD $<span>'.$infoProduct["priceOffer"].'</span></strong></p>
									<div class="sumaSubTotal"><span>'.$infoProduct["priceOffer"].'</span></div>';

							}



					echo '</div>';






					/*==============================
					=            titulo            =
					==============================*/
					

					if($infoProduct["offer"]==0) {

		
						$date = date('Y-m-d');

						$currentDate = strtotime('-30 day', strtotime($date));

						$newDate= date('Y-m-d', $currentDate);



						if($newDate > $infoProduct["creationDate"] ){


							echo '<h1 class="text-muted text-uppercase">'.$infoProduct["title"].'</h1>';

						}else{

							echo '<h1 class="text-muted text-uppercase">'.$infoProduct["title"].'

							<br>

							<small>
								
								<span class="label label-warning">Nuevo</span>

							</small


							</h1>';



						}	


					}else{

						
						$date = date('Y-m-d');

						$currentDate = strtotime('-30 day', strtotime($date));

						$newDate= date('Y-m-d', $currentDate);



						if($newDate > $infoProduct["creationDate"] ){

							echo '<h1 class="text-muted text-uppercase">' .$infoProduct["title"].'<br>';

							if($infoProduct["price"] !=0){

								echo '<small>
									
									<span class="label label-warning">'.$infoProduct["discountOffer"].'% off</span>

								</small>';


							}	



							echo '</h1>';

							

						}else{

							echo '<h1 class="text-muted text-uppercase">'.$infoProduct["title"].'<br>';


							if($infoProduct["price"] !=0){
								echo '<small>
										
										<span class="label label-warning">Nuevo</span>
										<span class="label label-warning">'.$infoProduct["discountOffer"].'% off</span> 


									</small>';
							}



							echo '</h1>';



						}


					}

					/*==============================
					=           precio           =
					==============================*/

					if($infoProduct["price"]==0){

						echo '<h2 class="text-muted">GRATIS</h2>';



					}else{

						if($infoProduct["offer"]==0) {

							echo '<h2 class="text-muted">USD $'.$infoProduct["price"].'</h2>';


						}else{

							echo '<h2 class="text-muted">
							
									<span>
										
										<strong class="oferta">USD $'.$infoProduct["price"].'</strong>

									</span>

									<span>
										
										$ '.$infoProduct["priceOffer"].'

									</span>


								</h2>';


						}

					}
					/*==============================
					=          descripcion         =
					==============================*/

					echo '<p>'.$infoProduct["description"].'</p>';


				 ?>
						
				<!--=============================================
				=          caracteristicas del producto          =
				=============================================*/ -->

				<hr>

				<div class="form-group row">
					
				<?php
					
					if($infoProduct["details"] !=null){

						$details = json_decode($infoProduct["details"],true);


						if($infoProduct["type"] == "fisico"){

							if($details["Talla"]!= null){

								echo '<div class="col-md-3 col-xs-12">

										<select class="form-control seleccionarDetalle" id="seleccionarTalla">
					
											<option value="">Talla</option>';

											for ($i=0; $i <= count($details["Talla"]) ; $i++) { 
												# code...
												echo '<option value="'.$details["Talla"][$i].'">'.$details["Talla"][$i].'</option>';

											}



								echo '	</select>
								</div>';

							}

							if($details["Color"]!= null){

								echo '<div class="col-md-3 col-xs-12">

										<select class="form-control seleccionarDetalle" id="seleccionarColor">
					
											<option value="">Color</option>';

											for ($i=0; $i <= count($details["Color"]) ; $i++) { 
												# code...
												echo '<option value="'.$details["Color"][$i].'">'.$details["Color"][$i].'</option>';

											}



								echo '	</select>
								</div>';

							}

							if($details["Marca"]!= null){

								echo '<div class="col-md-3 col-xs-12">

										<select class="form-control seleccionarDetalle" id="seleccionarMarca">
					
											<option value="">Marca</option>';

											for ($i=0; $i <= count($details["Marca"]) ; $i++) { 
												# code...
												echo '<option value="'.$details["Marca"][$i].'">'.$details["Marca"][$i].'</option>';

											}



								echo '	</select>
								</div>';

							}

						}else{

							echo '<div class="col-xs-12">

								<li>
									<i style="margin-right:10px" class="fa fa-play-circle"></i>'.$details["Clases"].'
								</li>
								<li>
									<i style="margin-right:10px" class="fa fa-clock-o"></i>'.$details["Tiempo"].'
								</li>
								<li>
									<i style="margin-right:10px" class="fa fa-check-circle"></i>'.$details["Nivel"].'
								</li>
								<li>
									<i style="margin-right:10px" class="fa fa-info-circle"></i>'.$details["Acceso"].'
								</li>
								<li>
									<i style="margin-right:10px" class="fa fa-desktop"></i>'.$details["Dispositivo"].'
								</li>
								<li>
									<i style="margin-right:10px" class="fa fa-trophy"></i>'.$details["Certificado"].'
								</li>

							</div>';




						}


					}

				/*===============================
				=            Entrega            =
				===============================*/
				
				if($infoProduct["delivery"] ==0){

					if($infoProduct["price"]==0){

						echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

						<hr>

						<span class="label label-default" style="font-weight:100">
							<i class="fa fa-clock-o" style="margin-right:5px"></i>
							Entrega Inmediata |  <i class="fa fa-shopping-cart" style="margin: 0px 5px"></i>'.$infoProduct["salesFree"].' inscritos |  
							<i class="fa fa-eye" style="margin: 0px 5px"></i> Visto por <span class="vistas" tipo="'.$infoProduct["price"].'">'.$infoProduct["ViewsFree"].'</span> personas

						</span>

						</h4>

						<h4 class="col-lg-0 col-md-0 col-xs-12">


						<hr>

						<small>
							<i class="fa fa-clock-o" style="margin-right:5px"></i>
							Entrega Inmediata <br>
							<i class="fa fa-shopping-cart" style="margin: 0px 5px"></i>'.$infoProduct["salesFree"].' inscritos <br> 
							<i class="fa fa-eye" style="margin: 0px 5px"></i> Visto por <span class="vistas" tipo="'.$infoProduct["price"].'">'.$infoProduct["ViewsFree"].'</span> personas

						</small>

						</h4>';



					}else {

						echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

						<hr>

						<span class="label label-default" style="font-weight:100">
							<i class="fa fa-clock-o" style="margin-right:5px"></i>
							Entrega Inmediata |  <i class="fa fa-shopping-cart" style="margin: 0px 5px"></i>'.$infoProduct["sales"].' ventas |  
							<i class="fa fa-eye" style="margin: 0px 5px"></i> Visto por <span class="vistas" tipo="'.$infoProduct["price"].'">'.$infoProduct["views"].'</span> personas

						</span>

						</h4>

						<h4 class="col-lg-0 col-md-0 col-xs-12">

						<hr>

						<small>
							<i class="fa fa-clock-o" style="margin-right:5px"></i>  Entrega Inmediata<br>  
							<i class="fa fa-shopping-cart" style="margin: 0px 5px"></i>'.$infoProduct["sales"].' ventas <br>  
							<i class="fa fa-eye" style="margin: 0px 5px"></i> Visto por <span class="vistas" tipo="'.$infoProduct["price"].'">'.$infoProduct["views"].'</span> personas

						</small>

						</h4>';




					}

					

				}else{

					if($infoProduct["price"]==0){

						echo '<h4 class="col-md-12 col-sm-0 col-xs-0">


							<hr>

							<span class="label label-default" style="font-weight:100">
								<i class="fa fa-clock-o" style="margin-right:5px"></i>
								'.$infoProduct["delivery"].' días hábiles para la entrega |  <i class="fa fa-shopping-cart" style="margin: 0px 5px"></i>'.$infoProduct["salesFree"].' Solicitudes |  
								<i class="fa fa-eye" style="margin: 0px 5px"></i> Visto por <span class="vistas" tipo="'.$infoProduct["price"].'">'.$infoProduct["ViewsFree"].'</span> personas

							</span>

						</h4>



						<h4 class="col-lg-0 col-md-0 col-xs-12">
							

							<hr>

							<small>
								<i class="fa fa-clock-o" style="margin-right:5px"></i>
								'.$infoProduct["delivery"].' días hábiles para la entrega <br>  <i class="fa fa-shopping-cart" style="margin: 0px 5px"></i>'.$infoProduct["salesFree"].' Solicitudes <br>  
								<i class="fa fa-eye" style="margin: 0px 5px"></i> Visto por <span class="vistas" tipo="'.$infoProduct["price"].'">'.$infoProduct["ViewsFree"].'</span> personas

							</small>

						</h4>';

					}else{

						echo '<h4 class="col-md-12 col-sm-0 col-xs-0">


							<hr>

							<span class="label label-default" style="font-weight:100">
								<i class="fa fa-clock-o" style="margin-right:5px"></i>
								'.$infoProduct["delivery"].' días hábiles para la entrega |  <i class="fa fa-shopping-cart" style="margin: 0px 5px"></i>'.$infoProduct["sales"].' ventas |  
								<i class="fa fa-eye" style="margin: 0px 5px"></i> Visto por <span class="vistas" tipo="'.$infoProduct["price"].'">'.$infoProduct["views"].'</span> personas

							</span>

						</h4>';

						echo '<h4 class="col-lg-0 col-md-0 col-xs-12">
							
							<hr>

							<small>
								<i class="fa fa-clock-o" style="margin-right:5px"></i>
								'.$infoProduct["delivery"].' días hábiles para la entrega <br> 

								<i class="fa fa-shopping-cart" style="margin: 0px 5px"></i>'.$infoProduct["sales"].' ventas <br>  
								<i class="fa fa-eye" style="margin: 0px 5px"></i> Visto por <span class="vistas" tipo="'.$infoProduct["price"].'">'.$infoProduct["views"].'</span> personas

							</small>

						</h4>';


					}	


				}
				
				


				?>

				</div>
				
				<!--=============================================
				=           Botones de compras			          =
				=============================================*/ -->

				<div class="row botonesCompra">


					<?php

						if($infoProduct["price"]==0){

							echo '<div class="col-md-6 col-xs-12">';

							if(isset($_SESSION["validarSession"])&& $_SESSION["validarSession"]=="ok" ){

								if ($infoProduct["type"]=="virtual"){

												
									echo '<button class="btn btn-default btn-block btn-lg backColor agregarGratis" idProducto="'.$infoProduct["id"].'" idUsuario="'.$_SESSION['id'].'"  tipo="'.$infoProduct["type"].'" titulo="'.$infoProduct["title"].'">ACCEDER AHORA</button>';
								}else{


									echo '<button class="btn btn-default btn-block btn-lg backColor agregarGratis" idProducto="'.$infoProduct["id"].'" idUsuario="'.$_SESSION["id"].'" tipo="'.$infoProduct["type"].'" titulo="'.$infoProduct["title"].'">SOLICITAR AHORA</button>

										<br>

										<div class="col-xs-12 panel panel-info text-left">

										<strong>¡Atención!</strong>

											El producto a solicitar es totalmente gratuito y se enviará a la dirección solicitada, sólo se cobrará los cargos de envío.

										</div>

										<div class="col-xs-12  text-left" >

										
											   	<textarea class="direccion" name ="direccion" placeholder="Ingrese la dirección de envío"  rows="5" cols="50" style="display:none"></textarea>
									
											

										</div>
									';


								}
							}else{

								echo '
										<a href="#modalIngreso" data-toggle="modal">
											<button class="btn btn-default btn-block btn-lg backColor">SOLICITAR AHORA</button></a>';



							}
									echo '</div>';
									


						}else{

							if ($infoProduct["offer"] != 0){

								$priceProduct= $infoProduct["priceOffer"];

							} else {

								$priceProduct= $infoProduct["price"];

							}	


							if ($infoProduct["type"]=="virtual"){

								if(isset($_SESSION["validarSession"])){

									if($_SESSION["validarSession"]=="ok"){

										echo '<div class="col-md-6 col-xs-12">
												<a id="btnCheckout" href="#modalComprarAhora" data-toggle="modal" idUsuario="'.$_SESSION['id'].'">
												<button class="btn btn-default btn-block btn-lg"><small>COMPRAR AHORA</small></button></a></div>';

									}

								}else{

										echo '<div class="col-md-6 col-xs-12">
											<a href="#modalIngreso" data-toggle="modal"><button class="btn btn-default btn-block btn-lg"><small>COMPRAR AHORA</small></button></a></div>';
		
								}		


								


								echo '
								
								<div class="col-md-6 col-xs-12">
									
									<button class="btn btn-default btn-block btn-lg backColor 
									agregarCarrito" idProducto="'.$infoProduct["id"].'" imagen="'.$server.$infoProduct["frontImg"].'" titulo="'.$infoProduct["title"].'" precio="'.$priceProduct.'" tipo="'.$infoProduct["type"].'" peso="'.$infoProduct["weight"].'">

									<small>AGREGAR AL CARRITO</small>
									<i class="fa fa-shopping-cart col-md-0"></i>
									</button>

									
								</div>';


							}else{

								
								echo '
								
								<div class="col-lg-6 col-md-8 col-xs-12">
									
									<button class="btn btn-default btn-block btn-lg backColor agregarCarrito" idProducto="'.$infoProduct["id"].'" imagen="'.$server.$infoProduct["frontImg"].'" titulo="'.$infoProduct["title"].'" precio="'.$priceProduct.'" tipo="'.$infoProduct["type"].'" peso="'.$infoProduct["weight"].'">
									AGREGAR AL CARRITO
									<i class="fa fa-shopping-cart"></i>
									</button>

									
								</div>';




							}

							


						}	



					?>

					
					


				</div>
				

				<!--=============================================
				=           Lupa					          =
				=============================================*/ -->

				<figure class="lupa">
					
					<img src="">


				</figure>


			</div>
			
			

		</div>


		<!--=============================================
		=          Comentarios					          =
		=============================================*/ -->

		<br>

		<div class="row">

			<?php

				$datos = array("idUsuario" =>"" ,

								"idProduct" => $infoProduct["id"]  );

				$comments = ControllerUser::ctrViewCommentProfile($datos);

				$cantidad= 0;


				foreach ($comments as $key => $value) {
					# code...
					if($value["comment"] !=""){

						//$cantidad += count($value["id"]);
						$cantidad += 1;

					}

				}


			?>

			<ul class="nav nav-tabs">

			  <?php

			  		$cantidadQualification=0;

			  		if($cantidad == 0){

			  			echo '<li class="active"><a>ESTE PRODUCTO NO TIENE COMENTARIOS</a></li>
			  				<li></li>';


			  		}else{

			  			echo '<li class="active"><a>COMENTARIOS '.$cantidad.'</a></li>
			  				  <li><a id="verMas" href="">Ver más</a></li>';

			  			$sumQualification= 0;

			  			foreach ($comments as $key => $value) {
			  				# code...
			  				if($value["qualification"] !=0){

			  					//$cantidadQualification +=count($value["id"]);
			  					$cantidadQualification +=1;
			  					$sumQualification += $value["qualification"];

			  				}


			  			}
			  			
			  		
			  			$media  = round($sumQualification/$cantidadQualification, 1);

			  			echo '<li class="pull-right"><a class="text-muted">PROMEDIO DE CALIFICACIÓN: '.$media.' |';

			  			if($media >=0 && $media <=0.5){

			  				echo '
								  	<i class="fa fa-star-half-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>';



			  			}


			  			else if($media >=0.5 && $media <=1.0){

			  				echo '
								  	<i class="fa fa-star text-success"></i>
									<i class="fa fa-star-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>';

			  			}

			  			else if($media >=1.0 && $media <=1.5){

			  				echo '
								  	<i class="fa fa-star text-success"></i>
									<i class="fa fa-star-half-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>';

			  			}

			  			else if($media >=1.5 && $media <=2.0){

			  				echo '
								  	<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>';

			  			}

			  			else if($media >=2.0 && $media <=2.5){

			  				echo '
								  	<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star-half-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>';

			  			}

			  			else if($media >=2.5 && $media <=3.0){

			  				echo '
								  	<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>';

			  			}

			  			else if($media >=3.0 && $media <=3.5){

			  				echo '
								  	<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star-half-o text-success"></i>
									<i class="fa fa-star-o text-success"></i>';

			  			}

			  			else if($media >=3.5 && $media <=4.0){

			  				echo '
								  	<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star-o text-success"></i>';

			  			}

			  			else if($media >=4.0 && $media <=4.5){

			  				echo '
								  	<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star-half-o text-success"></i>';

			  			}

			  			else if($media >=4.5 && $media <=5.0){

			  				echo '
								  	<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>
									<i class="fa fa-star text-success"></i>';

			  			}



			  		}




			  ?>


			  

			  

			 

			  

			  </a></li>

			</ul>
				
			<br>
		</div>


		<div class="row comentarios">


			<?php

			foreach ($comments as $key => $value) {
				# code...
				if($value["comment"] !=""){

					$item = "id";

					$value1=$value["id_user"];
					
					$user = ControllerUser::ctrViewUser($item, $value1);

					echo '
						<div class="panel-group col-md-3 col-sm-6 col-xs-12 alturaComentarios">
			
							<div class="panel panel-default">

						      <div class="panel-heading text-uppercase">
								
									'.$user["name"].'

									<span class="text-right"> ';

									if($user["modo"]=="directo"){

										if($user["photo"]==""){

											echo '<img class="img-circle pull-right" src="'.$server.'views/img/usuarios/default/anonymous.png" width="20%">';
										
										}else{

											echo '<img class="img-circle pull-right" src="'.$url.$user["photo"].'" width="20%">';


										}

									}else{


										echo '<img class="img-circle pull-right" src="'.$user["photo"].'" width="20%">';

									}

										
									

								echo '</span>
				
						      </div>
						      
						      <div class="panel-body">
							      	<small>'.$value["comment"].'
							      	</small>
						      </div>

						      <div class="panel-footer"> ';

						      switch ($value["qualification"]) {
								case 0.5:
									# code...
									echo '
									
										<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>';
									break;

								case 1.0:
									# code...
									echo '
									
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>';
									break;

								case 1.5:
									# code...
									echo '
									
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>';
									break;	

								case 2.0:
									# code...
									echo '
									
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>';
									break;	


								case 2.5:
									# code...
									echo '
									
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>';
									break;		

								case 3.0:
									# code...
									echo '
									
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>';
									break;


								case 3.5:
									# code...
									echo '
									
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>';
									break;

								case 4.0:
									# code...
									echo '
									
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star-o text-success" aria-hidden="true"></i>';
									break;

								case 4.5:
									# code...
									echo '
									
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>';
									break;
								
								case 5.0:
									# code...
									echo '
									
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>
										<i class="fa fa-star text-success" aria-hidden="true"></i>';
									break;

							}







						      echo '


						      	
						      </div>


						    </div>



						</div>



					';

				}

			}


			?>

			
			

			


		</div>

		<hr>

	</div>
</div>

<!--=============================================
=         Articulos relacionados			          =
=============================================*/ -->



<div class="container-fluid productos">

	<div class="container">
			
		<div class="row">

			<div class="col-xs-12 tituloDestacado">

				

				
				<div class="col-sm-6 col-xs-12">
	
					<h1><small>PRODUCTOS RELACIONADOS</small></h1>

				</div>

				<div class="col-sm-6 col-xs-12">

					<?php

						$item ="id";

						$value = $infoProduct["id_subcategory"];

						$rutaArticuloDestacado= ControllerProduct::ctrViewSubcategory($item, $value);

					

						echo '<a href="'.$url.$rutaArticuloDestacado[0]["route"].'">';


					?>
	
					


					<button class="btn btn-default backColor pull-right">
						
						VER MÁS <span class="fa fa-chevron-right"></span>

					</button>
				</div>

			</div>

			<div class="clearfix"></div>

			<hr>

		</div> 


<?php			

	$sort = "";
	$item = "id_subcategory";
	$value = $infoProduct["id_subcategory"];
	$base =0;
	$top =4;
	$mode ="Rand()";

	$relacionados = ControllerProduct::ctrViewProducts($sort,$item, $value, $base, $top,$mode);

	

	if(!$relacionados){

		echo '<div class="col-xs-12 error404">

				<h1>
					<small>¡Oops!</small>
				</h1>

				<h2>No hay articulos relacionados</h2>

			</div>';

	}else {



		echo '<ul class="grid0" >';
	

		foreach ($relacionados as $key => $value) {

			if($value["state"] !=0){

			// productos
			echo 

			'<li class="col-md-3 col-sm-6 col-xs-12">
				<figure>
					<a href="'.$url.$value["route"].'" class="pixelProducto">
						
						<img src="'.$server.$value["frontImg"].'" class="img-responsive">
					</a>
				</figure>
				
				<h4>
					
					<small>
						<a href="'.$url.$value["route"].'" class="pixelProducto">

							'.$value["title"].' <br>

							<span style="color:rgba(0,0,0,0)">-</span>';

							$date = date('Y-m-d');

							$currentDate = strtotime('-30 day', strtotime($date));

							$newDate= date('Y-m-d', $currentDate);



							if($newDate < $value["creationDate"] ){

							
								echo '<span  class="label label-warning fontSize">Nuevo</span> ';
							}

							if ($value["offer"] != 0 && $value["price"]!=0){

								echo '<span  class="label label-warning fontSize">'.$value["discountOffer"].'% off</span>';
							}



						echo '</a>
					</small>

				</h4>	

				<div class="col-xs-6 precio">';

				if($value["price"]==0){

					echo '<h2><small>GRATIS</small></h2>';

				} else {

					if ($value["offer"] != 0){

						echo'<h2>

							<small>
							
								<strong class="oferta">USD $'.$value["price"].'</strong>

							</small>

							<small>$'.$value["priceOffer"].'</small>

							</h2>
						';



					}else {

						echo '<h2><small>USD $'.$value["price"].'</small></h2>';


					}

				}

					

				echo '</div>

				<div class="col-xs-6 enlaces">

					<div class="btn-group pull-right">
						
						<button type="button" class="btn btn-default btn-xs deseos" idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseo">
							
							<i class="fa fa-heart" aria-hidden="true"></i>

						</button>';

						if($value["type"]=="virtual" && $value["price"] !=0){



							if ($value["offer"] != 0){

								$priceProduct= $value["priceOffer"];

							} else {

								$priceProduct= $value["price"];

							}	

						

							echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" imagen="'.$server.$value["frontImg"].'" titulo="'.$value["title"].'" precio="'.$priceProduct.'" tipo="'.$value["type"].'" peso="'.$value["weight"].'" data-toggle="tooltip" title="Agregar al carrito de compra">
								
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>

							</button>';


						}


						echo '<a href="'.$url.$value["route"].'" class="pixelProducto">
							
							<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">
							<i class="fa fa-eye" aria-hidden="true"></i></a>
						
					</div>
				</div>
			</li>';

			# code...
		}
		}

echo '

				
			</ul>';

	}

	


?>

</div>		
			
</div >


<!--=============================================
	=    VENTANA MODAL PARA CHECKOUT        =
============================================== -->

<div id="modalComprarAhora" class="modal fade modalFormulario" role="dialog">
	
	<div class="modal-content modal-dialog">
		
		<div class="modal-body modalTitulo">
			
			<h3 class="backColor">REALIZAR PAGO</h3>

			<button type="button" class="close" data-dismiss="modal">&times;</button>

			<div class="contenidoCheckout">

				<?php

					$answer = ControllerCart::ctrViewTarifa();

					echo '<input type="hidden" id="tasaImpuesto" name="tasaImpuesto" value="'.$answer["tax"].'">

						<input type="hidden" id="envioNacional" name="envioNacional" value="'.$answer["national_delivery"].'">

						<input type="hidden" id="envioInternacional" name="envioInternacional" value="'.$answer["international_delivery"].'">

						<input type="hidden" id="tasaMinimaNal" name="tasaMinimaNal" value="'.$answer["tax_min_nat"].'">

						<input type="hidden" id="tasaMinimaInt" name="tasaMinimaInt" value="'.$answer["tax_min_int"].'">

						<input type="hidden" id="tasaPais" name="tasaPais" value="'.$answer["country"].'">


					';

				?>


				<div class="formEnvio row">
					
					<h4 class="text-center well text-muted text-uppercase">Información de envío</h4>

					<div class="col-xs-12 seleccionePais">
						
						

					</div>
				</div>
				
				<br>

				<div class="formaPago row">

					<input type="hidden" id="idUsuario" value="<?php echo $_SESSION['id']; ?>">
					
					<h4 class="text-center well text-muted text-uppercase">Elegir forma de Pago</h4>

					<figure class="col-md-6">
						<center>
							
							<input type="radio" name="pago" id="checkPaypal" value="paypal" checked>	

						</center>


						<img src="<?php $url;?>view/img/plantilla/paypal.jpg" class="img-thumbnail">						


					</figure>

					<figure class="col-md-6">
						<center>
							
							<input type="radio" name="pago" id="checkPayu" value="payu">	
						</center>

						<img src="<?php $url;?>view/img/plantilla/payu.jpg" class="img-thumbnail">	

					</figure>



				</div>

				<br>

				<div class="listaProductos row">
				
					<h4 class="text-center well text-muted text-uppercase">Productos a comprar</h4>

					<table class="table table-striped tablaProductos">
						
						<thead>
							<tr>
								
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>

							</tr>
						</thead>

						<tbody>
							

						</tbody>



					</table>	
					
					<div class="col-sm-6 col-xs-12 pull-right">
						
						<table class="table table-striped tablaTasas">

							<tbody>
								
								<tr>
									<td>Subtotal</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorSubtotal" valor="0">0</span></td>
								</tr>

								<tr>
									<td>Envío</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorTotalEnvio" valor="0">0</span></td>
								</tr>

								<tr>
									<td>Impuesto</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorTotalImpuesto" valor="0">0</span></td>
								</tr>


								<tr>
									<td><strong>Total</strong></td>
									<td><strong><span class="cambioDivisa">USD</span> $<span class="valorTotalCompra" valor="0">0</span></strong></td>
								</tr>

							</tbody>


						</table>

						<div class="divisa">
							
							<select class="form-control" id="cambiarDivisa" name="divisa">
								
								

							</select>	

							<br>

						</div>

					</div>
					
					<div class="clearfix"></div>

					<form  class="formPayu" style="display: none;">

						  <input name="merchantId"    type="hidden"  value=""   >
						  <input name="accountId"     type="hidden"  value="" >
						  <input name="description"   type="hidden"  value=""  >
						  <input name="referenceCode" type="hidden"  value="" >
						  <input name="amount"        type="hidden"  value=""   >
						  <input name="tax"           type="hidden"  value=""  >
						  <input name="taxReturnBase" type="hidden"  value="" >
						  <input name="shipmentValye" type="hidden"  value="" >
						  <input name="currency"      type="hidden"  value="" >
						  <input name="lng"    		  type="hidden"  value="es" >
						  <input name="confirmationUrl"    type="hidden"  value="" >
						  <input name="responseUrl"   type="hidden"  value="" >
						  <input name="declinedResponseUrl"     type="hidden"  value=""  >
						  <input name="displayShippingInformation"    type="hidden"  value="" >
						  <input name="signature"     type="hidden"  value=""  >
						  <input name="test"          type="hidden"  value="" >
						 
						  
						  
						  <input name="Submit"  class="btn btn-block btn-lg btn-default backColor"      type="submit"  value="PAGAR" >
					</form>

					
					<button class="btn btn-block btn-lg btn-default backColor btnPagar">PAGAR</button>

				</div>




			</div>

			<div class="modal-footer"></div>

		</div>

	</div>

</div>


<?php

if($infoProduct["type"] == "fisico"){

	echo '<script type="application/ld+json">

			{
			  "@context": "http://schema.org/",
			  "@type": "Product",
			  "name": "'.$infoProduct["title"].'",
			  "image": [';

			  for($i = 0; $i < count($multimedia); $i ++){

			  	echo $server.$multimedia[$i]["foto"].',';

			  }
			
			  echo '],
			  "description": "'.$infoProduct["description"].'"
	  
			}

		</script>';

}else{

	echo '<script type="application/ld+json">

			{
			  "@context": "http://schema.org",
			  "@type": "Course",
			  "name": "'.$infoProduct["title"].'",
			  "description": "'.$infoProduct["description"].'",
			  "provider": {
			    "@type": "Organization",
			    "name": "Tu Logo",
			    "sameAs": "'.$url.$infoProduct["route"].'"
			  }
			}

		</script>';

}

?>
