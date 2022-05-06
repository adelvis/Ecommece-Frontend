<?php


	/*=============================================
	=           Validar seccion           =
	=============================================*/
	
	
		
	$url = Route::ctrRoute();
	$server = Route::ctrRouteServer();



	if(!isset($_SESSION["validarSession"])){

		echo '<script>

				window.location ="'.$url.'";

			</script>
		';

		exit();

	}


	if(isset($_GET["merchantId"])){

                  echo '<script>

                  localStorage.removeItem("listaProductos");
                  localStorage.removeItem("cantidadCesta");
                  localStorage.removeItem("sumaCesta");
                  
                  </script>';




    }


?>


<div class="container-fluid well well-sm">

	<div class="container">

		<div class="row">
			
			
			<!--=============================================
			=            Breadcrumb de Perfil            =
			============================================= -->

			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">INICIO</a></li>

				<li class="active pagActiva"><?php echo "Perfil" ; ?></li>
				
			</ul>

			<!-- end Breadcrumb de Product--->


		</div>

	</div>

</div>

<!--=============================================
=           Seccion Perfil       =
============================================= -->


<div class="container-fluid">
	
	<div class="container">
		
	<ul class="nav nav-tabs">
	  <li class="active">
	  	
	  	<a data-toggle="tab" href="#compras"><i class="fa fa-list-ul"></i> MIS COMPRAS</a>

	  </li>

	  <li>
	  	
	  	<a data-toggle="tab" href="#deseos"><i class="fa fa-gift"></i> MI LISTA DE DESEOS</a>

	  </li>

	  <li>
	  	
	  	<a data-toggle="tab" href="#perfil"><i class="fa fa-user"></i> EDITAR PERFIL</a>

	  </li>

	  <li>
	  	<a href="<?php echo $url; ?>offers"><i class="fa fa-star"></i>	VER OFERTAS</a>
	

	  </li>

	</ul>

	<div class="tab-content">

		<!--=====================================
		=            TAB Compras            =
		======================================-->
	
		<div id="compras" class="tab-pane fade in active">
		
			<div class="panel-group">


				<?php

					$item= "id_user";
					$value= $_SESSION["id"];

					$compras = ControllerUser::ctlViewShopping($item, $value);


					if(!$compras){


						echo '
							<div class="col-xs-12 text-center error404">

								<h1><small>¡Oops! </small></h1>

								<h2>Aún no tienes compras realizadas en esta tienda</h2>

							</div>
						';

					}else{

						foreach ($compras as $key => $value1) {

							$sort= "id";
							$item= "id";
							$value= $value1["id_product"];

							$product = ControllerProduct::ctrListProducts($sort,$item, $value);

							foreach ($product as $key => $value2) {
								# code...
								echo '  
								<div class="panel panel-default">

								    <div class="panel-body">

										<div class="col-md-2 col-sm-6 col-xs-12">
											
											<figure>
												
												<img class="img-thumbnail" src="'.$server.$value2["frontImg"].'"></img>

											</figure>

										</div>

										<div class="col-md-6 col-xs-12">

											<h1><small>'.$value2["title"].'</small></h1>

											<p>'.$value2["headline"].'</p>';

											if($value2["type"]=="virtual"){

												echo '<a href="'.$url.'course/'.$value1["id"].'/'.$value1["id_user"].'/'.$value1["id_product"].'/'.$value2["route"].'">

														<button class="btn btn-default pull-left">Ir al curso</button>
													</a>

												';

											}else{

												echo '<h6>Proceso de Entrega: '.$value2["delivery"].' días habiles</h6>';

											

												if($value1["send"]==0){

													echo '<div class="progress">
														<div class="progress-bar progress-bar-info" role="progressbar" style="width:33.33%">
															<i class="fa fa-check"></i> Despachado
														</div>
														
														<div class="progress-bar progress-bar-default" role="progressbar" style="width:33.33%">
															<i class="fa fa-clock-o"></i> Enviando
														</div>

														<div class="progress-bar progress-bar-success" role="progressbar" style="width:33.33%">
															<i class="fa fa-clock-o"></i> Entregado
														</div>

														</div>';

												}


												if($value1["send"]==1){

													echo '<div class="progress">
														<div class="progress-bar progress-bar-info" role="progressbar" style="width:33.33%">
															<i class="fa fa-check"></i> Despachado
														</div>
														
														<div class="progress-bar progress-bar-default" role="progressbar" style="width:33.33%">
															<i class="fa fa-check"></i> Enviando
														</div>

														<div class="progress-bar progress-bar-success" role="progressbar" style="width:33.33%">
															<i class="fa fa-clock-o"></i> Entregado
														</div>

														</div>';

												}

												if($value1["send"]==2){

													echo '<div class="progress">
														<div class="progress-bar progress-bar-info" role="progressbar" style="width:33.33%">
															<i class="fa fa-check"></i> Despachado
														</div>
														
														<div class="progress-bar progress-bar-default" role="progressbar" style="width:33.33%">
															<i class="fa fa-check"></i> Enviando
														</div>

														<div class="progress-bar progress-bar-success" role="progressbar" style="width:33.33%">
															<i class="fa fa-check"></i> Entregado
														</div>

														</div>';

												}

											}

										echo '
										<h4 class="pull-right"><small>Comprado el '. substr($value1["creationDate"],0,-8).'</small></h4>

										</div>


										<div class="col-md-4 col-xs-12">';

										$datos  = array("idUsuario" => $_SESSION["id"],
														"idProduct" => $value2["id"]);

										$comentarios = ControllerUser::ctrViewCommentProfile($datos);

										

										echo'<div class="pull-right">
												<a class="calificarProducto" href="#modalComentarios" data-toggle="modal" idComentario="'.$comentarios["id"].'">
													
													<button class="btn btn-default backColor">Calificar Producto</button>

												</a>
											</div>

											<br><br>


											<div class="pull-right">

												<h3 class="text-center">';

												if($comentarios["qualification"]==0 && $comentarios["comment"]==""){

													echo '	
																<i class="fa fa-star-o text-success" aria-hidden="true"></i>
																<i class="fa fa-star-o text-success" aria-hidden="true"></i>
																<i class="fa fa-star-o text-success" aria-hidden="true"></i>
																<i class="fa fa-star-o text-success" aria-hidden="true"></i>
																<i class="fa fa-star-o text-success" aria-hidden="true"></i>';
												}else{

													switch ($comentarios["qualification"]) {
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







												}




											echo '	


												</h3>

												<p class="panel panel-default" style="padding:5px">

													<small>
														'.$comentarios["comment"].'
													</small>
												</p>

											</div>

										</div>

								    </div>
								 </div>

								  ';

							}

							


						}




					}



				?>
			

			</div>


		</div>

		<!--=====================================
		=            TAB Deseos            =
		======================================-->

		<div id="deseos" class="tab-pane fade">

			<?php

				$item=$_SESSION["id"];

				$desires = ControllerUser::ctrViewListDesire($item);

				if(!$desires){

					echo '
							<div class="col-xs-12 text-center error404">

								<h1><small>¡Oops! </small></h1>

								<h2>Aún no tienes productos en su lista de deseos</h2>

							</div>
						';



				}else{



					foreach ($desires as $key => $value1) {
						# code...
						$sort= "id";
						$item= "id";
						$value2= $value1["id_product"];

						$product = ControllerProduct::ctrListProducts($sort,$item, $value2);

						echo '<ul class="grid0" >';
	

						foreach ($product as $key => $value) {



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

											if ($value["new"] != 0){

												echo '<span  class="label label-warning fontSize">Nuevo</span> ';
											}

											if ($value["offer"] != 0){

												echo '<span  class="label label-warning fontSize">'.$value["discountOffer"].'% off</span>';
											}



										echo '</a>
									</small>

								</h4>	

								<div class="col-xs-6 precio">';

								if($value["price"]==0){

									echo '<h2 style="margin-top:-10px" ><small>GRATIS</small></h2>';

								} else {

									if ($value["offer"] != 0){

										echo'<h2 style="margin-top:-10px">

											<small>
											
												<strong class="oferta" style="font-size:12px">USD $'.$value["price"].'</strong>

											</small>

											<small>$'.$value["priceOffer"].'</small>

											</h2>
										';



									}else {

										echo '<h2 style="margin-top:-10px"><small>USD $'.$value["price"].'</small></h2>';


									}

								}

									

								echo '</div>

								<div class="col-xs-6 enlaces">

									<div class="btn-group pull-right">
										
										<button type="button" class="btn btn-danger btn-xs quitarDeseo" idDeseo="'.$value1["id"].'" data-toggle="tooltip" title="Quitar de mi lista de deseo">
											
											<i class="fa fa-heart" aria-hidden="true"></i>

										</button>';

										if($value["type"]=="virtual" && $value["price"] !=0){



											if ($value["offer"] != 0){

												$priceProduct= $value["priceOffer"];

											} else {

												$priceProduct= $value["price"];

											}	

										

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito" idProducto="'.$value["id"].'" imagen="'.$server.$value["frontImg"].'" titulo="'.$value["title"].'" precio="'.$priceProduct.'" tipo="'.$value["type"].' peso="'.$value["weight"].'" data-toggle="tooltip" title="Agregar al carrito de compra">
												
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


					echo '

								
							</ul>';


					}




				}


			?>


		</div>


		<!--=====================================
		=            TAB Perfil            =
		======================================-->

		<div id="perfil" class="tab-pane fade">
			
			<div class="row">
				
				<form method="post" enctype="multipart/form-data">
					
					<div class="col-md-3 col-sm-4 col-xs-12 text-center">
						
						<br>

						<figure id="imgPerfil">
							
							<?php


								echo '<input type="hidden" value="'.$_SESSION["id"].'" name="idUsuario" id="idUsuario">
									<input type="hidden" value="'.$_SESSION["password"].'" name="passUsuario">
									<input type="hidden" value="'.$_SESSION["photo"].'" name="fotoUsuario" id ="fotoUsuario">
									<input type="hidden" value="'.$_SESSION["modo"].'" name="modoUsuario" id="modoUsuario">';


								if($_SESSION["modo"]=="directo"){

																	

									if($_SESSION["photo"]!=""){

										echo '<img src="'.$url.$_SESSION["photo"].'" class="img-thumbnail"></img>';

									}else{

										

										echo '<img src="'.$server.'views/img/usuarios/default/anonymous.png" class="img-thumbnail"></img>';

									}	


								}else{

									echo '<img src="'.$_SESSION["photo"].'" class="img-thumbnail"></img>'; 

								}

							?>


						</figure>
						
						<?php

							if($_SESSION["modo"]=="directo"){

								echo '<button type="button" class="btn btn-default" id="btncambiarFoto">
										Cambiar foto del perfil
									</button>';


							}


						?>	

						<div id="subirImagen">
							
							<input type="file" class="form-control"  id="datosImagen" name="datosImagen">

							<img class="previsualizar">


						</div>		



					</div>


					<div class="col-md-9 col-sm-8 col-xs-12">

						<br>
						
						<?php

							if($_SESSION["modo"]!="directo"){


								echo '

									<label class="control-label text-muted text-uppercase">Nombre:</label>


									<div class="input-group">
						
										<span class="input-group-addon">
											
											<i class="glyphicon glyphicon-user"></i>
										</span>

										<input type="text" class="form-control"  value="'.$_SESSION["name"].'" readonly>

									</div>

									<br>


									<label class="control-label text-muted text-uppercase">Email:</label>


									<div class="input-group">
						
										<span class="input-group-addon">
											
											<i class="glyphicon glyphicon-envelope"></i>
										</span>

										<input type="text" class="form-control"  value="'.$_SESSION["email"].'" readonly>

									</div>

									<br>


									<label class="control-label text-muted text-uppercase">Modo de Registro en el sistema:</label>
									

									<div class="input-group">
						
										<span class="input-group-addon">
											
											<i class="fa fa-'.$_SESSION["modo"].'"></i>
										</span>

										<input type="text" class="form-control text-uppercase"  value="'.$_SESSION["modo"].'" readonly>

									</div>

									<br>




								';


							}else{



								echo '

									<label class="control-label text-muted text-uppercase" for="editarNombre">Nombre:</label>


									<div class="input-group">
						
										<span class="input-group-addon">
											
											<i class="glyphicon glyphicon-user"></i>
										</span>

										<input type="text" class="form-control" id="editarNombre" name="editarNombre" value="'.$_SESSION["name"].'">

									</div>

									<br>

									<label class="control-label text-muted text-uppercase" for="editarEmail">Email:</label>


									<div class="input-group">
						
										<span class="input-group-addon">
											
											<i class="glyphicon glyphicon-envelope"></i>
										</span>

										<input type="text" class="form-control" id="editarEmail" name="editarEmail" value="'.$_SESSION["email"].'">

									</div>


									<br>

									<label class="control-label text-muted text-uppercase" for="editarPassword">Contraseña:</label>


									<div class="input-group">
						
										<span class="input-group-addon">
											
											<i class="glyphicon glyphicon-lock"></i>
										</span>

										<input type="text" class="form-control" id="editarPassword" name="editarPassword" placeholder="Escriba la nueva contraseña">

									</div>

									<br>

									<button type="submit"  class="btn btn-default backColor btn-md pull-left">
										Actualizar Datos
									</button>



								';




							}


						?>		

					</div>

					<?php

						$actualizarPerfil = new ControllerUser(); 

						$actualizarPerfil->ctrUpdateProfile();

					?>

				</form>


				<button class="btn btn-danger btn-md pull-right" style="display: none;" id="eliminarUsuario">Eliminar Usuario</button>


				<?php

					$eliminarUsuario = new ControllerUser(); 

					$actualizarPerfil->ctrDeleteUser();

				?>


			</div>
		

		</div>		



	</div>




	</div>

</div>


<!--====================================================
=       Ventana Modal para comentario        =
=====================================================-->

<div class="modal fade modalFormulario" id="modalComentarios" role="dialog">
	
	 <div class="modal-dialog modal-content">

	 	<div class="modal-body modalTitulo">
		
			<h3 class="backColor">CALIFICA ESTE PRODUCTO</h3>

			<button type="button" class="close" data-dismiss="modal">&times;</button>

			<form method="post" onsubmit="return validarComentario()">

				<input type="hidden" value="" id="idComentario" name="idComentario">


				<h1 class="text-center" id="estrellas">

		       		<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>
					<i class="fa fa-star text-success" aria-hidden="true"></i>

				</h1>

				<div class="form-group text-center">

		       		<label class="radio-inline"><input type="radio" name="puntaje" value="0.5">0.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="1.0">1.0</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="1.5">1.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="2.0">2.0</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="2.5">2.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="3.0">3.0</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="3.5">3.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="4.0">4.0</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="4.5">4.5</label>
					<label class="radio-inline"><input type="radio" name="puntaje" value="5.0" checked>5.0</label>

				</div>

				<div class="form-group">
			  		
			  		<label for="comment" class="text-muted">Tu opinión acerca de este producto: <span><small>(máximo 300 caracteres)</small></span></label>
			  		
			  		<textarea class="form-control" rows="5" id="comentario" name="comentario" maxlength="300" required></textarea>

			  		<br>
					
					<input type="submit" class="btn btn-default backColor btn-block" value="ENVIAR">

				</div>
				
				<?php



						$actualizarComentario = new ControllerUser();

						$actualizarComentario -> ctrUpdateComment();


				?>




			</form>


	 	</div>	

	 	<div class="modal-footer">
      	
      	</div>


	 </div>

</div>	