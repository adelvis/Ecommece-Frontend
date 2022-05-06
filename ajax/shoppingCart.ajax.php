<?php

require_once "../extensiones/paypal.controller.php";
require_once "../controller/cart.controller.php";
require_once "../model/cart.model.php";

require_once "../controller/product.controller.php";
require_once "../model/product.model.php";
/**

 * 
 */
class AjaxCart 
{
	/*=====================================
	=            METODO PAYPAL            =
	=====================================*/
	
	public $divisa;
	public $total;
	public $totalEncriptado;
	public $impuesto;
	public $envio;
	public $subtotal;
	public $tituloArray;
	public $cantidadArray;
	public $valorItemArray;
	public $idProductoArray;


	public function ajaxSendPaypal(){

		
		if(md5($this->total)==$this->totalEncriptado){

			$datos =  array(

				'divisa' 		=> $this->divisa, 
				'total' 		=> $this->total,
				'totalEncriptado'=>$this->totalEncriptado,
				'impuesto' 		=> $this->impuesto,
				'envio' 		=> $this->envio,
				'subtotal' 		=> $this->subtotal,
				'tituloArray' 	=> $this->tituloArray,
				'cantidadArray' => $this->cantidadArray,
				'valorItemArray'=> $this->valorItemArray,
				'idProductoArray'=> $this->idProductoArray

			);

			$answer = Paypal::mdlPaymentPaypal($datos);
			echo $answer;



		}



	} 
	

	/*=====================================
	=            METODO PAYU        =
	=====================================*/

	public function ajaxGetCommercePayu(){




		$answer=  ControllerCart::ctrViewTarifa();

	
		echo json_encode($answer);




	}


	/*=============================================================
	=  Verificar que no tenga el producto adquirido           =
	==============================================================*/
	public $idProducto;
	public $idUsuario;

	public function ajaxVerifyProduct(){

		$datos =  array(

				'idUser' 			=> $this->idUsuario, 
				'idProduct' 		=> $this->idProducto

			);

		

		$answer = ControllerCart::ctrVerifyProduct($datos);


		echo json_encode($answer);




	}



	
	
}

/*=====================================
=            METODO PAYPAL            =
=====================================*/

if(isset($_POST["divisa"])){

	$idProductos= explode(",", $_POST["idProductoArray"]);
	$cantidadProductos= explode(",", $_POST["cantidadArray"]);
	$precioProductos= explode(",", $_POST["valorItemArray"]);

	$item = "id";

	for ($i=0; $i < count($idProductos) ; $i++) { 

		$value = $idProductos[$i];

		$verificarProductos = ControllerProduct::ctrViewInfProduct($item, $value);

		if($_POST["divisa"]!="USD") {

			$divisa = file_get_contents("http://free.currconv.com/api/v7/convert?q=USD_".$_POST["divisa"]."&compact=ultra&apiKey=aede2f4b064b9ae51f5d");

	
			$jsonDivisa = json_decode($divisa, true);

			//print_r($jsonDivisa);

			//print_r($jsonDivisa["USD_".$_POST["divisa"]]); 

			$conversion = $jsonDivisa["USD_".$_POST["divisa"]];

		}else{

			$conversion = 1;


		}

	
		if ($verificarProductos["priceOffer"]==0){

			$precio = number_format($verificarProductos["price"]*$conversion,2);

		}else {

			$precio = number_format($verificarProductos["priceOffer"]*$conversion,2);

		}

		$verificarSubTotal = $cantidadProductos[$i]* $precio;

		//echo number_format($verificarSubTotal,2). "<br>".
		//echo number_format($precioProductos[$i],2). "<br>";

		//return;

		if($verificarSubTotal !=$precioProductos[$i]){

			echo "carrito-de-compras";
			return;

		}



	}




	$paypal = new AjaxCart();

	$paypal ->divisa= $_POST["divisa"];
	$paypal ->total= $_POST["total"];
	$paypal ->totalEncriptado= $_POST["totalEncriptado"];
	$paypal ->impuesto= $_POST["impuesto"];
	$paypal ->envio= $_POST["envio"];
	$paypal ->subtotal= $_POST["subtotal"];
	$paypal ->tituloArray= $_POST["tituloArray"];
	$paypal ->cantidadArray= $_POST["cantidadArray"];
	$paypal ->valorItemArray= $_POST["valorItemArray"];
	$paypal ->idProductoArray= $_POST["idProductoArray"];

	$paypal -> ajaxSendPaypal();


}

/*=====================================
	=            METODO PAYU        =
=====================================*/
if(isset($_POST["metodoPago"]) && $_POST["metodoPago"]=="payu"){

	
	$idProductos= explode(",", $_POST["idProductoArray"]);
	$cantidadProductos= explode(",", $_POST["cantidadArray"]);
	$precioProductos= explode(",", $_POST["valorItemArray"]);

	$item = "id";

	for ($i=0; $i < count($idProductos) ; $i++) { 

		$value = $idProductos[$i];

		$verificarProductos = ControllerProduct::ctrViewInfProduct($item, $value);


		if($_POST["divisa"]!="USD") {

			$divisa = file_get_contents("http://free.currconv.com/api/v7/convert?q=USD_".$_POST["divisa"]."&compact=ultra&apiKey=aede2f4b064b9ae51f5d");

			$jsonDivisa = json_decode($divisa, true);

		//print_r($jsonDivisa);

		//print_r($jsonDivisa["USD_".$_POST["divisa"]]); 

			$conversion = $jsonDivisa["USD_".$_POST["divisa"]];

		}else{

			$conversion = 1;

		}	


		if ($verificarProductos["priceOffer"]==0){

			$precio = number_format($verificarProductos["price"]*$conversion,2);

		}else {

			$precio = number_format($verificarProductos["priceOffer"]*$conversion,2);

		}

		$verificarSubTotal = $cantidadProductos[$i]* $precio;



		if($verificarSubTotal !=$precioProductos[$i]){


			echo "carrito-de-compras";

			return;

		}

	}


	$payu = new AjaxCart();

	$payu ->ajaxGetCommercePayu();



}


/*=============================================
VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO
=============================================*/	

if(isset($_POST["idUsuario"])){

	$deseo = new AjaxCart();
	$deseo -> idUsuario = $_POST["idUsuario"];
	$deseo -> idProducto = $_POST["idProducto"];
	$deseo ->ajaxVerifyProduct();
}

