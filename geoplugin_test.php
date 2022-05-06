<?php 
	
	$informacionPais = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);

	var_dump($informacionPais);

	echo "geoplugin_test.php";

	//echo  file_get_contents ( "http://www.geoplugin.com/ip.php" ) ; 
?>