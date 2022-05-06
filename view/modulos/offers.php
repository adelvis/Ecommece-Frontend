
<?php

	$server = Route::ctrRouteServer();

	$url = Route::ctrRoute();

?>

<div class="container-fluid well well-sm">
	

	<div class="container">
		
		<div class="row" >

			<!--=============================================
			=            Breadcrumb de Curso            =
			============================================= -->

			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">INICIO</a></li>

				<li class="active pagActiva"><?php echo "ofertas"  ?></li>
				
			</ul>

			<!-- end Breadcrud Curso--->

		</div>

	</div>


</div>

<!--=============================================
	=          Jumbotron aviso  oferta         =
============================================= -->

<?php
	
	if(isset($routes[1])){

		if($routes[1]=="notice"){

			echo '<div class="container-fluid">
	
					<div class="container">
						
						<div class="jumbotron">

							<button type="button"  class="close cerrarOfertas" style="margin-top: -50px;"><h1>&times;</h1></button>
							 
							<h1 class="text-center">¡Hola!</h1>

							<p class="text-center">
									
								Tu artículo ha sido asignado a tus compras, pero antes queremos presentarte las siguientes ofertas, si no deseas ver las ofertas y continuar en el artículo que acabas de adquirir haz click en el siguiente botón:
							

								<br><br>

												
								<a href="'.$url.'profile">
									<button class="btn btn-default backColor btn-lg">
										VER ARTÍCULO COMPRADOS					
									</button>
								</a>
								<br><br>
								<a href="#moduloOfertas">
									<button class="btn btn-default  btn-lg">
										VER OFERTAS 					
									</button>
								</a>
							</p>

							

						</div>



					</div>


				</div>';


		}




	}


?>


<div class="container-fluid">
	
	<div class="container">
		
		<div class="row " id="moduloOfertas">

			<?php

				$item = null;
				$value = null;

				date_default_timezone_set("America/Caracas"); 
				$fecha = date('Y-m-d');
				$hora = date('H:i:s');

				$fechaActual = $fecha . ' '. $hora;


				/*=============================================
				=    Traemos las ofertas de las categorias        =
				=============================================*/

				$answer = ControllerProduct::ctrViewCategories($item, $value);

				foreach ($answer as $key => $value) {

					# code...

					

					if($value["state"]!=0){


						if($value["offer"]==1){

							if($value["endOffer"]> $fecha){

								$datetime1 = new DateTime($value["endOffer"]);
								$datetime2 = new DateTime($fechaActual);
								$interval = date_diff($datetime1, $datetime2);
								$finOferta = $interval->format('%a');

								echo '

								<div class="col-md-4 col-sm-6 col-xs-12">

									<div class="ofertas">

										<h3 class="text-center text-uppercase">
											¡OFERTA ESPECIAL EN <br> '.$value["categories"].'!

										</h3>

										<figure>

											<img class="img-responsive" src="'.$server.$value["offerImagen"].'" width="100%">

											
											<div class="sombraSuperior"></div>';

											if($value["discountOffer"] !=0){

												echo '<h1 class="text-center text-uppercase">%'.$value["discountOffer"].' OFF </h1>';

											}else{

												echo '<h1 class="text-center text-uppercase">$'.$value["offerPrice"].'</h1>';



											}

										

								echo	'</figure>';

								if($finOferta==0){

									echo '<h4 class="text-center">La oferta termina hoy</h4>';

								}else if($finOferta==1){

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' día</h4>';

								}else {

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' días</h4>';
								}



								echo '	
								
								<center>

									<div class="countdown" finOferta="'.$value["endOffer"].'"></div>

									<a href="'.$url.$value["route"].'" class="pixelOferta" titulo="'.$value["categories"].'">

										<button class="btn btn-lg backColor text-uppercase">Ir a la Oferta</button>

									</a>
									
								</center>




								</div>


								</div>'; 

							}		

						}

					}

				}

				
				/*=============================================
				=    Traemos las ofertas de las Sub-categorias        =
				=============================================*/

				$answerSubcategories = ControllerProduct::ctrViewSubcategory($item, $value);



				foreach ($answerSubcategories as $key => $value) {
					# code...

					if($value["state"] !=0){

						if($value["offer"]==1 && $value["offerByCategory"]==0 ){

							if($value["endOffer"]> $fecha){

								$datetime1 = new DateTime($value["endOffer"]);
								$datetime2 = new DateTime($fechaActual);
								$interval = date_diff($datetime1, $datetime2);
								$finOferta = $interval->format('%a');

								echo '

								<div class="col-md-4 col-sm-6 col-xs-12">

									<div class="ofertas">

										<h3 class="text-center text-uppercase">
											¡OFERTA ESPECIAL EN <br> '.$value["subcategory"].'!

										</h3>

										<figure>

											<img class="img-responsive" src="'.$server.$value["offerImagen"].'" width="100%">

											
											<div class="sombraSuperior"></div>';

											if($value["discountOffer"] !=0){

												echo '<h1 class="text-center text-uppercase">%'.$value["discountOffer"].' OFF </h1>';

											}else{

												echo '<h1 class="text-center text-uppercase">$'.$value["offerPrice"].'</h1>';



											}

										

								echo	'</figure>';

								if($finOferta==0){

									echo '<h4 class="text-center">La oferta termina hoy</h4>';

								}else if($finOferta==1){

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' día</h4>';

								}else {

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' días</h4>';
								}



								echo '	
								
								<center>

									<div class="countdown" finOferta="'.$value["endOffer"].'"></div>

									<a href="'.$url.$value["route"].'" class="pixelOferta">

										<button class="btn btn-lg backColor text-uppercase">Ir a la Oferta</button>

									</a>
									
								</center>




								</div>


								</div>'; 

							}		

						}

					}

				}


				/*=============================================
				=    Traemos las ofertas de Productos        =
				=============================================*/

				$sort = "id";

				$answerProduct = ControllerProduct::ctrListProducts($sort,$item, $value);

			

				foreach ($answerProduct as $key => $value) {
					# code...

					if($value["state"] !=0){

						if($value["offer"]==1 && $value["offeredByCategory"]==0 && $value["offeredBySubCategory"]==0 ){

							if($value["endOffer"]> $fecha){

								$datetime1 = new DateTime($value["endOffer"]);
								$datetime2 = new DateTime($fechaActual);
								$interval = date_diff($datetime1, $datetime2);
								$finOferta = $interval->format('%a');

								echo '

								<div class="col-md-4 col-sm-6 col-xs-12">

									<div class="ofertas">

										<h3 class="text-center text-uppercase">
											¡OFERTA ESPECIAL EN <br> '.$value["title"].'!

										</h3>

										<figure>

											<img class="img-responsive" src="'.$server.$value["imgOffer"].'" width="100%">

											
											<div class="sombraSuperior"></div>';

											if($value["discountOffer"] !=0){

												echo '<h1 class="text-center text-uppercase">%'.$value["discountOffer"].' OFF </h1>';

											}else{

												echo '<h1 class="text-center text-uppercase">$'.$value["offerPrice"].'</h1>';



											}

										

								echo	'</figure>';

								if($finOferta==0){

									echo '<h4 class="text-center">La oferta termina hoy</h4>';

								}else if($finOferta==1){

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' día</h4>';

								}else {

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' días</h4>';
								}



								echo '	
								
								<center>

									<div class="countdown" finOferta="'.$value["endOffer"].'"></div>

									<a href="'.$url.$value["route"].'" class="pixelOferta">

										<button class="btn btn-lg backColor text-uppercase">Ir a la Oferta</button>

									</a>
									
								</center>




								</div>


								</div>'; 

							}		

						}

					}

				}


			?>


		</div>

	</div>

</div>

