<?php

/*=============================================
PAGO PAYU
=============================================*/
if (isset( $_POST['response_code_pol']) && isset( $_GET['payu']) && $_GET['payu'] === 'true') {


   
         $productos= explode("-", $_GET["productos"]);
         $cantidad= explode("-", $_GET["cantidad"]);

         $idUsuario = $_GET["idUsuario"];


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

            $datos = array("idUser"=>$idUsuario,
                           "idProduct"=>$productos[$i],
                           "method"=>"payu",
                           "email"=>$_POST['email_buyer'],
                           "address"=>$_POST["shipping_address"],
                           "country"=>$_POST["shipping_country"],
                           "quantity"=>$cantidad[$i],
                           "price"=>$price,
                           "idPayment"=>$_POST["reference_pol"],
                           "totalPayment" =>$_POST["value"]
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

            


       }




   

   





}