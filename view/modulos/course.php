<?php

if(!isset($_SESSION["validarSession"])){

	echo '<script> window.location="'.$url.'";</script>';

	exit();

}

?>

<div class="container-fluid well well-sm">
	

	<div class="container">
		
		<div class="row" >

			<!--=============================================
			=            Breadcrumb de Curso            =
			============================================= -->

			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">INICIO</a></li>

				<li class="active pagActiva"><?php echo "curso"  ?></li>
				
			</ul>

			<!-- end Breadcrud Curso--->

		</div>

	</div>


</div>


<!--=============================================
=          Traer el Curso            =
============================================= -->

<?php


if(isset($routes[1]) && isset($routes[2]) && isset($routes[3])){

	$item = "id";

	$value = $routes[1];

	$idUser = $routes[2];

	$idProduct = $routes[3];

	$confirmPurchases = ControllerUser::ctlViewShopping($item, $value);


	

	if($confirmPurchases[0]["id_user"]== $idUser
		&& $confirmPurchases[0]["id_user"]== $_SESSION["id"]
	    && $confirmPurchases[0]["id_product"]== $idProduct){


		echo "<center><h1>Bienvenido al curso</h1></center>";



	}else{

		echo '<div class="col-12-xs text-center error404">
			
			<h1><small>¡Oops!</small></h1>
			
			<h2> No tiene acceso a este producto</h2>

		</div>';



	}


}else{

	echo '<div class="col-12-xs text-center error404">
			
			<h1><small>¡Oops!</small></h1>
			
			<h2> No tiene acceso a este producto</h2>

		</div>';




}

?>