
<!-- ========================================
	FOOTER
===========================================-->
<?php

	$server = Route::ctrRouteServer();

	$url = Route::ctrRoute();

?>

<footer class="container-fluid">
	
	<div class="container">
		
		<div class="row">
				
			<!-- ========================================
				CATEGORIA Y SUB CATEGORIA FOOTER
			===========================================-->
			<div class="col-lg-5 col-md-6 col-xs-12 footerCategorias">

				<?php

					$item  = null;

					$value = null;


					$categories = ControllerProduct::ctrViewCategories($item, $value);

					if (is_array($categories)) {
						# code...
						foreach ($categories as $key => $value) {

							if($value["state"] !=0){

							echo '

									<div class="col-lg-4 col-md-3 col-sm-4 col-xs-12">
						
										<h4><a href="'.$url.$value["route"].'" class="pixelCategorias" titulo="'.$value["categories"].'">'.$value["categories"].'</a></h4>

										<br>

										<ul>';


										$item = "id_categories"; 

										$v = $value["id"]; 

										$subcategory = ControllerProduct::ctrViewSubcategory($item, $v);


										foreach ($subcategory as $key => $value) {

											if($value["state"] !=0){

												echo '<li><a href="'.$url.$value["route"].'" class="pixelSubCategorias" titulo="'.$value["subcategory"].'">'.$value["subcategory"].'</a></li>';
											}
										}	
											


										

								echo '	</ul>

									</div>



								';
							}

						}	
					}
					

				?>			
				
				

			</div>
			<!-- ========================================
				DATOS CONTACTO
			===========================================-->
			<?php

				  $commerce=  ControllerCart::ctrViewTarifa();


			?>


			<div class="col-md-3 col-sm-6 col-xs-12 text-left infoContacto">

				<h4>Dudas e inquietudes, contactenos en:</h4>

				<br>

				<h5>
					
					<i class="fa fa-phone-square" aria-hidden="true"></i> <?php echo $commerce["phone"]; ?>

					<br><br>
					
					<i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $commerce["emailContact"]; ?>

					<br><br>

					<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $commerce["address"]; ?>

					


				</h5>

				

				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.061585693295!2d-75.60296395011484!3d6.255617327933919!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4429739f2122e9%3A0x4812b922f0ad8f18!2sCl.%2045f%20%2382-31%2C%20Medell%C3%ADn%2C%20Antioquia%2C%20Colombia!5e0!3m2!1ses!2sve!4v1594239666681!5m2!1ses!2sve" width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>




				
				




			</div>

			<!-- ========================================
				FORMULARIO CONTÁCTENOS
			===========================================-->

			<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12 formContacto">
				
				<h4>RESUELVA SU INQUIETUD</h4>
				
				<form role="form" method="post" onsubmit="return validarContactenos()">
					
					
			  		<input type="text" id="nombreContactenos" name="nombreContactenos" class="form-control" placeholder="Escriba su nombre" required> 

			   		<br>
	    	      
   					<input type="email" id="emailContactenos" name="emailContactenos" class="	form-control" placeholder="Escriba su correo electrónico" required>  

   					<br>
	    		     	          
	       			<textarea id="mensajeContactenos" name="mensajeContactenos" class="form-control" placeholder="Escriba su mensaje" rows="5" required></textarea>

	       			<br>
	    	
	       			<input type="submit" value="Enviar" class="btn btn-default backColor pull-right" id="enviar">


				</form>

				<?php 

					$contactenos = new ControllerUser();
					$contactenos -> ctrFormContactenos();

				?>


			</div>



		</div>


	</div>


</footer>	

<!--=====================================
FINAL
======================================-->

<div class="container-fluid final">
	
	<div class="container">
	
		<div class="row">
			
			<div class="col-sm-6 col-xs-12 text-left text-muted">
				
				<h5>&copy; 2020 Todos los derechos reservados. Sitio elaborado por la Adelvis</h5>

			</div>

			<div class="col-sm-6 col-xs-12 text-right social">
				
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

		</div>

	</div>

</div>