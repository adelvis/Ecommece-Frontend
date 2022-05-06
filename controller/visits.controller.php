<?php


/**
 * Controlador visitas
 */
class ControllerVisits 
{

	
	
	static public function ctrSendIp($ip, $country, $codeCountry){

		$answer= null;

		$answerUpdateIp=  null;

		$table ="personVisits";

		$visit= 1;

		if($country==""){

			$country="UnKnown"; 
			$codeCountry= "undefined";

		}

		/*==================================
		=         Buscar Ip existente       =
		==================================*/


		$searchIp = ModelVisits::mdlSearchIp($table, $ip);



		if(!$searchIp){

			/*==================================
			=            Guardar IP            =
			==================================*/

			$answer= ModelVisits::mdlSaveNewIp($table, $ip, $country, $visit);

			//return $answer; 

		}else{

			/*============================================================
			=    SI LA IP EXISTE Y ES OTRO DIA VOLVER A GUARDAR          =
			===============================================================*/


			date_default_timezone_set("America/Caracas"); 
		
			$currentDate = date('Y-m-d');
		
			foreach ($searchIp as $key => $value) {
				# code...
				$dateDB = substr($value["dateReg"], 0, 10);

				
				if ($currentDate != $dateDB){

					$answerUpdateIp= ModelVisits::mdlSaveNewIp($table, $ip, $country, $visit);


				} else{
					
					break;    

				}

			}
			

		}

	
		if($answer == "ok" || $answerUpdateIp=="ok"){

			/*==============================================================
			=        ACTUALIZAR NOTIFICACIONES DE NUEVOS VENTAS      =
			===============================================================*/

			$getNotifications = ControllerNotifications::ctrViewNotifications();

			$valueNew = $getNotifications["visitsNew"] +1 ;

			ModelNotifications::mdlUpdateNotifications("notificaciones", "visitsNew", $valueNew);


			

			$table2= "countryVisits";

			/*============================================================
			=   SELECCIONAR PAIS        =
			===============================================================*/

			$selectCountry = ModelVisits::mdlSelectCountry($table2, $country);


			if(!$selectCountry){

				/*============================================================
				=  SI NO EXISTE  INSERTAR PAIS        =
				===============================================================*/

				$quantity = 1;

				$insertCountry= ModelVisits::mdlInsertCountry($table2, $country, $quantity, $codeCountry);



			}else{

				/*============================================================
				=  SI EXISTE PAIS ACTUALIZAR CANTIDAD        =
				===============================================================*/

				$quantity  = $selectCountry["quantity"] +1;


				$updateCountry= ModelVisits::mdlUpdateCountry($table2, $country, $quantity);




			}

			



		}


		



	}


	/*============================================================
				=  Mostrar total visitas       =
	===============================================================*/

	static public function ctrViewTotalVisits(){


		$table= "countryVisits";

		$total = ModelVisits::mdlViewTotalVisits($table);

		return $total;





	}

	/*============================================================
				=  Mostrar los primeros 6 paises       =
	===============================================================*/


	static public function ctrViewCountry(){


		$table= "countryVisits";

		$answer = ModelVisits::mdlViewCountry($table);

		return $answer;


	}


}




