

<!--============================
=            Banner            =
=============================-->

<?php

	$server = Route::ctrRouteServer();

	$url = Route::ctrRoute();


	$route =$routes[0];
	

	$banner = ControllerProduct::ctrViewBanner($route);

	date_default_timezone_set("America/Caracas"); 
	$fecha = date('Y-m-d');
	$hora = date('H:i:s');

	$fechaActual = $fecha . ' '. $hora;





	if(is_array($banner)){


		if($banner["state"]!=0){

		
			echo '<figure class="banner">
		
						<img src="'.$server.$banner["img"].'" class="img-responsive" width="100%">';


			if($banner["route"] != "sin-categoria"){

				/*=============================================
				=           BANNER PARA CATEGORIA         =
				=============================================*/
				if($banner["type"] =="categoria"){

					$item= "route";

					$value= $banner["route"];

					$offer = ControllerProduct::ctrViewCategories($item, $value);

					if($offer["offer"]==1){

						echo '<div class="textoBanner textoIzq">

								<h1 style="color:#fff" class="text-uppercase">'.$offer["categories"].'</h!>

							</div>


							<div class="textoBanner textoDer">


								<h1 style="color:#fff" >OFERTAS ESPECIALES</h1>';


								if($offer["offerPrice"] !=0 ){

									echo '<h2 style="color:#fff"><strong>Todos los productos a $ '.$offer["offerPrice"].'</strong></h2>';
								}

								if($offer["discountOffer"] !=0 ){

									echo '<h2 style="color:#fff"><strong>Todos los productos con '.$offer["discountOffer"].'% OFF</strong></h2>';

								}

								echo '

								<h3  class="col-md-0 col-sm-0 col-xs-0" style="color:#fff">

									La oferta termina en <br>

									<div class="countdown2" finOferta="'.$offer["endOffer"].'"></div>


								</h3>';

								$datetime1 = new DateTime($offer["endOffer"]);
								$datetime2 = new DateTime($fechaActual);
								$interval = date_diff($datetime1, $datetime2);
								$finOferta = $interval->format('%a');


								if($finOferta==0){

									echo '<h3 class="col-lg-0" style ="color:#fff">La oferta termina hoy</h3>';

								}else if($finOferta==1){

									echo '<h3 class="col-lg-0" style ="color:#fff">La oferta termina en '.$finOferta.' día</h3>';

								}else {

									echo '<h3 class="col-lg-0" style ="color:#fff">La oferta termina en '.$finOferta.' días</h3>';
								}



							echo '</div>';


					}



				}
				/*=============================================
				=           BANNER PARA SUBCATEGORIA         =
				=============================================*/	

				if($banner["type"] =="subcategoria"){


					$item= "route";

					$value= $banner["route"];

					$offer = ControllerProduct::ctrViewSubcategory($item, $value);

					if($offer[0]["offer"]==1){

						echo'<div class="textoBanner textoIzq">

								<h1 style="color:#fff" class="text-uppercase">'.$offer[0]["subcategory"].'</h!>

							 </div>

							
							<div class="textoBanner textoDer">


								<h1 style="color:#fff" >OFERTAS ESPECIALES</h1>';


								if($offer[0]["offerPrice"] !=0 ){

									echo '<h2 style="color:#fff"><strong>Todos los productos a $ '.$offer[0]["offerPrice"].'</strong></h2>';
								}

								if($offer[0]["discountOffer"] !=0 ){

									echo '<h2 style="color:#fff"><strong>Todos los productos con '.$offer[0]["discountOffer"].'% OFF</strong></h2>';

								}	

								echo '

								<h3  class="col-md-0 col-sm-0 col-xs-0" style="color:#fff">

									La oferta termina en <br>

									<div class="countdown2" finOferta="'.$offer[0]["endOffer"].'"></div>


								</h3>';

								$datetime1 = new DateTime($offer[0]["endOffer"]);
								$datetime2 = new DateTime($fechaActual);
								$interval = date_diff($datetime1, $datetime2);
								$finOferta = $interval->format('%a');


								if($finOferta==0){

									echo '<h3 class="col-lg-0" style ="color:#fff">La oferta termina hoy</h3>';

								}else if($finOferta==1){

									echo '<h3 class="col-lg-0" style ="color:#fff">La oferta termina en '.$finOferta.' día</h3>';

								}else {

									echo '<h3 class="col-lg-0" style ="color:#fff">La oferta termina en '.$finOferta.' días</h3>';
								}



							echo '</div>';



								



					}

					
				}




			}
	

			echo '</figure>';
		}

	}



?>




<!--====  End of Banner  ====-->

<!-- Barra de producto -->

	<div class="container-fluid well well-sm barraProductos">
	
		<div class="container">
					
			<div class="row">
				
				<div class="col-sm-6 col-xs-12">

					<div class="btn-group">
						
						<button type="buttom" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Ordenar Producto<span class="caret" ></span></button>

						<ul class="dropdown-menu" role="menu">


							<?php

								echo '<li><a href="'.$url.$routes[0].'/1/recientes">Más reciente</a></li>

									  <li><a href="'.$url.$routes[0].'/1/antiguos">Más antiguo</a></li>';

							?>
							
							

						</ul>

					</div>

				</div>

				<div class="col-sm-6 col-xs-12 organizarProductos">
							
					<div class="btn-group pull-right">
								
						<button type="button" class="btn btn-default btnGrid" id="btnGrid0">

							<i class="fa fa-th" aria-hidden="true "></i>
									
							<span class="col-xs-0 pull-right"> GRID</span>
						
						</button>
								
						<button type="button" class="btn btn-default btnList" id="btnList0">

							<i class="fa fa-list" aria-hidden="true "></i>
									
							<span class="col-xs-0 pull-right"> LIST</span>
						</button>

					</div>

					</div>
				</div>
		</div>

	</div>

<!-- Barra de producto -->
	<div class="container-fluid productos">

		<div class="container">
						
			<div class="row">

				<ul class="breadcrumb fondoBreadcrumb text-uppercase">
					
					<li><a href="<?php echo $url;  ?>">INICIO</a></li>

					<li class="active pagActiva"><?php echo $routes[0]  ?></li>


				</ul>
		
<?php
		/*==============================================================
		=  Llamados de PAGINACION                  =
		===============================================================*/

		if (isset($routes[1])){

			

			if(isset($routes[2])){

				if($routes[2]== "antiguos"){

					$mode= "ASC";

					$_SESSION["sortType"] =$mode;


				}else{

					$mode = "DESC";

					$_SESSION["sortType"] =$mode;


				}


			}else{

				if(isset($_SESSION["sortType"])){

					$mode = $_SESSION["sortType"];

				}else{

					$mode = "DESC";

				}

				

				
			}


			$base=($routes[1]-1)*12;

			$top=12;


		}else{

			$routes[1]=1;

			$base=0;

			$top=12;

			$mode = "DESC";

			

		}



		/*==============================================================
		=  Llamados de categorias-Subcatedorias y Destacados         =
		===============================================================*/
		
				if($routes[0]=="articulos-gratis"){

						$sort="id"; 

						$item2="price";

						$value2=0;

				}elseif ($routes[0]=="lo-mas-vendido") {

						$sort="sales"; 

						$item2=null;

						$value2=null;

				}elseif ($routes[0]=="lo-mas-visto") {

						$sort="views"; 

						$item2=null;

						$value2=null;


				} else {


					$sort="id";

					$item1 = "route"; 

					$value1 =$routes[0];


					$category = ControllerProduct::ctrViewCategories($item1, $value1);


					if(!$category){

						$subCategory = ControllerProduct::ctrViewSubcategory($item1, $value1);

						if(is_array($subCategory)){

							$item2 = "id_subcategory"; 

							$value2 =$subCategory[0]["id"];

						}

					} else{

						if(is_array($category)) {

							$item2 = "id_category"; 

							$value2 =$category["id"];


						}

					}

				}


				


				$products = ControllerProduct::ctrViewProducts($sort,$item2, $value2, $base, $top,$mode);



				$listProduct = ControllerProduct::ctrListProducts($sort,$item2, $value2);

				

				if(!$products) {

					echo '<div class="col-xs-12 error404 text-center">

							<h1><small>¡Oops!</small></h1>

							<h2>No existe productos para la categoria o subcategoria seleccionada</h2>

						 </div>';

				} else  {

					echo '<ul class="grid0" >';  

						foreach ($products as $key => $value) {

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


					echo '

						<ul class="list0" style="display: none;">';
							

							foreach ($products as $key => $value) {

							if($value["state"] !=0){	

							
						echo	'<li class="col-xs-12">

									<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
										   
										<figure>
											<a href="'.$url.$value["route"].'" class="pixelProducto">
												
												<img src="'.$server.$value["frontImg"].'" class="img-responsive">
											</a>
										</figure>

								  	</div>

								  	<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
										
										<h1>
											<small>

												<a href="'.$url.$value["route"].'" class="pixelProducto">
										
													'.$value["title"].' <br>';  


													
													$date = date('Y-m-d');

													$currentDate = strtotime('-30 day', strtotime($date));

													$newDate= date('Y-m-d', $currentDate);



													if($newDate < $value["creationDate"] ){


														echo '<span  class="label label-warning">Nuevo</span> ';
													}

													if ($value["offer"] != 0 && $value["price"]!=0){

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

									  		echo '<a href="'.$url.$value["route"].'" class="pixelProducto">

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



					echo '
						</ul>';	


				

				}

?>

				<div class="clearfix"></div>

				<center>
				
				   <!--=====================================
				   =            PAGINACION           =
				   ======================================-->
				  			   		

					<?php

						if (count($listProduct)!=0){

							$pagProduct = ceil(count($listProduct)/12);

							if ($pagProduct >4){

								# ----botones de las primera pagina------
								
								if($routes[1]==1){

									echo '<ul class="pagination">';

									for ($i=1; $i <= 4; $i++) { 

										echo '<li id="item'.$i.'"><a href="'.$url.$routes[0].'/'.$i.'">'.$i.'</a></li>';
									}


									echo '<li class="disabled"><a>...</a></li>
											

										<li id="item'.$pagProduct.'"><a href="'.$url.$routes[0].'/'.$pagProduct.'">'.$pagProduct.'</a></li>
						  				<li><a href="'.$url.$routes[0].'/2'.'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>	



									</ul>';

								}
								
								

								# ----botones de mitad de pagina hacia abajo------

								elseif ($routes[1] != $pagProduct &&
										$routes[1] != 1 &&
										$routes[1] < ($pagProduct/2) &&
										$routes[1] < ($pagProduct-3)
								) {
									# code...

									$numPagActual = $routes[1];

									echo '<ul class="pagination">
										<li><a href="'.$url.$routes[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>';

									for ($i=$numPagActual; $i <= ($numPagActual+3); $i++) { 

										echo '<li id="item'.$i.'"><a href="'.$url.$routes[0].'/'.$i.'">'.$i.'</a></li>';
									}


									echo '<li class="disabled"><a>...</a></li>
											

										<li id="item'.$pagProduct.'"><a href="'.$url.$routes[0].'/'.$pagProduct.'">'.$pagProduct.'</a></li>
						  				<li><a href="'.$url.$routes[0].'/'.($numPagActual+1).'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>	



									</ul>';

								# ----botones de mitad de pagina hacia arriba------
								#--------------------------------------------------	

								}elseif ($routes[1] != $pagProduct &&
										$routes[1] != 1 &&
										$routes[1] >= ($pagProduct/2) &&
										$routes[1] < ($pagProduct-3)
								) {

									$numPagActual = $routes[1];

									echo '<ul class="pagination">
										<li><a href="'.$url.$routes[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
										<li id="item1"><a href="'.$url.$routes[0].'/1">1</a></li>
										<li class="disabled"><a>...</a></li>';

									for ($i=$numPagActual; $i <= ($numPagActual+3); $i++) { 

										echo '<li id="item'.$i.'"><a href="'.$url.$routes[0].'/'.$i.'">'.$i.'</a></li>';
									}

									echo '
											

										<li><a href="'.$url.$routes[0].'/'.($numPagActual+1).'"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
									</ul>';


								}	

								# ----botones de las ultimas 4 paginas y la primera pagina------

								else{
									# code...
									$numPagActual = $routes[1];

									echo '<ul class="pagination">

										<li><a href="'.$url.$routes[0].'/'.($numPagActual-1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
										<li id="item1"><a href="'.$url.$routes[0].'/1">1</a></li>
										<li class="disabled"><a>...</a></li>';

									for ($i=($pagProduct-3); $i <= $pagProduct; $i++) { 

										echo '<li id="item'.$i.'"><a href="'.$url.$routes[0].'/'.$i.'">'.$i.'</a></li>';
									}


									echo '</ul>';

								}



							}else{

								echo '<ul class="pagination">';

								for ($i=1; $i <= $pagProduct; $i++) { 

									echo '<li id="item'.$i.'"><a href="'.$url.$routes[0].'/'.$i.'">'.$i.'</a></li>';
								}


								echo '</ul>';


							}




						}




					?>
					
					

				</center>



			</div>

		</div>

	</div>