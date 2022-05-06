<?php


/**
 * Pagos por PAYPAL
 */


require_once "../model/route.php";
require_once "../model/cart.model.php";


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;




class Paypal 
{
	
	static public function mdlPaymentPaypal($datos)
	{
		# code...

		require __DIR__ . '/bootstrap.php';


		$tituloArray = explode(",", $datos["tituloArray"]);
		$cantidadArray = explode(",", $datos["cantidadArray"]);
		$valorItemArray = explode(",", $datos["valorItemArray"]);
		$idProductos = str_replace(",","-", $datos["idProductoArray"]);

		$cantProductos = str_replace(",","-", $datos["cantidadArray"]);		
		

		//Seleccione el metodo de pago

		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

	

		$item =array();
		$variosItem = array();

		for ($i=0; $i < count($tituloArray); $i++) { 
			# code...
			$item[$i] = new Item();
			$item[$i]->setName($tituloArray[$i])
			    ->setCurrency($datos["divisa"])
			    ->setQuantity($cantidadArray[$i])
			    ->setPrice($valorItemArray[$i]/$cantidadArray[$i]);

			array_push($variosItem, $item[$i]);


		}


		// agrupagos los item en una lista

		$itemList = new ItemList();
		$itemList->setItems($variosItem);

		


		// ### Detalles pagos impuesto, envio, subtotal

		$details = new Details();
		$details->setShipping($datos["envio"])
		    ->setTax($datos["impuesto"])
		    ->setSubtotal($datos["subtotal"]);

		
		   

		// Definimos el pago total con sus detalles
		
		$amount = new Amount();
		$amount->setCurrency($datos["divisa"])
		    ->setTotal($datos["total"])
		    ->setDetails($details);   

		
		

		//Agregamos las caracteristicas de la transacción
		
		$transaction = new Transaction();
		$transaction->setAmount($amount)
		    ->setItemList($itemList)
		    ->setDescription("Payment description")
		    ->setInvoiceNumber(uniqid()); 


				       

	    //Agregamos las URL despues de realizar el pago o cuando el pago es cancelado
		//Importante agregar  la URL principal en la API developers paypal    
		$url = Route::ctrRoute();

		
		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl("$url/index.php?ruta=end-shopping&paypal=true&productos=".$idProductos."&cantidad=".$cantProductos)
		    ->setCancelUrl("$url/carrito-de-compras");    

		//Agregamos las caracteristicas de pago

		$payment = new Payment();
		$payment->setIntent("sale")
		    ->setPayer($payer)
		    ->setRedirectUrls($redirectUrls)
		    ->setTransactions(array($transaction));   
		    

		// tratar  de ejecutar un proceso y si falla ejecutar una rutina de error

	
		try{

			$payment->create($apiContext);



		}catch(PayPal\Exception\PayPalConnectionException $ex){

			echo $ex->getCode(); // Prints the Error Code
			echo $ex->getData(); // Prints the detailed error message 
			die($ex);
			return "$url/error";

		}

		# utilizamos un foreach para iterar sobre $payment, utilizamos el método llamado getLinks() para obtener todos los enlaces que aparecen en el array $payment y caso de que $Link->getRel() coincida con 'approval_url' extraemos dicho enlace, finalmente enviamos al usuario a esa dirección que guardamos en la variable $redirectUrl on el método getHref();

		foreach ($payment->getLinks() as $link) {
			
			if($link->getRel() == "approval_url"){

				$redirectUrl = $link->getHref();
			}
		}

		return $redirectUrl;
		
	}
}