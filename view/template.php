<!DOCTYPE html>

<html lang="es">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	

	<?php

		
		$server = Route::ctrRouteServer();


		$template = ControllerTemplate::ctrStyleTemplate();

		echo '<link rel="icon" href="'.$server.$template["icono"].'">';

		/*=========================================================
		=            Mantener la ruta fija del proyecto           =
		===========================================================*/
		
		$url = Route::ctrRoute();


		/*=========================================================
		=           Marcado de cabecera           =
		===========================================================*/

		$routes = array();


		if(isset($_GET["ruta"])) {

			$routes = explode("/", $_GET["ruta"]);

			$route =$routes[0];

		}else{

			$route ="inicio"; 

		}



		$head = ControllerTemplate::ctrGetHeadGraph($route);

	
		if($head){
			if(is_null($head["route"])){

				$route ="inicio"; 
	
				$head = ControllerTemplate::ctrGetHeadGraph($route);
	
			}


		}
		
		
		


	?>
	<!--===================================================================
	Marcado HTML 5
	====================================================================-->


	<meta name="title" content="<?php echo $head['title']; ?>">

	<meta name="description" content="<?php echo $head['description']; ?>" >

	<meta name="keyword" content="<?php echo $head['keywords']; ?>">

	<title><?php echo $head['title']; ?></title>


	<!--=====================================
	Marcado de Open Graph FACEBOOK
	======================================-->

	<meta property="og:title"   content="<?php echo $head['title'];?>">
	<meta property="og:url" content="<?php echo $url.$head['route'];?>">
	<meta property="og:description" content="<?php echo $head['description'];?>">
	<meta property="og:image"  content="<?php echo $server.$head['image'];?>">
	<meta property="og:type"  content="website">	
	<meta property="og:site_name" content="My Project Demo Ecomm Virtual">
	<meta property="og:locale" content="es_VE">


	<!--=====================================
	Marcado para DATOS ESTRUCTURADOS GOOGLE
	======================================-->
	
	<meta itemprop="name" content="<?php echo $head['title'];?>">
	<meta itemprop="url" content="<?php echo $url.$head['route'];?>">
	<meta itemprop="description" content="<?php echo $head['description'];?>">
	<meta itemprop="image" content="<?php echo $server.$head['image'];?>">

	<!--=====================================
	Marcado de TWITTER
	======================================-->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?php echo $head['title'];?>">
	<meta name="twitter:url" content="<?php echo $url.$head['route'];?>">
	<meta name="twitter:description" content="<?php echo $head['description'];?>">
	<meta name="twitter:image" content="<?php echo $server.$head['image'];?>">
	<meta name="twitter:site" content="@tu-usuario">


	


	<!--====  CSS  ====-->
	
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/plugins/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/plugins/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/plugins/flexslider.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/plugins/sweetalert.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/plugins/dscountdown.css">

	
	<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet"> 

	<link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed&display=swap" rel="stylesheet">



	<!--====  CSS personalizadas ====-->

	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/template.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/header.css">


	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/slide.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/product.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/infoProduct.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/profile.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/carrito-de-compra.css">

	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/offers.css">	

	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>view/css/footer.css">		
	


	<!--====  Javasript  ====-->

	<script  src="<?php echo $url; ?>view/js/plugins/jquery.min.js"></script>

	<script  src="<?php echo $url; ?>view/js/plugins/bootstrap.min.js"></script>

	<script  src="<?php echo $url; ?>view/js/plugins/jquery.easing.js"></script>
	
	<script  src="<?php echo $url; ?>view/js/plugins/jquery.scrollUp.js"></script>

	<script src="<?php echo $url; ?>view/js/plugins/jquery.flexslider.js"></script>

	<script src="<?php echo $url; ?>view/js/plugins/sweetalert.min.js"></script>

	<script src="<?php echo $url; ?>view/js/plugins/md5-min.js"></script>
	
	<script src="<?php echo $url; ?>view/js/plugins/dscountdown.min.js"></script>

	<script src="https://apis.google.com/js/platform.js" async defer></script>

	<script src="<?php echo $url; ?>view/js/plugins/knob.jquery.js"></script>

	
	<!--/*=============================================
	Pixel de facebook
	=============================================*/ -->
	<?php echo $template["pixelFacebook"]; ?>

 
</head>
<body>
	
	<?php

		/*=============================================
		=            Section Head           =
		=============================================*/
		
		include "modulos/head.php";
		
		/*=====  End of Section Head  ======*/


		/*=============================================
		=         Section Contenido Dinamico          =
		=============================================*/


		/*=============================================
		=            Section URL Amigables           =
		=============================================*/
		
		$routes 		= array();
		$route  		= null;
		$infoProduct  	= null;

	

		if(isset($_GET["ruta"])) {

			$routes = explode("/", $_GET["ruta"]);

			$item = "route"; 

			$value =$routes[0];

			/*---------- URL Amigable para Categories  ----------*/
			

			$routeCategories = ControllerProduct::ctrViewCategories($item, $value);

			

			if(is_array($routeCategories) && $routes[0] == $routeCategories["route"] && $routeCategories["state"]==1 ){

			
				$route  = $routes[0];
	
			}



			/*---------- URL Amigable para SubCategory  ----------*/


			$routeSubcategory = ControllerProduct::ctrViewSubcategory($item, $value);




			foreach ($routeSubcategory as $key => $value) {
				# code...

				if($routes[0] == $value["route"] && $value["state"]==1){

					$route  = $routes[0];

				}

			}

			/*---------- URL Amigable para Producto  ----------*/

			$routeProducts = ControllerProduct::ctrViewInfProduct($item, $value);

			

			if(is_array($routeProducts) && $routes[0] == $routeProducts["route"] && $routeProducts["state"]==1 ){

			
					$infoProduct  = $routes[0];
	

			}

			


			
			
			if($route != null || $routes[0]=="articulos-gratis" || $routes[0]=="lo-mas-vendido" || $routes[0]=="lo-mas-visto" ){

				include "modulos/product.php";

			}elseif ($infoProduct != null) {


				include "modulos/infoProduct.php";
				
			}elseif ($routes[0]== "searcher" || $routes[0]== "verificar" || $routes[0]== "logOut" || $routes[0]== "profile" || $routes[0]=="carrito-de-compras" || $routes[0]=="error" || $routes[0]=="end-shopping" || $routes[0]=="end-shopping-payu" || $routes[0]=="course" || $routes[0]=="offers" || $routes[0]=="canceled" ) {


				include "modulos/".$routes[0].".php";


			}elseif($routes[0]=="inicio" ) {

				include "modulos/slide.php";

				include "modulos/prominent.php";

				include "modulos/visits.php";

			

			}else {

				include "modulos/error404.php";

			}




		} else{

			include "modulos/slide.php";

			include "modulos/prominent.php";

		    include "modulos/visits.php";

			
		}

		
		include "modulos/footer.php";



		/*=====  End of Section URL Amigables  ======*/




	?>


<input type="hidden" value="<?php echo $url; ?>" id="hiddenPath">	

<!--====  Javasript Personalizados ====-->	



<script src="<?php echo $url; ?>view/js/header.js"></script>
<script src="<?php echo $url; ?>view/js/template.js"></script>
<script src="<?php echo $url; ?>view/js/slide.js"></script>
<script src="<?php echo $url; ?>view/js/searcher.js"></script>
<script src="<?php echo $url; ?>view/js/infoProduct.js"></script>
<script src="<?php echo $url; ?>view/js/user.js"></script>
<script src="<?php echo $url; ?>view/js/facebookRegistration.js"></script>
<script src="<?php echo $url; ?>view/js/shoppingCart.js"></script>
<script src="<?php echo $url; ?>view/js/visits.js"></script>

<!--=====================================
https://developers.facebook.com/
======================================-->

<?php echo $template["apiFacebook"]; ?>



<script>


	/*=============================================
	COMPARTIR EN FACEBOOK
	https://developers.facebook.com/docs/      
	=============================================*/
	
	$(".btnFacebook").click(function(){

		FB.ui({

			method: 'share',
			display: 'popup',
			href: '<?php  echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];  ?>',
		}, function(response){});

	})

	/*=============================================
	COMPARTIR EN GOOGLE
	https://developers.google.com/+/web/share/  
	=============================================*/

	$(".btnGoogle").click(function(){

	

		window.open(

			'https://plus.google.com/share?url=<?php  echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];  ?>',
			'',
			'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400'
		);

		return false;

	})
   






</script>

<!--/*=============================================
Pixel de google
=============================================*/  -->
<?php echo $template["pixelFacebook"]; ?>

</body>
</html>