<?php

Class ControllerNotifications{

	/*=============================================
	MOSTRAR NOTIFICACIONES
	=============================================*/

	static public function ctrViewNotifications(){

		$table = "notificaciones";

		$respuesta = ModelNotifications::mdlViewNotifications($table);

		return $respuesta;

	}

}