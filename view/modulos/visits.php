<?php

/*=============================================
CREADOR DE IP
=============================================*/

//https://www.browserling.com/tools/random-ip

//$ip = $_SERVER['REMOTE_ADDR'];

//$ip = "138.186.188.203";   //"190.79.213.249"  // "204.39.22.163" // "204.39.22.164";

$ip = "218.38.125.195"; // "204.39.22.167" ; //"190.79.213.255"; //"138.186.188.207" // "138.186.188.211" // "103.96.28.57" // 	
// "218.38.125.195"  "	218.38.125.195";


//http://www.geoplugin.net/

//$informacionPais = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);

//$datosPais = json_decode($informacionPais);

 // abrimos la sesión cURL
$ch = curl_init();
 
// definimos la URL a la que hacemos la petición y le pasamos la IP obtenida
curl_setopt($ch, CURLOPT_URL,"http://www.geoplugin.net/json.gp?ip=".$ip);
// indicamos el tipo de petición: POST
curl_setopt($ch, CURLOPT_POST, TRUE);
 
// recibimos la respuesta y la guardamos en una variable en este caso llamé $datosRecibidosGeoplugin
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$datosRecibidosGeoplugin = curl_exec ($ch);
 
// cerramos la sesión cURL
curl_close ($ch);
 
// ahora tenemos los datos recibidos en $datosRecibidosGeoplugin
 
$datosPais = json_decode($datosRecibidosGeoplugin);



//var_dump($datosPais);

$country = $datosPais->geoplugin_countryName;



$codeCountry = $datosPais->geoplugin_countryCode;


$sendIp = ControllerVisits::ctrSendIp($ip, $country, $codeCountry);



$totalVisits = ControllerVisits::ctrViewTotalVisits();


?>



<!--/*=============================================
	Breadcrumb visitas
=============================================*/ -->

<div class="container-fluid well well-sm">	

	<div class="container">
		
		<div class="row">

			 		
			<ul class="breadcrumb fondoBreadcrumb lead">
				
				<h2 class="pull-right"><small>Tu eres nuestro visitante # <?php  echo $totalVisits["total"]; ?></small></h2>

			</ul>

		</div>

	</div>
</div>


<!-- ========================================
           Modulo de visita           
======================================== -->

<div class="container-fluid">	

	<div class="container">
		
		<div class="row">

			<?php

				$countries = ControllerVisits::ctrViewCountry();


				$colors = array("#09F", "#900", "#d6a2ad",  "#260", "#F09", "#02A","668f80");

				$i= -1;

				

				foreach ($countries as $key => $value) {
			
					

					$media = $value["quantity"]* 100 /$totalVisits["total"];

					if($i < count($colors)-1){
						$i++;
					}else{
						$i=0;
					}
					//$i++;

		

					# code...
					echo '

						<div class="col-md-2 col-sm-4 col-xs-12 text-center">
					
							<h3 class="text-muted">'.$value["country"].'</h3>

							<input type="text" class="knob" value="'.round($media).'" data-width="90" data-height="90" data-fgcolor="'.$colors[$i].'" data-readonly="true">			

							<p class="text-muted text-center" style="font-size:12px">'.round($media).'% de las visitas</p>	


						</div>
					';
				
					

				}

			?>

			

		</div>

	</div>
</div
