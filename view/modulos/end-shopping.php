



<?php


   $url = Route::ctrRoute();

   if(!isset($_SESSION["validarSession"])){

      echo '<script> window.location="'.$url.'";</script>';

      exit();

   }


   #requerimos las credenciales de paypal
   require 'extensiones/bootstrap.php';
   require_once "model/cart.model.php";



   #importamos librería del SDK
   use PayPal\Api\Payment;
   use PayPal\Api\PaymentExecution;

   /*=============================================
   PAGO PAYPAL
   =============================================*/
   #evaluamos si la compra está aprobada


   if(isset( $_GET['paypal']) && $_GET['paypal'] === 'true'){

       #recibo los productos comprados
      $productos = explode("-", $_GET['productos']);

      $cantidad = explode("-", $_GET['cantidad']);



       #capturamos el Id del pago que arroja Paypal
      $paymentId = $_GET['paymentId'];

      #Creamos un objeto de Payment para confirmar que las credenciales si tengan el Id de pago resuelto
      $payment = Payment::get($paymentId, $apiContext);

      #creamos la ejecución de pago, invocando la clase PaymentExecution() y extraemos el id del pagador
      $execution = new PaymentExecution();

      $execution->setPayerId($_GET['PayerID']);

      #validamos con las credenciales que el id del pagador si coincida
      $payment->execute($execution, $apiContext);

      $datosTransaccion = $payment->toJSON();

      $datosUsuario = json_decode($datosTransaccion);

   
     

      $emailComprador = $datosUsuario->payer->payer_info->email;
      $dir = $datosUsuario->payer->payer_info->shipping_address->line1;
      $city = $datosUsuario->payer->payer_info->shipping_address->city;
      $state = $datosUsuario->payer->payer_info->shipping_address->state;
      $postal_code = $datosUsuario->payer->payer_info->shipping_address->postal_code;
      $country = $datosUsuario->payer->payer_info->shipping_address->country_code;

      $address = $dir.", ".$city.", ".$state.", ".$postal_code;


      $price = $datosUsuario->transactions[0]->item_list->items[0]->price;

      $idPayment = $datosUsuario->transactions[0]->invoice_number;

      $totalPayment =  $datosUsuario->transactions[0]->amount->total;

         

      #Actualizamos la base de datos
      for($i = 0; $i < count($productos); $i++){

         $price = $datosUsuario->transactions[0]->item_list->items[$i]->price;

          

         $datos = array(
            "idUser"=>$_SESSION["id"],
            "idProduct"=>$productos[$i],
            "method"=>"paypal",
            "email"=>$emailComprador,
            "address"=>$address,
            "country"=>$country, 
            "quantity"=>$cantidad[$i],
            "price"=>$price,
            "idPayment"=>$idPayment,
            "totalPayment" => $totalPayment

         );
        
      

        $answer = ControllerCart::ctrNewShopping($datos);

         $sort= "id";
         $item= "id";
         $value= $productos[$i];

         $productShopping = ControllerProduct::ctrListProducts($sort,$item, $value);

         foreach ($productShopping as $key => $value) {
            # code...
         
            $item1 = "sales";
            $value1 = $value["sales"]+$cantidad[$i];

            $item2 = "id";
            $value2 = $value["id"]; 

            $updateShopping =ControllerProduct::ctrUpdateProduct($item1, $value1, $item2, $value2);

         }

          if($answer =="ok" && $updateShopping =="ok"){

            echo '<script>

            localStorage.removeItem("listaProductos");
            localStorage.removeItem("cantidadCesta");
            localStorage.removeItem("sumaCesta");
            window.location = "'.$url.'profile";

            </script>';




         }


      }


      

   }
   
/*=============================================
PAGO PAYULATAM
=============================================*/
elseif (isset( $_GET['payu']) && $_GET['payu'] === 'true') {

   $answer = ControllerCart::ctrViewTarifa();


   # code...
   $ApiKey = $answer["apiKeyPayu"];
   $merchant_id = $_REQUEST['merchantId'];
   $referenceCode = $_REQUEST['referenceCode'];
   $TX_VALUE = $_REQUEST['TX_VALUE'];
   $New_value = number_format($TX_VALUE, 1, '.', '');
   $currency = $_REQUEST['currency'];
   $transactionState = $_REQUEST['transactionState'];
   $firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
   $firmacreada = md5($firma_cadena);
   $firma = $_REQUEST['signature'];
   $reference_pol = $_REQUEST['reference_pol'];
   $cus = $_REQUEST['cus'];
   $extra1 = $_REQUEST['description'];
   $pseBank = $_REQUEST['pseBank'];
   $lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
   $transactionId = $_REQUEST['transactionId'];

   if ($_REQUEST['transactionState'] == 4 ) {
      $estadoTx = "Transacción aprobada";
   }

   else if ($_REQUEST['transactionState'] == 6 ) {
      $estadoTx = "Transacción rechazada";
   }

   else if ($_REQUEST['transactionState'] == 104 ) {
      $estadoTx = "Error";
   }

   else if ($_REQUEST['transactionState'] == 7 ) {
      $estadoTx = "Transacción pendiente";
   }

   else {
      $estadoTx=$_REQUEST['mensaje'];
   }


   if (strtoupper($firma) == strtoupper($firmacreada) && $estadoTx=="Transacción aprobada") {

         $productos= explode("-", $_GET["productos"]);
         $cantidad= explode("-", $_GET["cantidad"]);
          #Actualizamos la base de datos

         
         for($i = 0; $i < count($productos); $i++){

            $sort= "id";
            $item= "id";
            $value= $productos[$i];

            $productShopping = ControllerProduct::ctrListProducts($sort,$item, $value);

            if ($productShopping[0]["priceOffer"]==0){

               $price=$productShopping[0]["price"];

            }else{

               $price=$productShopping[0]["priceOffer"];

            }

            $datos = array("idUser"=>$_SESSION["id"],
                           "idProduct"=>$productos[$i],
                           "method"=>"payu",
                           "email"=>$_REQUEST['buyerEmail'],
                           "address"=>" ",
                           "country"=>" ",
                           "quantity"=>$cantidad[$i],
                           "price"=>$price,
                           "idPayment"=>$reference_pol,
                           "totalPayment" => $TX_VALUE
                              );


             $answer = ControllerCart::ctrNewShopping($datos);

            foreach ($productShopping as $key => $value) {
                  # code...
               
                  $item1 = "sales";
                  $value1 = $value["sales"]+$cantidad[$i];

                  $item2 = "id";
                  $value2 = $value["id"]; 

                  $updateShopping =ControllerProduct::ctrUpdateProduct($item1, $value1, $item2, $value2);

            }

            if($answer =="ok" && $updateShopping =="ok"){

                  echo '<script>

                  localStorage.removeItem("listaProductos");
                  localStorage.removeItem("cantidadCesta");
                  localStorage.removeItem("sumaCesta");
                  window.location = "'.$url.'profile";

                  </script>';




            }


         }




   }

   





}else if(isset($_GET["gratis"]) && $_GET["gratis"]== "true" ){

/*=============================================
ADQUISICIONES GRATIS
=============================================*/

   $producto = $_GET["producto"];
   $titulo = $_GET["titulo"];
   $address = $_GET["direccion"];

   $datos = array(
            "idUser"=>$_SESSION["id"],
            "idProduct"=>$producto,
            "method"=>"gratis",
            "email"=>$_SESSION["email"],
            "address"=>$address,
            "country"=>" ", 
            "quantity"=>"1",
            "price"=>"0"

         );
     

   $datosDelivery = array (

            "clientName"=> $_SESSION["name"],
            "clientEmail"=>$_SESSION["email"],
            "product" =>$titulo,
            "address" => $address


   );

  
   $answer = ControllerCart::ctrNewShopping($datos);
  // var_dump($answer); 


   $sort= "id";
   $item= "id";
   $value= $producto;

   $productFree = ControllerProduct::ctrListProducts($sort,$item, $value);

//var_dump($productFree); 


   foreach ($productFree as $key => $value) {
      # code...
   
      $item1 = "salesFree";
      $value1 = $value["salesFree"]+1;

      $item2 = "id";
      $value2 = $value["id"]; 

      $updateProduct =ControllerProduct::ctrUpdateProduct($item1, $value1, $item2, $value2);


   }

  


   if($answer== "ok" && $updateProduct=="ok"){

      sendEmail($datosDelivery);  

      echo '<script>window.location ="'.$url.'offers/notice";</script>';



   }



}else{

    echo '<script>

               window.location ="'.$url.'canceled";

            </script>';


}



function sendEmail($datosDelivery){

   /*======================================
   = Obtiene el correo del comercio       =
   ======================================*/

   $commerce=  ControllerCart::ctrViewTarifa();
  
   $emailCommerce= $commerce["emailCommerce"];



   /*======================================
   =            validar correo            =
   ======================================*/

   date_default_timezone_set("America/Caracas");

   $mail = new PHPMailer;

   $mail->CharSet = 'UTF-8';

   $mail->isMail();

   $mail->setFrom($commerce["emailContact"], $commerce["name"]);

   $mail->addReplyTo($commerce["emailContact"], $commerce["name"]);

   $mail->Subject = "Solicitud de artículo Gratis - Gestionar envío";

   $mail->addAddress($emailCommerce);
   
   $mail->msgHTML('

      <div style="width:100%; position:relative; font-family:sans-serif; padding-bottom:40px">

         <center>
         
            img style="padding:25px; width:25%" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQi2gaSSIH7McIsKhrRfR5Bbll_SxQmlO5Lzg&usqp=CAU">

            <h3 style="font-weight:100; color:#999">SOLICITUD DE UN PRODUCTO GRATIS</h3>

            <hr style="border:1px solid #ccc; width:80%">

         </center>

         <h4 style="font-weight:100; color:#999; padding:0 20px ">Ha recibido una solicitud de un articulo gratis de '. $datosDelivery["clientName"] .' ('. $datosDelivery["clientEmail"] . '). A continuación los detalles del artículo:</h4>
         
         <h4 style="font-weight:100; color:#999; padding:0 20px; text-align: justify; "> Artículo: '. $datosDelivery["product"] . ' </h4>
            
         <h4 style="font-weight:100; color:#999; padding:0 20px">Dirección de envío: ' . $datosDelivery["address"] . '

         </h4>
         <center>
            
         <hr style="border:1px solid #ccc; width:80%">

         </center>
      

      </div>');
   

  $envio = $mail->Send();

  



}







?>

