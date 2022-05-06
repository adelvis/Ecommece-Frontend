<?php

/**
 * Controlador de la plantilla
 */
class ControllerTemplate 
{
	
	/*=============================================
	=            Section Call Template            =
	=============================================*/
	public function template(){

		include "view/template.php";


	}

	/*=====  End of Section Call Template  ======*/
	
	/*=============================================
	=   Section call Template Style dinamic        =
	=============================================*/
	public function ctrStyleTemplate(){

			$table="plantilla";

			$answer = ModelTemplate::mdlStyleTemplate($table);

			return $answer; 


	}

	/*=====  End of Section Caill Template Style dinamic   ======*/
	
	/*=============================================
	=   Obterner la cabecera (open graph)       =
	=============================================*/
    static public function ctrGetHeadGraph($route){


    	$table= "openGraph";

    	$answer = ModelTemplate::mdlGetHeadGraph($table, $route);

    	return $answer;




    }

	


}