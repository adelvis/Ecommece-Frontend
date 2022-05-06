<!--=====================================
SLIDESHOW  
======================================-->

<div class="container-fluid" id="slide">
	
	<div class="row">
		
		<!--=====================================
		DIAPOSITIVAS
		======================================-->

		<ul>

			<?php

				$servidor = Route::ctrRouteServer();

				$slide = ControllerSlider::ctlViewSlide();

				foreach ($slide as $key => $value) {	

					$estiloImgProducto = json_decode($value["styleImgProduct"], true);
					$estiloTextoSlide = json_decode($value["styleTextSlide"], true);
					$titulo1 = json_decode($value["title1"], true);
					$titulo2 = json_decode($value["title2"], true);
					$titulo3 = json_decode($value["title3"], true);

					echo '<li>
				
							<img src="'.$servidor.$value["imgBack"].'">

							<div class="slideOpciones '.$value["typeSlide"].'">';

								if($value["imgProduct"] != ""){

								echo '<img class="imgProducto" src="'.$servidor.$value["imgProduct"].'" style="top:'.$estiloImgProducto["top"].'%; right:'.$estiloImgProducto["right"].'%; width:'.$estiloImgProducto["width"].'%; left:'.$estiloImgProducto["left"].'%">';

								}					

								echo '<div class="textosSlide" style="top:'.$estiloTextoSlide["top"].'%; left:'.$estiloTextoSlide["left"].'%; width:'.$estiloTextoSlide["width"].'%; right:'.$estiloTextoSlide["right"].'%">
									
									<h1 style="color:'.$titulo1["color"].'">'.$titulo1["texto"].'</h1>

									<h2 style="color:'.$titulo2["color"].'">'.$titulo2["texto"].'</h2>

									<h3 style="color:'.$titulo3["color"].'">'.$titulo3["texto"].'</h3>';

								if($value["button"] != ""){

									echo '<a href="'.$value["url"].'">
										
										<button class="btn btn-default backColor text-uppercase buttonVerProduct">

										'.$value["button"].' <span class="fa fa-chevron-right"></span>

										</button>

									</a>';

								}

								echo '</div>	

							</div>

						</li>';

				}

			?>		

		</ul>

		<!--=====================================
		PAGINACIÓN
		======================================-->

		<ol id="paginacion">

			<?php

				for($i = 1; $i <= count($slide); $i++){

					echo '<li item="'.$i.'"><span class="fa fa-circle"></span></li>';

				}		

			?>

		</ol>	

		<!--=====================================
		FLECHAS
		======================================-->	

		<div class="flechas" id="retroceder"><span class="fa fa-chevron-left"></span></div>
		<div class="flechas" id="avanzar"><span class="fa fa-chevron-right"></span></div>

	</div>

</div>

<center>
	
	<button id="btnSlide" class="backColor">
		
			<i class="fa fa-angle-up"></i>

	</button>

</center>

<script type="text/javascript">


		
	$("#slide ul li").css({"width":100/$("#slide ul li").length + "%"});
	$("#slide ul").css({"width":$("#slide ul li").length*100 + "%"});
		


</script>