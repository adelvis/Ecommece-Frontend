
<?php

/**
 * Carrito de compra
 */
class ControllerCart 
{
	
	/*======================================
	=            Mostrar tarifa            =
	======================================*/
	
	static public function ctrViewTarifa(){


		$table = "commerce";

		$answer = ModelCart::mdlViewTarifa($table);


		return $answer;






	}


	/*======================================
	=           Nuevas compras           =
	======================================*/

	static public function ctrNewShopping($datos){

		$table = "shopping";

		$answer = ModelCart::mdlNewShopping($table, $datos);

   		if($answer=="ok"){

   			$table = "comments";

   			$answer2 = ModelUser::mdlAddComment($table, $datos);

			/*==============================================================
			=        ACTUALIZAR NOTIFICACIONES DE NUEVOS VENTAS      =
			===============================================================*/

			$getNotifications = ControllerNotifications::ctrViewNotifications();

			$valueNew = $getNotifications["salesNew"] +1 ;

			ModelNotifications::mdlUpdateNotifications("notificaciones", "salesNew", $valueNew);



   		}

		return $answer;


	}


	/*=============================================================
	=  Verificar que no tenga el producto adquirido           =
	==============================================================*/

	static public function ctrVerifyProduct($datos){


		$table= "shopping";

		$answer = ModelCart::mdlVerifyProduct($table, $datos);

		return $answer;



	}

	
	



}