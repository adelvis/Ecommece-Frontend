

<!--============================
=            Banner            =
=============================-->

<?php

	$server = Route::ctrRouteServer();

	$route ="sin-categoria";

	$banner = ControllerProduct::ctrViewBanner($route);



	if(is_array($banner)){

		$title1= json_decode($banner["title1"],true);
		$title2= json_decode($banner["title2"],true);
		$title3= json_decode($banner["title3"],true);

		echo '<figure class="banner">
	
					<img src="'.$server.$banner["img"].'" class="img-responsive" width="100%">


					<div class="textoBanner '. $banner["style"] .'">
						
						<h1 style="color:'.$title1["color"].'">'.$title1["texto"].'</h1>
						
						<h2 style="color:'.$title2["color"].'"><strong>'.$title2["texto"].'</strong></h2>

						<h3 style="color:'.$title3["color"].'">'.$title3["texto"].'</h3>


					</div>


			</figure>';


	}



?>




<!--====  End of Banner  ====-->

<?php
	
	
	$base=0;

	$top=4;

	$titleModule = array("ARTÍCULOS GRATUITOS", "LOS MÁS VENDIDOS", "LOS MÁS VISTO" );

	$routeModule = array("articulos-gratis", "lo-mas-vendido", "lo-mas-visto" );

	$mode= "DESC";

	if($titleModule[0]=="ARTÍCULOS GRATUITOS") {

		$sort="id"; 

		$item="price";

		$value=0;


		//$free = ControllerProduct::ctrViewProducts($sort, $item, $value,$base, $top, $mode);

		
	}

	if($titleModule[1]=="LOS MÁS VENDIDOS") {

		
		$sort="sales"; 

		$item="state";

		$value=1;

		$sales = ControllerProduct::ctrViewProducts($sort, $item, $value, $base, $top, $mode);

		var_dump($sales);

		
	}

	if($titleModule[2]=="LOS MÁS VISTO") {

		$sort="views"; 

		$item="state";

		$value=1;

		$views = ControllerProduct::ctrViewProducts($sort, $item, $value, $base, $top, $mode );

		
	}	

	if (is_array($free) && is_array($sales) && is_array($views)){

		$module = array($free, $sales, $views);


	}

		




	for ($i=0; $i < count($titleModule); $i++) { 

		# Botones Organizadores para Barra productos 

		echo '<div class="container-fluid well well-sm barraProductos">
	
				<div class="container">
					
					<div class="row">
						
						<div class="col-xs-12 organizarProductos">
							
							<div class="btn-group pull-right">
								
								<button type="button" class="btn btn-default btnGrid" id="btnGrid'.$i.'">

									<i class="fa fa-th" aria-hidden="true "></i>
									
									<span class="col-xs-0 pull-right"> GRID</span>


								</button>
								
								<button type="button" class="btn btn-default btnList" id="btnList'.$i.'">

									<i class="fa fa-list" aria-hidden="true "></i>
									
									<span class="col-xs-0 pull-right"> LIST</span>


								</button>

							</div>

						</div>
					</div>
				</div>

		</div>';



			echo '';

			// Barra productos 

			echo '<div class="container-fluid productos">

					<div class="container">
						
						<div class="row">

							<div class="col-xs-12 tituloDestacado">
								
								<div class="col-sm-6 col-xs-12">
					
									<h1><small>'.$titleModule[$i].'</small></h1>

								</div>

								<div class="col-sm-6 col-xs-12">
					
									<a href="'.$routeModule[$i]. '">


									<button class="btn btn-default backColor pull-right">
										
										VER MÁS <span class="fa fa-chevron-right"></span>

									</button>
								</div>

							</div>
			
							<div class="clearfix"></div>

							<hr>

						</div>';  

						/*--============================================
							=   Vitrina de Productos en cuadricula     =
						=============================================- */	

			echo 		'<ul class="grid'.$i.'" >';

											


						foreach ($module[$i] as $key => $value) {

							if($value["state"]!= 0){


								// productos
								echo 

								'<li class="col-md-3 col-sm-6 col-xs-12">
									<figure>
										<a href="'.$value["route"].'" class="pixelProducto">
											
											<img src="'.$server.$value["frontImg"].'" class="img-responsive">
										</a>
									</figure>
									
									<h4>
										
										<small>
											<a href="'.$value["route"].'" class="pixelProducto">

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


											echo '<a href="'.$value["route"].'" class="pixelProducto">
												
												<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">
												<i class="fa fa-eye" aria-hidden="true"></i></a>
											
										</div>
									</div>
								</li>';
							}
							# code...
						}


			echo '

							
						</ul>';	

			/*==========================================
			=    VITRINA DE PRODUCTO EN LISTA            =
			============================================*/		


			echo '

						<ul class="list'.$i.'" style="display: none;">';


					foreach ($module[$i] as $key => $value) {

						if($value["state"] !=0){

							echo	'<li class="col-xs-12">

									<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
										   
										<figure>
											<a href="'.$value["route"].'" class="pixelProducto">
												
												<img src="'.$server.$value["frontImg"].'" class="img-responsive">
											</a>
										</figure>

								  	</div>

								  	<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
										
										<h1>
											<small>

												<a href="'.$value["route"].'" class="pixelProducto">
										
													'.$value["title"].' <br>';  


													if ($value["new"] != 0){

														echo '<span  class="label label-warning">Nuevo</span> ';
													}

													if ($value["offer"] != 0){

														echo '<span  class="label label-warning">'.$value["discountOffer"].'% off</span>';
													}

													

											echo '</a>

											</small>

										</h1>

										<p class="text-muted">'.$value["headline"].'</p>';

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


									echo'<div class="btn-group pull-left enlaces">
									  	
									  		<button type="button" class="btn btn-default btn-xs deseos"  idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">

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

									  		echo '<a href="'.$value["route"].'" class="pixelProducto">

										  		<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">

										  		<i class="fa fa-eye" aria-hidden="true"></i>

										  		</button>

									  		</a>
										
										</div>

									</div>
								
									<div class="col-xs-12"><hr></div>


								</li>';
							}
						}		

						echo '</ul>


					</div>

				</div>';




	}

?>

